<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseFromRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name_en' => ['nullable','string', 'unique:courses,name_en,NULL,id,deleted_at,NULL'],
                        'name_bn' => ['required', 'string', 'unique:courses,name_bn,NULL,id,deleted_at,NULL'],
                        'picture' => ['required', 'max:2048'],
                        'purpose_en' => ['nullable'],
                        'purpose_bn' => ['required'],
                        'method_en' => ['nullable'],
                        'method_bn' => ['required'],
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name_en' => ['nullable','string', 'unique:courses,name_en,'.\request()->input("id").',id,deleted_at,NULL'],
                        'name_bn' => ['required', 'string', 'unique:courses,name_bn,'.\request()->input("id").',id,deleted_at,NULL'],
                        'picture' => ['max:2048'],
                        'purpose_en' => ['nullable'],
                        'purpose_bn' => ['required'],
                        'method_en' => ['nullable'],
                        'method_bn' => ['required'],
                    ];
                }
            default:
                break;
        }
    }
}
