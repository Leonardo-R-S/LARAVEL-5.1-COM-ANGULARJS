<?php

namespace CodeProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;

use \Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        'name'=> 'required|max:255',
        'project_id' => 'required',
        'start_date'=> 'required',
        'due_date'=> 'required',
        'status'=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
        'name'=> 'required|max:255',
        'start_date'=> 'required',
        'due_date'=> 'required',
        'status'=> 'required'
        ]
    ];
}
