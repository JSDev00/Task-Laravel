<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'product_en'=>'required',
            'product_ar'=>'required',
            'description_en'=>'required',
            'description_ar'=>'required',
            'product_price'=>'required',
            'image'=>'nullable',
            'product_qunatity'=>'required',
            'category_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'product_en.required' => trans('product_trans.required_en'),
            'product_ar.required' => trans('product_trans.required_ar'),
            'description_en.required' => trans('product_trans.required'),
            'description_ar.required' => trans('product_trans.required'),
            'product_price.required' => trans('product_trans.required'),
            'product_qunatity.required' => trans('product_trans.required'),
            'category_id.required' => trans('product_trans.required'),
        ];
    }
}
