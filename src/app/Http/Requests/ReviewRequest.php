<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'evaluate' => 'required',
            'review_comment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'evaluate.required' => '星の数を入力してください',
            'review_comment.required' => 'コメントを入力してください'
        ];
    }
}
