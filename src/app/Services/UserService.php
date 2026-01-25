<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create(array $data): User
    {
        // 年齢チェック
        if ($data['age'] < 20) {
            throw new \Exception('20歳未満は登録できません');
        }

        // ユーザー作成
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'age' => $data['age'],
            'password' => bcrypt('password'),
        ]);
    }
}
