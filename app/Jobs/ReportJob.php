<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Report;
use App\Exports\ReportExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $startDate;
    protected $lastDate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($startDate, $lastDate)
    {
        $this->startDate = $startDate;
        $this->lastDate = $lastDate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d-h-i-s');

        // Guarda el reporte en el STORAGE
        (new ReportExport)->forDate($this->startDate, $this->lastDate)->store($date.'.xlsx', 'public');

        // Guarda el registro del reporte
        Report::create([
            'title' => request()->title,
            'report_link' => '/storage/' . $date . '.xlsx'
        ]);
    }
}
