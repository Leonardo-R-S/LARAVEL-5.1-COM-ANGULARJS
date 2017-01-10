<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Entities\ProjectNote;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Http\Request;



class ProjectNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @var ProjectRepositoryEloquent
     */
//  Declares this variable as private (Declara essa variavel como privad)
    private $repository;
//Declares this variable as private (Declara essa variavel como privad)
    private $service;


    public function __construct(ProjectNoteRepository $repository,ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;

    }


    public function index($id)
    {
//     Restrives data function 'index' in 'ProjectService'  (Recupera os dados da função index)
        return $this->repository->findWhere(['project_id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 //      Receives data and save the database (Recebe os dados e salva no banco de dados)
        //nota: Get all values this method '$request->all()' and send from class 'ProjectService' function 'create'
        //nota: Aqui pegamos todos os valores com o metodo '$request->all()' e enviamos para o a classe 'ProjectService' na função 'create'.
      return  $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $noteId)
    {
//      Returns the value of the id (Retorna o valor do id)
        return $this->repository->findWhere(['project_id'=>$id, 'id'=>$noteId]);
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
//        Retrieves the data of the project to according to ID and save the changes(Recupera os dados do project de acordo com ID e salva as alterações feitas)
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($noteId)
    {
        $valDependente = ProjectNote::find($noteId);
        $valDependente -> delete();
        return 'Excluido';

//      Retrieves the data of the project and delete (Recupera os dados e os deleta)
       // return $this->repository->delete($noteId);
    }
}
