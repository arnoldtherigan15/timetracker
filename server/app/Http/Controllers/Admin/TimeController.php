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
        // $jwt_token = Config::get('app.jwt_token_zoom');
        $start_date = date('Y-m-d', strtotime("-7 day"));
        $end_date = date('Y-m-d', strtotime("+1 day"));

        // dd($start_date);
        // dd($buddy->api_key);
        $response = Http::get('https://wakatime.com/api/v1/users/current/summaries?start='.$start_date.'&end='.$end_date.'&api_key='.$buddy->api_key.'&timeout=10')->json();
        $records = [];
        // date: el.range.text,
        //   totalTime: el.grand_total.text,
        //   projects: el.projects,
        
        foreach ($response['data'] as $el) {
            $records[] = [
                'date' => $el['range']['text'],
                'total_time' => $el['grand_total']['text'],
                'projects' => $el['projects']
            ];
        }
        
        /**
         * Log yesterday total wakatime to LogTime  
         */
        $date = date("Y-m-d",strtotime("-1 days")); // get system yesterday date
        $dataYesterday = $response['data'][count($response['data'])-3]; // -3 because total array on response is 9 and array start by 0, so for get yesterday data must be -3
        if(isset($buddy->id)) {
            // save every logtime from wakatime to database
            LogTime::firstOrCreate([
                "buddy_id" => $buddy->id,
                "date" => date("Y-m-d", strtotime($el['range']['text']  ))
            ],[
                "total_hours" => $el['grand_total']['hours'],
                "total_minutes" => $el['grand_total']['minutes'],
            ]);

            // if($dataYesterday["range"]['date'] == $date) {
            //     LogTime::firstOrCreate([
            //         "buddy_id" => $buddy->id,
            //         "date" => $date
            //     ],[
            //         "total_hours" => $dataYesterday['grand_total']['hours'],
            //         "total_minutes" => $dataYesterday['grand_total']['minutes'],
            //     ]);
            // }
        }
        
        return view('admin.time.detail', compact('records','buddy'));
    }
}
