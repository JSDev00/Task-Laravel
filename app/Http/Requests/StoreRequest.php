<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'desc_en'=>'required',
            'desc_ar'=>'required',
            'image'=>'nullable',
            'price'=>'required',
            'quantity'=>'required',
            'category'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'product_en.required' => trans('product_trans.required_en'),
            'product_ar.required' => trans('product_trans.required_ar'),
            'desc_en.required' => trans('product_trans.required'),
            'desc_ar.required' => trans('product_trans.required'),
            'price.required' => trans('product_trans.required'),
            'quantity.required' => trans('product_trans.required'),
            'category.required' => trans('product_trans.required'),
        ];
    }
}
