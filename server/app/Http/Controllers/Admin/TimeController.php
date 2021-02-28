<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buddy;
use App\Models\LogTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TimeController extends Controller
{
    public function index()
    {
        $buddies = Buddy::where('user_id','=', auth()->user()->id)->latest()->get();
        return view('admin.time.index', compact('buddies'));
    }

    public function detail(Buddy $buddy)
    {
        $start_date = date('Y-m-d', strtotime("-7 day"));
        $end_date = date('Y-m-d');
        $response = Http::get('https://wakatime.com/api/v1/users/current/summaries?start='.$start_date.'&end='.$end_date.'&api_key='.$buddy->api_key.'&timeout=10')->json();
        $records = [];
        
        $new_records = $response['data'];
        array_pop($new_records);
        
        foreach ($response['data'] as $el) {
            $records[] = [
                'date' => $el['range']['text'],
                'total_time' => $el['grand_total']['text'],
                'projects' => $el['projects']
            ];
            
        }
        foreach ($new_records as $el) {
            // save every logtime from wakatime to database
            LogTime::firstOrCreate([
                "buddy_id" => $buddy->id,
                "date" => date("Y-m-d", strtotime($el['range']['text']  ))
            ],[
                "total_hours" => $el['grand_total']['hours'],
                "total_minutes" => $el['grand_total']['minutes'],
            ]);
        }
        
        return view('admin.time.detail', compact('records','buddy'));
    }

    public function export(Buddy $buddy) {
        // dd($buddy->log()->whereBetween('created_at', [$startDate, $endDate]);
        $start_date = date('Y-m-d', strtotime("-7 day"));
        $end_date = date('Y-m-d');

        $log = LogTime::where('buddy_id','=', $buddy->id)
                        ->orderBy('created_at', 'desc')
                        ->take(1000) // take limit 1000
                        ->get();
        dd($log);
    }
}
