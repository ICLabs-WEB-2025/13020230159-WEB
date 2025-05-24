<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceSession;

class AttendanceScanController extends Controller
{
    public function scanForm($token)
{
    $session = AttendanceSession::where('token', $token)
        ->where('start_time', '<=', now())
        ->where('end_time', '>=', now())
        ->firstOrFail();

    return view('presensi.scan', compact('session'));
}

public function submit(Request $request)
{
    $request->validate([
        'attendance_session_id' => 'required|exists:attendance_sessions,id',
        // tambah validasi lokasi jika mau
    ]);

    \App\Models\Attendance::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'attendance_session_id' => $request->attendance_session_id,
        ],
        [
            'scanned_at' => now(),
            // 'location' => $request->location,
        ]
    );

    return redirect('/admin')->with('success', 'Presensi Berhasil!');

}

}
