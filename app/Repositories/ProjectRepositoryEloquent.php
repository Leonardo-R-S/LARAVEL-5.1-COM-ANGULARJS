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
use CodeProject\Presenters\ProjectPresenter;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Project::class;
    }

    public function isOwner($projectId, $userId){

        if(count($this->skipPresenter()->findWhere(['id'=>$projectId, 'owner_id'=>$userId]))){
            return true;
        }
        return false;
    }
    public function hasMember($projectId, $memberId){

        $project = $this->skipPresenter()->find($projectId);
        foreach ($project->members as $member){

            if($member->id == $memberId){
                return true;
            }
        }
        return false;
    }

    public function presenter(){
        return ProjectPresenter::class;
    }
}