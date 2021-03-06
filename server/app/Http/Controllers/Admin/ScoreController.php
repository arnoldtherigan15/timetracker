<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Buddy;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buddy $buddy)
    {
        $score = $buddy->score;
        $buddyName = $buddy->name;

        return view('admin.score.index', compact('score', 'buddyName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }

    
  public function generateReport($id) {
    $report = Score::with([
      'buddy'
    ])->find($id);

    $name = preg_replace('/\s+/', '-', $report->buddy->name);
    // dd($report->week, $name);
    // $pdf = PDF::loadView('P'.$report->phase->name.' Week '.$report->week.' - '.$name, $report)->setPaper('legal', 'landscape');

    // $pdf = PDF::loadView('admin.score.week-report', $report)->setPaper('legal', 'landscape');
    // return $pdf->stream('P'.$report->phase->name.' Week '.$report->week.' - '.$name.'.pdf');
    // Browsershot::html('<h1>Hello world!!</h1>')->save('example.pdf');
  }
}
