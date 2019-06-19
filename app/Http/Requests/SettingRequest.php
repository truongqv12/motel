<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::guard('admin')->user()->add == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function rules()
    {
        return [
            'label' => 'required',
            'key'   => 'required|unique:setting_website,key,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'label.required' => 'Tiêu đề không được trống',
            'key.unique'     => 'Key đã tồn tại',
            'key.required'   => 'Key không được trống',
        ];
    }
}
