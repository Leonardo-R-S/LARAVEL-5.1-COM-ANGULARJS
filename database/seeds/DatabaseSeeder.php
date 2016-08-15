<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//      Call the Seed ClientTableSeeder(Chama a seed ClientTableSeeder)
        $this->call(ClientTableSeeder::class);

        Model::reguard();
    }
}
