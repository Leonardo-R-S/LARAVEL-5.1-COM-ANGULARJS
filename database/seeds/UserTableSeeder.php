<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Delete the data old (Deleta os dados antigos)
        CodeProject\Entities\User::truncate();
//        Create new false data (Cria novos dados falsos)
        factory(\CodeProject\Entities\User::class)->create([
            'name' => 'leo',
            'email' => 'leo@leo.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);
        factory(\CodeProject\Entities\User::class, 10)->create();
    }
}
