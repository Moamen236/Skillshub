<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10);
        $data['cats'] = Cat::select('id', 'name')->get();
        return view('admin.skills.index')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'required|image',
            'cat_id' => 'required|exists:cats,id',
        ]);

        $path = Storage::disk('uploads')->put('skills', $request->img); //file('img')

        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $path,
            'cat_id' => $request->cat_id,
        ]);

        $request->session()->flash('msg', 'row created sucessfully');
        return back();
    }

    public function delete(Skill $skill, Request $request)
    {
        try {
            $skill->delete();
            $msg = "row deleted sucessfully";
        } catch (Exception $e) {
            $msg = "can't delete this row";
        }
        $request->session()->flash('msg', $msg);
        return back();
    }
}