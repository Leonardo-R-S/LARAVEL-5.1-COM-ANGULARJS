<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 16/08/2016
 * Time: 16:48
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ClientPresenter;

//I implements interface ClientRepository
//Estou implementando a interface ClientRepository
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    protected $fieldSearchable = [
        'name'
    ];

    public function model()
    {
        // TODO: Implement model() method.
        return Client::class;
    }


    public function presenter(){
        return ClientPresenter::class;
    }

    public function boot(){
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }
}