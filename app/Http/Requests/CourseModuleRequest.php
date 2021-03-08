<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CourseModuleRequest extends FormRequest
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
            'course_id' => ['required'],
            'title_en' => ['nullable'],
            'title_bn' => ['required'],
            'zip_file_name' => ['sometimes'],
            'minute_en' => ['required'],
            'position' => ['required'],
            'minute_bn' => ['nullable'],
            'session_title_en.*' => 'distinct',
            'session_title_bn.*' => 'distinct'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'course_id.required' => 'A course name is required',
            'title_en.required' => 'A english title is required',
            'title_bn.required' => 'A bangla title is required',
            'position.required' => 'Position is required',
            'zip_file_name.sometimes' => 'Module file is required',
            'minute_en.required' => 'Minute english is required',
            'minute_bn.required' => 'Minute bangla is required',
            'session_title_en.*.distinct' => 'Session english title should be unique',
            'session_title_bn.*.distinct' => 'Session bangla title should be unique'
        ];
    }
    public function validated() {
        $instance = $this->getValidatorInstance();
        if ($instance->fails()) {
            throw new HttpResponseException(response()->json($instance->errors(), 422));
        }
    }
}
