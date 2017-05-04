<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 01/02/2017
 * Time: 17:00
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    public function transform(Client $client){

        return [
            'id'=>$client->id,
            'name'=>$client->name,
            'email'=>$client->email,
            'responsible'=>$client->responsible,
            'phone'=>$client->phone,
            'address'=>$client->address,
            'obs'=>$client->obs

        ];
    }

}