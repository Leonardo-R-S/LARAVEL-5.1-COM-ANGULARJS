<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 30/12/2016
 * Time: 16:45
 */

namespace CodeProject\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [

        ValidatorInterface::RULE_CREATE => [
            'name'=> 'required|max:255',
            'description'=> 'required',
            'file'=> 'required|mimes:jpeg,jpg,png,gif,pdf',
            'project_id'=> 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'=> 'required|max:255',
            'description'=> 'required',
            'project_id'=> 'required',
        ]





    ];
}