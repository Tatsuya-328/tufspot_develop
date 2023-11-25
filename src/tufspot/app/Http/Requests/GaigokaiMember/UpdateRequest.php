<?php

namespace App\Http\Requests\GaigokaiMember;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
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
        $validate = [
            'id' => [
                'sometimes',
                'required',
                'string',
                Rule::unique('gaigokai_members', 'id')->ignore($this->gaigokaiMember->id)
            ],
            'phone_number' => [
                'sometimes',
                'required',
                'regex:/^\+?[0-9]{1,15}$/',
                Rule::unique('gaigokai_members', 'phone_number')->ignore($this->gaigokaiMember->id)
            ]
        ];

        return $validate;
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id.unique' => 'すでに登録されている外語会 ID です。',
            'phone_number.unique' => 'すでに登録されている電話番号です。',
            'phone_number.regex' => '電話番号は、先頭のみ記号 + を許容し、以降は数字を 15 桁まで指定できます（ITU-T E.164 に準拠）。',
        ];
    }
}
