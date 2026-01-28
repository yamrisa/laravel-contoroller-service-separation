<?php

namespace App\Http\Controllers;

// use App\Models\User;
// UserModelを使う責任をUserServiceへ移行
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function store(Request $request)
    public function store(Request $request, UserService $userService)
    {
        // バリデーション
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|integer',
        ]);

        // // 年齢チェック
        // if ($request->age < 20) {
        //     return back()->with('error', '20歳未満は登録できません');
        // }

        // // ユーザー作成
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'age' => $request->age,
        //     'password' => bcrypt('password'),
        // ]);

        // 上記の処理はServiceに移行、今後も増えるならUserRegisterService作成してユースケースごとに
        try {
            $userService->create($request->all());
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }


        return redirect('/users')->with('success', '登録完了');
    }
}

