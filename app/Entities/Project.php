<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
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
}
