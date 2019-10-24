<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
          'name'=>'required',
          'short_description'=>'required',
          'long_description'=>'required',
          'parent_category_id'=>'required',
          'category_id'=>'required',
          'price' => 'required_if:product_type,==,single|integer|nullable',
          'weight' => 'required_if:product_type,==,single|numeric|nullable',
          'stock' => 'required_if:product_type,==,single|numeric|nullable',
          'variationname.*' => 'required_if:product_type,==,variable|nullable',
          'variationprice.*' => 'required_if:product_type,==,variable|integer|nullable',
          'variationweight.*' => 'required_if:product_type,==,variable|numeric|nullable',
          'variationstock.*' => 'required_if:product_type,==,variable|integer|nullable'
        ];
    }
}
