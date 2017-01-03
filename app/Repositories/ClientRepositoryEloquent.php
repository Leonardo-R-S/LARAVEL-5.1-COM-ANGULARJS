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

//I implements interface ClientRepository
//Estou implementando a interface ClientRepository
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Client::class;
    }


}