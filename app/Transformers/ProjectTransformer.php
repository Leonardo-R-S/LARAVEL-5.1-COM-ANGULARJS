<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 01/02/2017
 * Time: 17:00
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use CodeProject\Repositories\ProjectTaskRepository;
use League\Fractal\TransformerAbstract;




//Used in Project (Usado no project)
class ProjectTransformer extends TransformerAbstract
{

    protected  $defaultIncludes = ['members'];
    public function transform(Project $project){

        return [
          'project_id' => $project->id,
          'name'    => $project->name,
          'client_id'    => $project->client_id,
          'owner_id'    => $project->owner_id,
          'description'=> $project->description,
          'progress'   => $project->progress,
          'status'     => $project->status,
          'due_date'   => $project->due_date,
        ];

    }


    public function includeMembers(Project $project){
           
            return $this->collection($project->members, new ProjectMemberTransformer());

    }
}
