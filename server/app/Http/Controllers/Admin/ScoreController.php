<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Buddy;
use App\Models\Phase;
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
        return view('admin.score.index', compact('buddy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Buddy $buddy)
    {
        $week = Score::WEEK;
        $phase = Phase::all();
        
        return view('admin.score.create', compact('week', 'phase', 'buddy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payloads = [
            "buddy_id" => $request->buddy_id,
            "phase_id" => $request->phase_id,
            "score" => $request->score,
            "week" => $request->week,
            "notes" => $request->notes,
        ];

        try {
            Score::firstOrCreate($payloads);

            return redirect()->route('admin.buddy.score', $request->buddy_id)->with(['success' => 'SUCCESS TO CREATE NEW DATA']);
        } catch (QueryException $e) {
            return redirect()->route('admin.buddy.score', $request->buddy_id)->with(['error' => 'FAILED TO CREATE NEW DATA']);
        } 
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
        $week = Score::WEEK;
        $phase = Phase::all();
        // dd($score->score);
        return view('admin.score.edit', compact('score', 'week', 'phase'));
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
        try {
            $score->phase_id = $request->phase_id;
            $score->buddy_id = $request->buddy_id;
            $score->week = $request->week;
            $score->score = $request->score;
            $score->notes = $request->notes;
            $score->save();

            return redirect()->route('admin.buddy.score', $request->buddy_id)->with(['success' => 'SUCCESS TO UPDATE DATA']);
        } catch (QueryException $e) {
            return redirect()->route('admin.buddy.score', $request->buddy_id)->with(['error' => 'FAILED TO UPDATE DATA']);
        } 
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
        } else if($report->week == 2) {
            $maxScore = 37.50;
            if ($report->score >= 28) {
                $status = 'Saved';
                $badge = 'gold';
                $color = 'green';
            } else if($report->score >= 21) {
                $status = 'Warning';
                $badge = 'silver';
                $color = 'orange';
            }
        } else if($report->week == 3) {
            $maxScore = 60;
            if ($report->score >= 45) {
                $status = 'Saved';
                $badge = 'gold';
                $color = 'green';
            } else if($report->score >= 33) {
                $status = 'Warning';
                $badge = 'silver';
                $color = 'orange';
            }
        } else if($report->week == 4) {
            $maxScore = 15;
            if ($report->score >= 70) {
                $status = 'Saved';
                $badge = 'gold';
                $color = 'green';
            } else {
                $status = 'Repeat / DO';
                $badge = 'Bronze';
                $color = 'Red';
            }
        }
    }

    return view('admin.score.week-report', compact('report', 'status', 'badge', 'maxScore', 'color'));
  }
}
