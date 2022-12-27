<?php

namespace App\Http\Requests\Admin\Exam;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',
            'skill_id' => 'required|exists:skills,id'
        ];
    }
}
