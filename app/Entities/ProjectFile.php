<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $table = 'Project_files';

//Autorizes entry array data (Autoriza a entada de dados num array)
    protected $fillable = [
    'name',
    'description',
    'extension',
    'project_id',

    ];
//Forengkey project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getFileName()
    {
        return $this->id.'.'.$this->extension;
    }

}
