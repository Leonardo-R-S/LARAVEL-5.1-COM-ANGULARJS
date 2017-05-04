<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 16/08/2016
 * Time: 16:48
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;


//I implements interface ClientRepository
//Estou implementando a interface ClientRepository
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return User::class;
    }


   /* public function presenter(){
        return ClientPresenter::class;
    }*/
}