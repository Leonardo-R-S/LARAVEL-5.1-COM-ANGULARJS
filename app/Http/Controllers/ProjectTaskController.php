<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Repositories\ProjectTaskRepository;


use CodeProject\Services\ProjectTaskService;
use Illuminate\Http\Request;


use CodeProject\Http\Controllers\Controller;

class ProjectTaskController extends Controller
{
   
   private $repository;

    private $service;
    private $projectRepository;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service, ProjectRepository $projectRepository)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->projectRepository = $projectRepository;

        $this->middleware('oauth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//     Restrives data function 'index' in 'ProjectService'  (Recupera os dados da função index)

        return $this->service->index();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
 {
     if($this->checkProjectPermissions($request->project_id)==false){
         return ['error'=>'Access forbidden'];
     }

  //      Receives data and save the database (Recebe os dados e salva no banco de dados)
  //nota: Get all values this method '$request->all()' and send from class 'ProjectTaskService' function 'create'
  //nota: Aqui pegamos todos os valores com o metodo '$request->all()' e enviamos para o a classe 'ProjectTaskService' na função 'create'.
    return  $this->service->create($request->all());
 }

 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idProject = $this->repository->skipPresenter()->find($id);

        if($this->checkProjectPermissions($idProject->project_id)==false){
            return ['error'=>'Access forbidden'];
        }

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

     if($this->checkProjectPermissions($request->project_id)==false){
         return ['error'=>'Access forbidden'];
     }


//        Retrieves the data of the projectTask to according to ID and save the changes(Recupera os dados do projectTask de acordo com ID e salva as alterações feitas)
  return $this->service->update($request->all(), $id);
 }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idProject = $this->repository->skipPresenter()->find($id);

        if($this->checkProjectPermissions($idProject->project_id)==false){
            return ['error'=>'Access forbidden'];
        }

//      Retrieves the data of the projectTask and delete (Recupera os dados e os deleta)
     return $this->service->destroy($id);
    }

    //////////////////////// Initiate access validation (Inicia validação de acesso) ////////////////////////////////////
    private function checkProjectOwner($projectID){

        $userId = \Authorizer::getResourceOwnerId();
        return $this->projectRepository->isOwner($projectID, $userId);


    }
    private function checkProjectMember($projectID){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->projectRepository->hasMember($projectID, $userId);
    }


    private  function checkProjectPermissions($projectID){
        if($this->checkProjectOwner($projectID)or $this->checkProjectMember($projectID)){
            return true;
        }
        return false;
    }

}
