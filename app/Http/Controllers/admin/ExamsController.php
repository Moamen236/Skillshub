<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Exam;
use App\Models\Skill;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Exam\CreateRequest;
use App\Http\Requests\Admin\Exam\UpdateRequest;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::orderBy('id', 'DESC')->paginate(10);
        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skills = Skill::all();
        return view('admin.exams.create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $path = Storage::disk('uploads')->put('exams', $request->image);

        $exam = Exam::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'desc' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'questions_no' => $request->questions_no,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
            'img' => $path,
            'skill_id' => $request->skill_id,
            'active' => false
        ]);

        $request->session()->flash('prev', "exam/$exam->id");
        return redirect(url("dashboard/exams/create-questions/{$exam->id}"));
    }

    /**
     * Show the form for creating a new questions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function createQuestions(Exam $exam)
    {
        return view('admin.exams.create-questions', compact('exam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function storeQuestions(Request $request, Exam $exam)
    {
        $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:500',
            'option_1s' => 'required|array',
            'option_1s.*' => 'required|string|max:255',
            'option_2s' => 'required|array',
            'option_2s.*' => 'required|string|max:255',
            'option_3s' => 'required|array',
            'option_3s.*' => 'required|string|max:255',
            'option_4s' => 'required|array',
            'option_4s.*' => 'required|string|max:255',
            'right_anss' => 'required|array',
            'right_anss.*' => 'required|integer|in:1,2,3,4',
        ]);

        for ($i = 0; $i < $exam->questions_no; $i++) { 
            Question::create([
                'title' => $request->titles[$i],
                'option_1' => $request->option_1s[$i],
                'option_2' => $request->option_2s[$i],
                'option_3' => $request->option_3s[$i],
                'option_4' => $request->option_4s[$i],
                'right_ans' => $request->right_anss[$i],
                'exam_id' => $exam->id,
            ]);
        }

        $exam->active = true;
        $exam->save();

        $request->session()->flash('msg', 'row created successfully');
        return redirect(url('dashboard/exams'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return view('admin.exams.show', compact('exam'));
    }

    /**
     * Display the Exam Questions.
     *
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function questions(Exam $exam)
    {
        $questions = $exam->questions;
        return view('admin.exams.questions', compact('questions', 'exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        $skills = Skill::all();
        return view('admin.exams.edit', compact('exam', 'skills'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Exam $exam
     * @param  Question $question
     * @return \Illuminate\Http\Response
     */
    public function editQuestion(Exam $exam, Question $question)
    {
        return view('admin.exams.edit-question', compact('exam', 'question'));
    }
    
    public function updateQuestion(Request $request, Question $question)
    {
        $request->validate([
            'title' => 'required|string|max:500',
            'option_1' => 'required|string|max:255',
            'option_2' => 'required|string|max:255',
            'option_3' => 'required|string|max:255',
            'option_4' => 'required|string|max:255',
            'right_ans' => 'required|integer|in:1,2,3,4',
        ]);

        $question->update([
            'title' => $request->title,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'right_ans' => $request->right_ans,
        ]);

        $request->session()->flash('msg', 'row updated successfully');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Exam $exam)
    {
        $path = $exam->img;

        if($request->has('image')){
            Storage::disk('uploads')->delete($path);
            $path = Storage::disk('uploads')->put('exams', $request->image);
        }

        $exam->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'desc' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
            'img' => $path,
            'skill_id' => $request->skill_id,
        ]);

        $request->session()->flash('msg', 'row updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam, Request $request)
    {
        try {
            $path = $exam->img;
            Storage::disk('uploads')->delete($path);
            $exam->questions()->delete();
            $exam->delete();
            $msg = "row deleted successfully";
        } catch (Exception $e) {
            $msg = "can't delete this row";
        }
        $request->session()->flash('msg', $msg);
        return back();
    }

    /**
     * Toggle active for exam
     *
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function toggle(Exam $exam)
    {
        if($exam->questions_no == $exam->questions()->count()){
            $exam->update([
                'active' => !$exam->active
            ]);
        }

        return back();
    }
}
