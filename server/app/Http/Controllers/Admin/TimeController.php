<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buddy;
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
        return view('admin.time.detail', compact('records','buddy'));
    }
}
