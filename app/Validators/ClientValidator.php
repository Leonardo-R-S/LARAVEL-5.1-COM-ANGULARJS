<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 27/12/2016
 * Time: 14:19
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
      'name' => 'required|max:255',
      'email' => 'required|email',
      'phone' => 'required',
      'address' => 'required'
    ];
}