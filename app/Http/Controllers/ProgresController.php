<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Progres;

class ProgresController extends Controller
{
    public function index()
    {
        $progres = Progres::where('user_id', Auth::id())->get();
        return view('progres.index', compact('progres'));
    }

    public function create()
    {
        return view('progres.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->project_id) {
            return redirect()->back()->withErrors([
                'msg' => 'User belum terhubung ke proyek. Hubungi admin.',
            ]);
        }

        $request->validate([
            'date' => 'required|date',
            'percent' => 'required|integer|min:0|max:100',
            'notes' => 'nullable|string',
            'evidence' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('evidence')?->store('evidence', 'public');

        Progres::create([
            'user_id' => Auth::id(),
            'project_id' => Auth::user()->project_id,
            'date' => $request->date,
            'percent' => $request->percent,
            'notes' => $request->notes,
            'evidence' => $path,
            'status' => 'submitted'
        ]);

        return redirect()->route('progres.index')->with('success', 'Progres berhasil disimpan');
    }
    
    public function show($id)
    {
        $progress = Progres::with(['user', 'project', 'approvals.approver'])->findOrFail($id);
        return view('progres.show', compact('progress'));
    }

    public function edit(Progres $progres)
    {
        if ($progres->user_id !== auth()->id() || $progres->status !== 'submitted') {
            abort(403);
        }

        return view('progres.edit', compact('progres'));
    }

    public function update(Request $request, Progres $progres)
    {
        if ($progres->user_id !== auth()->id() || $progres->status !== 'submitted') {
            abort(403);
        }

        $request->validate([
            'date' => 'required|date',
            'percent' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'evidence' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('date', 'percent', 'notes');

        if ($request->hasFile('evidence')) {
            $path = $request->file('evidence')->store('evidences', 'public');
            $data['evidence'] = $path;
        }

        $progres->update($data);

        return redirect()->route('progres.index')->with('success', 'Progres berhasil diperbarui.');
    }


}
