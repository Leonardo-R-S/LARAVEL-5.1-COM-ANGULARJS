<?php

namespace CodeProject\Http\Controllers;


use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Http\Request;



class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @var ClientRepository
     */
    //Declares this variable as private (Declara essa variavel como privad)
    private $repository;
    /**
     * @var ClientService
     */
    //Declares this variable as private (Declara essa variavel como privad)
    private $service;


    //Construct method where '$this->repository' receive values the interface 'ClientRepository' and add the service 'ClientService'
    //Constroi função onde o metodo '$this->repository' recebe os valores do interface 'ClientRepository' e adiciona o cerviço 'ClientService'
    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    // Call interfece ClientRepository (Chamo a interface clientRepository)
    public function index()
    {
       
//     Return array with data (Retorn um array com dados)
       return $this->repository->all();
    }


    public function store(Request $request)
    {
//      Receives data and save the database (Recebe os dados e salva no banco de dados)
        //nota: Get all values this method '$request->all()' and send from class 'ClientService' function 'create'
        //nota: Aqui pegamos todos os valores com o metodo '$request->all()' e enviamos para o a classe 'ClientService' na função 'create'.
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

//      Returns the value of the id (Retorna o valor do id)
        return $this->service->show($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        Retrieves the data of the client to according to ID and save the changes(Recupera os dados do cliente de acordo com ID e salva as alterações feitas)
       return $this->service->update($request->all(), $id);

       //Old method (Método antigo)
        //$updateClient = $this->repository->find($id);
        //$updateClient -> __construct($request->all());
        //$updateClient ->save();
        //return $updateClient;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return 'teste';
        return $this->service->destroy($id);

        //Old method (Método antigo)
        //Client::find($id)->delete();
    }



}