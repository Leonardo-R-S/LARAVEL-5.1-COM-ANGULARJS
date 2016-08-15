<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Delete the data old (Deleta os dados antigos)
       \CodeProject\Client::truncate();
//        Create new false data (Cria novos dados falsos)
        factory(\CodeProject\Client::class, 10)->create();
    }
}
