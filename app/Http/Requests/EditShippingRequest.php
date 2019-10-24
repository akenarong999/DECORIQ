<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditShippingRequest extends FormRequest
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
          'weightbaseminweight.*' => 'required_if:shipping_type,==,weight|numeric',
          'weightbasemaxweight.*' => 'required_if:shipping_type,==,weight|numeric',
          'weightbasecost.*' => 'required_if:shipping_type,==,weight|numeric',
        ];
    }
}
