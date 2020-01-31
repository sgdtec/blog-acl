<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ademir Bastiani',
            'email' => 'adebastiani@gmail.com',
            'password' => bcrypt('123'),
            'bibliograply' => 'Usuário Anonymous'
        ]);
    }
}
