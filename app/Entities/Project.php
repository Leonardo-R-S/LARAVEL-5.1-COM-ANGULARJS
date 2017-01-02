<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Porject extends Model
{
    protected $fillable = [
    'owner_id',
    'client_id',
    'name',
    'description',
    'progress',
    'status',
    'due_date'
    ];
}
