<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
//use Illuminate\Contracts\Queue\ShouldQueue;

class ReportExport implements FromCollection
{
    use Exportable;

    protected $startDate;
    protected $lastDate;

    public function forDate($startDate, $lastDate)
    {
        $this->startDate  = $startDate;
        $this->lastDate = $lastDate;

        return $this;
    }

    public function collection()
    {
        return User::whereBetween('birth_date', [$this->startDate, $this->lastDate])->get();
    }
}
