<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\GaigokaiMember;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (empty(GaigokaiMember::where('member_id', $data['member_id'])->where('phone_number', $data['phone_number'])->first())) {
            // 会員IDと電話番号の組み合わせが一致するか確認
            $data['member_id'] = null;
            $data['phone_number'] = null;

            $rulus = [
                'member_id' => ['exists:gaigokai_members,member_id'],
                'phone_number' => ['exists:gaigokai_members,phone_number'],
            ];
            
            $message = [
                'member_id.exists' => '入力に誤りがあるか、外語会IDと電話番号の組み合わせが一致していません。',
                'phone_number.exists' => '入力に誤りがあるか、外語会IDと電話番号の組み合わせが一致していません。',
            ];

            return Validator::make($data, $rulus, $message);
        }

        return Validator::make($data, [
            // 会員IDと電話番号が存在するか確認
            'member_id' => ['required', 'string', 'exists:gaigokai_members,member_id'],
            'phone_number' => ['required', 'string', 'exists:gaigokai_members,phone_number'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // ここで外部キーとしてgaigokai_idを入れる
        $gaigokai_member = GaigokaiMember::where('member_id', $data['member_id'])->where('phone_number', $data['phone_number'])->first();
        return User::create([
            'gaigokai_id' => $gaigokai_member['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'password' => bcrypt($data['password']),
        ]);
    }
}
