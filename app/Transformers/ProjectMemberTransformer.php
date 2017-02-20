<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 01/02/2017
 * Time: 17:00
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform(User $member){

        return [
          'member_id' => $member->id,
          'name'    => $member->name

        ];
    }

}