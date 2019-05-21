<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->add == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email:email|max:255|unique:admin_user,email',
            'username' => 'required|min:5|max:50|unique:admin_user,username',
            'password' => 'required|min:5|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'email.max' => 'Không vượt quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'loginname.required' => 'Tên đăng nhập không được để trống',
            'loginname.min' => 'Tên đăng nhập quá ngắn',
            'loginname.max' => 'Tên đăng nhập quá dài',
            'loginname.unique' => 'Tên đăng nhập đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password.min' => 'Mật khẩu quá ngắn',
        ];
    }
}
