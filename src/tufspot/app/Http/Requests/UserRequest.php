<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * バリデーション前の処理
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // 更新時パスワードがない場合項目削除
        if ($this->isMethod('put')) {
            if (!$this->password) {
                $this->offsetUnset('password');
                $this->offsetUnset('password_check');
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validate = [
            // 'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->user)],
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
            'password_check' => 'required|string',
            'phone_number' => 'required|string',
        ];

        // 更新時はパスワード必須ではない
        if ($this->isMethod('put')) {
            $validate['password'] = 'nullable|string';
            $validate['password_check'] = 'nullable|string';
        }

        return $validate;
    }


}
