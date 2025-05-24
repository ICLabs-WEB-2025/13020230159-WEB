<?php

namespace App\Http\Controllers;

use App\Exports\AttendancesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapKehadiranExport;

class AttendanceExportController extends Controller
{
    public function export()
    {
        return Excel::download(new AttendancesExport, 'attendances.xlsx');
    }

    public function exportExcel()
    {
        return Excel::download(new RekapKehadiranExport, 'rekap-kehadiran.xlsx');
    }
}
