<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 28/12/2016
 * Time: 17:10
 */

namespace CodeProject\Repositories;



use CodeProject\Entities\ProjectFile;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectFilePresenter;

class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return ProjectFile::class;
    }



    public function presenter(){
       return ProjectFilePresenter::class;
    }
}