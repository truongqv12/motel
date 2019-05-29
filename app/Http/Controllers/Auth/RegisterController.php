<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone'    => 'min:9| max:11',
        ], [
            'name.required'      => 'Họ tên không được để trống',
            'email.required'     => 'Email không được để trống',
            'email.email'        => 'Email không đúng',
            'email.unique'       => 'Email đã tồn tại trên hệ thông',
            'password.required'  => 'Bạn chưa nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password.min'       => 'Mật khẩu quá ngắn',
            'phone.min'          => 'Số điện thoại không đúng',
            'phone.max'          => 'Số điện thoại không đúng',
        ]);
    }

    protected function create(array $data)
    {
        return \App\Models\User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
            'phone'    => $data['phone'],
        ]);
    }
}
