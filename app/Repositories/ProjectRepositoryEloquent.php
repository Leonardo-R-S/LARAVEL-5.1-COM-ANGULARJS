<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 28/12/2016
 * Time: 17:10
 */

namespace CodeProject\Repositories;



use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Project::class;
    }
}