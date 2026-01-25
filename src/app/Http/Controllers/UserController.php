<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|integer',
        ]);

        // 年齢チェック
        if ($request->age < 20) {
            return back()->with('error', '20歳未満は登録できません');
        }

        // ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'password' => bcrypt('password'),
        ]);

        // 初期設定（仮）
        // ここに「初回ポイント付与」とか増えていく想定

        return redirect('/users')->with('success', '登録完了');
    }
}

