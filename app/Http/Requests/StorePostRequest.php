<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title'=>'required',
            'category_id'=>'required',
            'description'=>'required',
            'requirements'=>'required',
            'responsibilities'=>'required',
            'benefits'=>'required',
            'location'=>'required',
            'work_type'=>'required',
            'min_salary'=>'required',
            'max_salary'=>'required',
            'application_deadline'=>'required',
            'technologies'=>'required',
        ];
    }
}
