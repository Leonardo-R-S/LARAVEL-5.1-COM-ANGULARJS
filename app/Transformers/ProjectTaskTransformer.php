<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 01/02/2017
 * Time: 17:00
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract 
{
    protected  $defaultIncludes = ['project'];

    public function transform(ProjectTask $projectTask){

        return [

          'id' => $projectTask->id,
          'name' => $projectTask->name,
          'project_id'    => $projectTask->project_id,
          'start_date'    => $projectTask->start_date,
          'due_date'    => $projectTask->due_date,
          'status'=> $projectTask->status

        ];
    }

    public function includeProject(ProjectTask $projectTask){

     return $this->collection($projectTask->project, new ProjectSimpleTransformer());
    }

}