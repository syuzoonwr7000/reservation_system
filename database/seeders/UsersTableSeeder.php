<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {//role,1=開発者 2=管理者 3=一般ユーザー
        User::insert([
            'name' => '開発',
            'email' => 'developer@email.com',
            'password' => password_hash('12341234', PASSWORD_DEFAULT),
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        User::insert([
            'name' => '管理者',
            'email' => 'admin@email.com',
            'password' => password_hash('12341234', PASSWORD_DEFAULT),
            'role' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        User::insert([
            'name' => '一般ユーザー',
            'email' => 'user@email.com',
            'password' => password_hash('12341234', PASSWORD_DEFAULT),
            'role' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
