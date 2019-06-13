<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotelRoomRequest extends FormRequest
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
            'title'       => 'required',
            'price'       => 'required',
            'area'        => 'required|numeric',
            'address'     => 'required|min:4',
            'phone'       => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được trống',
            'phone.required' => 'Số điện thoại không được trống',
            'price.required' => 'Giá thuê không được trông',
            'area.required'  => 'Diện tích không được trông',
        ];
    }
}
