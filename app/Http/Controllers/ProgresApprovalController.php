<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Progres;
use App\Models\ProgresApproval;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProgresApprovalController extends Controller
{
    public function index()
    {
        $progres = Progres::where('project_id', Auth::user()->project_id)
                            ->where('status', 'submitted')
                            ->get();
        return view('approval.index', compact('progres'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate(['pin' => 'required']);

        $progres = Progres::findOrFail($id);

        if ($request->pin !== Auth::user()->pin) {
            return back()->withErrors(['msg' => 'PIN salah']);
        }

        if (!Storage::disk('public')->exists('qr_codes')) {
            Storage::disk('public')->makeDirectory('qr_codes');
        }

        // Generate QR
        $qrString = "Approved by: " . Auth::user()->name . " on " . now();
        $fileName = 'qr_codes/' . uniqid() . '.png';
        $qrPath = storage_path('app/public/' . $fileName);
        QrCode::format('png')->size(200)->generate($qrString, $qrPath);

        // Simpan ke history
        ProgresApproval::create([
            'progres_id' => $progres->id,
            'approved_by' => Auth::id(),
            'role' => 'PM',
            'status' => 'approved',
            'qr_code' => $fileName,
        ]);

        $progres->update(['status' => 'approved_pm']);

        return back()->with('success', 'Progres berhasil di-approve.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['comment' => 'required']);

        $progres = Progres::findOrFail($id);

        ProgresApproval::create([
            'progres_id' => $progres->id,
            'approved_by' => Auth::id(),
            'role' => 'PM',
            'status' => 'rejected',
            'comment' => $request->comment,
        ]);

        $progres->update(['status' => 'rejected']);

        return back()->with('success', 'Progres berhasil direject.');
    }
}
