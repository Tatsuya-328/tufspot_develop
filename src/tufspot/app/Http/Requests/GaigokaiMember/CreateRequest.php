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
            'id' => ['required', 'string'],
            'phone_number' => ['required', 'regex:/^\+?[0-9]{1,15}$/'],
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
            'phone_number.regex' => '電話番号は、先頭のみ記号 + を許容し、以降は数字を 15 桁まで指定できます（ITU-T E.164 に準拠）。',
        ];
    }
}
