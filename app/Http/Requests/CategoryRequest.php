<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name_en'=>'required',
            'name_ar'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name_en.required' => 'Name is required',
            'name_ar.required' => 'يرجى ادخال الاسم',
            'name_en.unique' => 'Name is already taken',
            'name_ar.unique' => 'هذا الاسم موجود مسبقا',
        ];
    }
}
