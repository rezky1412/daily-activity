<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Progres;
use App\Models\ProgresApproval;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VPApprovalController extends Controller
{
    public function index()
    {
        // Ambil hanya progress yang sudah di-approve PM
        $progres = Progres::where('status', 'approved_pm')->get();
        return view('vp_approval.index', compact('progres'));
    }    

    public function approve(Request $request, $id)
    {
        $request->validate(['pin' => 'required']);

        $progress = Progres::findOrFail($id);

        if ($request->pin !== Auth::user()->pin) {
            return back()->withErrors(['msg' => 'PIN salah']);
        }

        if (!Storage::disk('public')->exists('qr_codes')) {
            Storage::disk('public')->makeDirectory('qr_codes');
        }

        $qrString = "Approved by VP: " . Auth::user()->name . " at " . now();
        $fileName = 'qr_codes/' . Str::random(12) . '.png';
        $qrPath = storage_path('app/public/' . $fileName);
        QrCode::format('png')->size(200)->generate($qrString, $qrPath);

        // Simpan ke riwayat
        ProgresApproval::create([
            'progres_id' => $progress->id,
            'approved_by' => Auth::id(),
            'role' => 'VP QHSE',
            'status' => 'approved',
            'qr_code' => $fileName,
        ]);

        $progress->update(['status' => 'approved_vp']);

        return back()->with('success', 'Progres disetujui oleh VP QHSE.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['comment' => 'required']);

        $progress = Progres::findOrFail($id);

        ProgresApproval::create([
            'progres_id' => $progress->id,
            'approved_by' => Auth::id(),
            'role' => 'VP QHSE',
            'status' => 'rejected',
            'comment' => $request->comment,
        ]);

        $progress->update(['status' => 'rejected']);

        return back()->with('success', 'Progres ditolak oleh VP QHSE.');
    }
}
