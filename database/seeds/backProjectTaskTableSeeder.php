<?php

use Illuminate\Database\Seeder;

class ProjectTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Delete the data old (Deleta os dados antigos)
        //\CodeProject\Entities\Project::truncate();
//        Create new false data (Cria novos dados falsos)
        factory(\CodeProject\Entities\ProjectTask::class, 10)->create();
    }
}
