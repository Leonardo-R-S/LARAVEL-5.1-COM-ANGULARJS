<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'name',
        'responsible',
        'email',
        'phone',
        'address',
        'obs'

    ];
}
