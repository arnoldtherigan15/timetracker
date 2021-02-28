<?php

namespace App\Exports;

use App\Models\LogTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LogTimeExport implements FromCollection, WithHeadings, WithMapping
{
    function __construct($buddy_id) {
        $this->buddy_id = $buddy_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LogTime::join('buddies', 'buddies.id', '=', 'log_times.buddy_id')
                        ->join('users', 'buddies.user_id', '=', 'users.id')
                        ->select(
                            'log_times.id as id',
                            'users.name as buddy_name',
                            'buddies.name as name',
                            'log_times.total_hours as total_hours',
                            'log_times.total_minutes as total_minutes',
                            'log_times.date as date'
                        )
                        ->where('log_times.buddy_id', $this->buddy_id)
                        ->get();
    }
    
    
    public function map($log): array
    {
        return [
            $log->id,
            $log->buddy_name,
            $log->name,
            ($log->total_hours > 0 ? $log->total_hours : '0')." Hours"." ".($log->total_minutes > 0 ? $log->total_minutes : '0')." Minutes",
            date('l', strtotime($log->date)),
            $log->date
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'BUDDY NAME',
            'STUDENT NAME',
            'TOTAL TIME',
            'DAY',
            'DATE'
        ];
    }
}
