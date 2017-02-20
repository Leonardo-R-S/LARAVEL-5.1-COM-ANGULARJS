<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectTask extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'project_task';

    protected $fillable = [
            'name',
            'project_id',
            'start_date',
            'due_date',
            'status'


    ];


    public function project(){
        return $this->belongsToMany(Project::class,'project_task','project_id' );
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id');
    }

}
