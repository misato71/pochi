<?php

namespace App\Http\Controllers;

use Facades\App\UserQuestionnaire;
use Carbon\Carbon;
use Facades\App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
//新規会員登録
    public function sendEmail(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->get('email');
        $token = Str::random(50);
        User::verifyEmail($email, $token);
        return redirect()->route('register_sent');
    }

    public function verifyToken($token){
        $user = User::where('email_verify_token', $token)->first();
        if($user){
            session()->put('register_user', $user);
            return view('member');
        }else{
            abort(403);
        }
    }

    public function member(Request $request){
        $now = Carbon::now();
        $request->validate([
            'nickname' => 'required|max:20',
            'password' => 'required|min:7|regex:/^[a-zA-Z0-9]+$/|confirmed',
            'last_name' => 'required|string|max:20',
            'first_name' => 'required|string|max:20',
            'last_name_kana' => 'required|string|max:20',
            'first_name_kana' => 'required|string|max:20',
            'birthday' => 'required|date_format:Y-m-d|before_or_equal:' . $now->format('Y-m-d'),
        ],[
            'password.regex' => '7文字以上の半角英数字で入力'
        ]); 
        $user = session()->get('register_user');
        if(!$user)
            abort(401);

        User::member(
            $user,
            $request->get('nickname'),
            $request->get('password'),
            $request->get('last_name'),
            $request->get('first_name'),
            $request->get('last_name_kana'),
            $request->get('first_name_kana'),
            $request->get('birthday')
        );
        session()->forget('register_user');

        return redirect()->route('member_sent');

    }
//ログイン
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);
        $credentials['status'] = 1;
        if(Auth::attempt($credentials)){
            // 認証に成功した
            return redirect()->route('mypage');
        }else{
            return redirect()->back()->with('message', 'メールアドレスまたはパスワードが違います');
        }

    }
//ログアウト
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
//パスワード変更
    public function passwordReset(Request $request){
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:7|regex:/^[a-zA-Z0-9]+$/|confirmed',
        ],[
            'new_password.regex' => '7文字以上の半角英数字で入力'
        ]);

        $user = Auth::user();
        if(Hash::check($request->get('password'), $user->password)){
            $user->password = Hash::make($request->get('new_password'));
            $user->save();
            return view('password_sent');
        }else{
            return redirect()->back()->with('message', 'パスワードが違います');
        }

    }
//パスワード再設定
    public function tokenNew(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        if($user){
            $token = Str::random(50);
            User::tokenNew($user, $token);  
        }
        return redirect()->route('register_sent');
    }
   
    public function verifyPassword($token){
        $user = User::where('email_verify_token', $token)->first();
        if($user){
            session()->put('password_user', $user);
            return view('password_new');
        }else{
            abort(403);
        }
    }

    public function passwordNew(Request $request){
        $request->validate([
            'new_password' => 'required|min:7|regex:/^[a-zA-Z0-9]+$/|confirmed',
        ],[
            'new_password.regex' => '7文字以上の半角英数字で入力'
        ]);

        $user = session()->get('password_user');
        if(!$user)
            abort(401);

        User::passwordNew($user, $request->get('new_password'));
        session()->forget('password_user');
        
        return redirect()->route('password_sent');

    }
//退会-アンケート保存
    public function questionnaire(Request $request){
        $request->validate([
            'content' => 'max:1000',
        ]);

        $user = Auth::user();
        if($request->get('questionnaire')){
            $questionnaire = $request->get('questionnaire');
        }

        if($request->get('content')){
            $content = $request->get('content');
        }

        UserQuestionnaire::questionnaire(
            $user->id,
            $questionnaire,
            $content,
        );

        return redirect()->route('cansel_password');
    }
//パスワード確認－退会
    public function canselPasswordVerify(Request $request){
        $user = Auth::user();
        if(Hash::check($request->get('password'), $user->password)){
            $user->status = 99;
            $user->save();
            Auth::logout();
            return view('cansel_the_member_sent');
        }else{
            return redirect()->back()->with('message', 'パスワードが正しくありません');
        }

    }

//本人情報編集
    public function passwordVerify(Request $request){
        $user = Auth::user();
        if(Hash::check($request->get('password'), $user->password)){
            return view('member_edit');
        }else{
            return redirect()->back()->with('message', 'パスワードが正しくありません');
        }

    }

    public function memberUpdate(Request $request){
        $now = Carbon::now();
        $request->validate([
            'last_name' => 'required|string|max:20',
            'first_name' => 'required|string|max:20',
            'last_name_kana' => 'required|string|max:20',
            'first_name_kana' => 'required|string|max:20',
            'birthday' => 'required|date_format:Y-m-d|before_or_equal:' . $now->format('Y-m-d'),
        ]);

        $user = Auth::user();
        $user->last_name = $request->get('last_name');
        $user->first_name = $request->get('first_name');
        $user->last_name_kana = $request->get('last_name_kana');
        $user->first_name_kana = $request->get('first_name_kana');
        $user->birthday = $request->get('birthday');
        $user->save();

        return redirect()->route('completion');
    }

}
