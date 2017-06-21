<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 01/02/2017
 * Time: 17:00
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;

use League\Fractal\TransformerAbstract;




//Used in Project (Usado no project)
class ProjectFileTransformer extends TransformerAbstract
{


    public function transform(ProjectFile $projectFile){

        return [
          'id' => $projectFile->id,
          'name'    => $projectFile->name,
          'extension'    => $projectFile->extension,
          'description'    => $projectFile->description,
          'project_id'=> $projectFile->project_id

        ];

    }



}
