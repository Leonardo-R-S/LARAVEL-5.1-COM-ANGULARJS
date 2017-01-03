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

//      Call the Seed UserTableSeeder(Chama a seed UserTableSeeder)
        $this->call(UserTableSeeder::class);

//      Call the Seed ClientTableSeeder(Chama a seed ClientTableSeeder)
        $this->call(ClientTableSeeder::class);


//      Call the Seed ProjectTableSeeder(Chama a seed ProjectTableSeeder)
        $this->call(ProjectTableSeeder::class);

        Model::reguard();
    }
}
