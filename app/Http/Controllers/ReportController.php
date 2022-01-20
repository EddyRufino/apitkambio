<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Report;
use App\Jobs\ReportJob;
use Illuminate\Http\Request;
use App\Exports\ReportExport;

class ReportController extends Controller
{
    public function generateReport()
    {
        // Almacena las fechas
        $startDate = request()->startDate;
        $lastDate = request()->lastDate;

        // Nombre del reporte
        $date = Carbon::now();
        $date = $date->format('Y-m-d-h-i-s');

        // Dispara el Job para almacemar el reporte en el STORAGE
        dispatch(new ReportJob($startDate, $lastDate));

        // Descarga el reporte
        return (new ReportExport)->forDate($startDate, $lastDate)->download($date.'.xlsx');

    }

    public function getReport($id)
    {
        $reporte = Report::where('id', $id)->get();

        return response()->json($reporte[0]);
    }

    public function listReport()
    {
        $reports = Report::all();

        return response()->json($reports);
    }
}
