<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodeProject\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

    $factory->define(CodeProject\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
       'responsible' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->paragraphs(3,true)

    ];
});
$factory->define(CodeProject\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => rand(1,10),
        'client_id' => rand(1,10),
        'name'=> $faker->name,
        'description'=>$faker->sentences(3,true),
        'progress' => rand(1,100),
        'status' =>rand(1,3),
        'due_date' => $faker->date('Y-m-d')

    ];
});

$factory->define(CodeProject\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,10),
        'title' => $faker->word,
        'note'=> $faker->paragraph,
    ];
});
$factory->define(CodeProject\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'name'=> $faker->name,
        'project_id' => rand(1,10),
        'start_date' => $faker->date('Y-m-d'),
        'due_date' => $faker->date('Y-m-d'),
        'status' =>rand(1,3)

    ];
});


$factory->define(CodeProject\Entities\ProjectMembers::class, function (Faker\Generator $faker) {
    return [

        'project_id' => rand(1,10),
        'user_id' => rand(1,10),
    ];
});

$factory->define(CodeProject\Entities\OAuthClient::class, function (Faker\Genegitrator $faker) {
    return [
        'id'=> 'appid1',
        'secret' =>  'secret',
        'name' =>  'AngularAPP'
    ];
});
