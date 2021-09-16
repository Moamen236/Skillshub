<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id)
    {
        $data['exam'] = Exam::findOrFail($id);
        $user = Auth::user();
        $data['can_viwe_start_btn'] = true;
        if ($user !== null) {
            $pivot_row = $user->exams()->where('exam_id', $id)->first();
            if ($pivot_row !== null and $pivot_row->pivot->status == 'closed') {
                $data['can_viwe_start_btn'] = false;
            }
        }

        return view('web.exams.show')->with($data);
    }

    public function start($exam_id, Request $request)
    {
        $user = Auth::user();
        $user->exams()->attach($exam_id);

        $request->session()->flash('prev', "start/$exam_id");
        return redirect(url("exams/questions/$exam_id"));
    }

    public function questions($exam_id, Request $request)
    {
        if (session('prev') !== "start/$exam_id") {
            return redirect(url("exams/show/$exam_id"));
        }
        $data['exam'] = Exam::findOrFail($exam_id);

        $request->session()->flash('prev', "questions/$exam_id");

        return view('web.exams.show-questions')->with($data);
    }

    public function submit($exam_id, Request $request)
    {
        if (session('prev') !== "questions/$exam_id") {
            return redirect(url("exams/show/$exam_id"));
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4',
        ]);
        // calc score
        $exam = Exam::findOrFail($exam_id);

        $points = 0;
        $total_questions_num = $exam->questions->count();

        foreach ($exam->questions as $question) {
            if (isset($request->answers[$question->id])) {
                $user_answer = $request->answers[$question->id];
                $right_answer = $question->right_ans;
                if ($user_answer == $right_answer) {
                    $points += 1;
                }
            }
        }
        $score = ($points / $total_questions_num) * 100;

        //calc time mins
        $user = Auth::user();
        $pivot_row = $user->exams()->where('exam_id', $exam_id)->first();
        $start_time = $pivot_row->pivot->created_at;
        $submit_time = Carbon::now();
        $time_mins = $submit_time->diffInMinutes($start_time);

        if ($time_mins > $pivot_row->duration_mins) {
            $score = 0;
        }
        // update pivot table
        $user->exams()->updateExistingPivot($exam_id, [
            'score' => $score,
            'time_mins' => $time_mins
        ]);

        $request->session()->flash("success", "you finished exam successfully with score $score%");

        return redirect(url("exams/show/{$exam_id}"));


        // dd($time_mins);
    }
}