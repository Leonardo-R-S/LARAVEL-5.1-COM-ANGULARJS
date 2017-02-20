<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\CodeProject\Entities\OAuthClient::class)->create();

        /*factory(\CodeProject\Entities\OAuthClient::class)->create([
            'id'=>'appid1',
            'secret' => 'secret',
            'name' => 'AngularAPP',

        ]);*/

    }
}
