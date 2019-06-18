<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'pos_title'    => 'required|unique:posts,pos_title,' . $this->pos_id . ',pos_id',
            'upload_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pos_teaser'   => 'required',
            'pos_content'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'pos_title.required'   => 'Tiêu đề không được trống',
            'pos_title.unique'     => 'Tiêu đề bài viết bị trùng',
            'pos_teaser.required'  => 'Mô tả không được để trống',
            'pos_content.required' => 'Nội dung không được trông',
            'upload_image.image'   => 'File phải là ảnh',
            'upload_image.max'     => 'Dung lượng file quá lớn',
        ];
    }
}
