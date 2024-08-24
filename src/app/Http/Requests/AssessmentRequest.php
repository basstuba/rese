<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentRequest extends FormRequest
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
            'shop_id' => 'required',
            'count' => 'required',
            'assessment_comment' => 'required|max:400',
            'imagePhoto' => 'mimes:jpeg,png|nullable',
        ];
    }

    public function messages()
    {
        return [
            'count.required' => '星の数を入力してください',
            'assessment_comment.required' => 'コメントを入力してください',
            'imagePhoto.mimes' => 'jpeg画像又はpng画像を使用してください',
        ];
    }
}
