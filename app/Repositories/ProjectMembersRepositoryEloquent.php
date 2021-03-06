<?php

namespace CodeProject\Repositories;

use CodeProject\Presenters\ProjectMemberPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Repositories\ProjectMembersRepository;
use CodeProject\Entities\ProjectMembers;
use CodeProject\Validators\ProjectMembersValidator;


/**
 * Class ProjectMembersRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectMembersRepositoryEloquent extends BaseRepository implements ProjectMembersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
   

    public function model()
    {
        return ProjectMembers::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /*public function presenter(){
        return ProjectMemberPresenter::class;
    }*/
   
}
