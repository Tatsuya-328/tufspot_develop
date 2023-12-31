<?php

namespace App\Http\Requests\GaigokaiMember;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'id' => ['required', 'string', 'unique:gaigokai_members,id'],
            'phone_number' => ['required', 'regex:/^\+?[0-9]{1,15}$/', 'unique:gaigokai_members,phone_number']
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
