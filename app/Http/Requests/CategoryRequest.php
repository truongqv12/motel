<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'cat_name' => 'required|unique:categories,cat_name,' . $this->route('category') . ',cat_id',
        ];
    }

    public function messages()
    {
        return [
            'cat_name.required' => 'Tên danh mục không được để trống',
            'cat_name.unique' => 'Tên danh mục đã tồn tại',
        ];
    }
}
