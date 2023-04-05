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
    {
        User::insert([
            'name' => '開発',
            'email' => 'devloper@email.com',
            'password' => password_hash('12341234', PASSWORD_DEFAULT),
            'role' => 1,
        ]);
        
        User::insert([
            'name' => '管理者',
            'email' => 'admin@email.com',
            'password' => password_hash('12341234', PASSWORD_DEFAULT),
            'role' => 2,
        ]);
    }
}
