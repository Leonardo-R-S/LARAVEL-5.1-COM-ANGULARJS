<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\PermissionsService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;



class ProjectController extends Controller
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

    private $PermissionsService;




    public function __construct(ProjectRepository $repository,ProjectService $service, PermissionsService $PermissionsService)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->PermissionsService = $PermissionsService;
        $this->middleware('oauth');
        $this->middleware('check-project-owner',['except'=>['index','store','show']]);
        $this->middleware('check-project-permission',['except'=>['index','store','update','destroy']]);

    }

    public function index()
    {

//     Restrives data function 'index' in 'ProjectService'  (Recupera os dados da função index)
        return $this->repository->findOwner(\Authorizer::getResourceOwnerId(),6);
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
    public function show($id)
    {

       
        if($this->PermissionsService->checkProjectPermissions($id)==false){
           return ['error'=>'Access forbidden'];
       }else{
//      Returns the value of the id (Retorna o valor do id)
        return $this->service->show($id);
       }
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
      
        if($this->PermissionsService->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
//        Retrieves the data of the project to according to ID and save the changes(Recupera os dados do project de acordo com ID e salva as alterações feitas)
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
       

        if($this->PermissionsService->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
//      Retrieves the data of the project and delete (Recupera os dados e os deleta)
        return $this->service->destroy($id);
    }

//////////////////////// Initiate ProjectMembers (Inicia ProjectMembers) ////////////////////////////////////    
    
    public function showmembers($id)
    {
        if($this->PermissionsService->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
        return $this->service->showmembers($id);
    }
    public function isMember($id, $memberId)
    {

        if($this->PermissionsService->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }

        return $this->service->isMember($id, $memberId);
    }

    public function storemembers(Request $request)
    {

        if($this->PermissionsService->checkProjectPermissions($request->project_id)==false){
            return ['error'=>'Access forbidden'];
        }
        return  $this->service->addMember($request->all());
    }


    public function destroymembers($id, $memberId)
    {

        
        if($this->PermissionsService->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
        return $this->service->destroymembers($memberId);

    }

}
