<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;

class UserConfigController extends Controller
{
    public function index()
    {
        $users = User::with('project')->get();
        $projects = Project::all();
        return view('user_config.index', compact('users', 'projects'));
    }

    public function create()
    {
        $projects = \App\Models\Project::all();
        return view('user_config.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:Admin,Officer,PM,VP QHSE',
            'pin' => 'required',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('admin123'), // default password
            'role' => $request->role,
            'pin' => $request->pin,
            'project_id' => $request->project_id,
        ]);

        return redirect()->route('user.config')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $projects = Project::all();
        return view('user_config.edit', compact('user', 'projects'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:Admin,Officer,PM,VP QHSE',
            'project_id' => 'nullable|exists:projects,id',
            'pin' => 'nullable|digits:4',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'project_id' => $request->project_id,
            'pin' => $request->pin,
        ]);

        return redirect()->route('user.config')->with('success', 'User diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['msg' => 'Kamu tidak bisa menghapus diri sendiri.']);
        }

        if ($user->role === 'Admin') {
            return back()->withErrors(['msg' => 'User admin tidak bisa dihapus.']);
        }


        $user->delete();

        return redirect()->route('user.config')->with('success', 'User berhasil dihapus.');
    }



}
