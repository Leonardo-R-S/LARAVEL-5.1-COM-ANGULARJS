<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;




class Project extends Model
{
    protected $table = 'projects';

//Autorizes entry array data (Autoriza a entada de dados num array)
    protected $fillable = [
    'owner_id',
    'client_id',
    'name',
    'description',
    'progress',
    'status',
    'due_date'
    ];
//Forengkey client
    public function client()
    {
        return $this->belongsTo('CodeProject\Entities\Client');
    }
//Forengkey user
    public function user()
    {
        return $this->belongsTo('CodeProject\Entities\User','owner_id');
    }

//Forengkey notes
    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }

    //Forengkey notes
    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }



//Forengkey members
    public function members()
    {
       return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id');
    }
    public function projectTask(){

        // return $this->hasMany(Project::class);
        return $this->belongsTo(ProjectTask::class);
    }


}
