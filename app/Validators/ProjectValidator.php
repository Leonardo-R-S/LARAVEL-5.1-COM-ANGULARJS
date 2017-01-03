<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 30/12/2016
 * Time: 16:45
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'owner_id' => 'required',
        'client_id'=> 'required',
        'name'=> 'required|max:255',
        'description'=> 'required',
        'progress'=> 'required',
        'status'=> 'required',
        'due_date'=> 'required'
    ];
}