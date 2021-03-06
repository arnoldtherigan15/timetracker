<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Buddy;
use Illuminate\Http\Request;

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

    
  public function report($id) {
    $report = Score::with([
      'buddy'
    ])->find($id);

    $name = preg_replace('/\s+/', '-', $report->buddy->name);
    $badge = 'bronze';
    $status = 'Danger';
    $color = 'red';
    $maxScore = 15;
    
    if($report->phase->name == "Phase 1") {
        if($report->week == 1) {
            $maxScore = 15;
            if ($report->score >= 11) {
                $status = 'Saved';
                $badge = 'gold';
                $color = 'green';
            } else if($report->score >= 8) {
                $status = 'Warning';
                $badge = 'silver';
                $color = 'orange';
            }
        }
    }

    return view('admin.score.week-report', compact('report', 'status', 'badge', 'maxScore', 'color'));
  }
}
