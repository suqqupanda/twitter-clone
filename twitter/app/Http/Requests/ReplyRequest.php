<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'reply' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'reply.required' => 'リプライは必須項目です。',
            'reply.string' => 'リプライは文字列で入力してください。',
            'reply.max' => 'リプライは100文字以内で入力してください。',
        ];
    }
}