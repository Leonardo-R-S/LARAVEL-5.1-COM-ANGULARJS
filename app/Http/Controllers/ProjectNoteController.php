<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Entities\ProjectNote;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectNoteService;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

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

    private $service;

    private $project;

    private $projectService;


    public function __construct(ProjectRepository $project, ProjectNoteRepository $repository,ProjectNoteService $service, ProjectService $projectService)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->project = $project;
        $this->projectService = $projectService;
        $this->middleware('oauth');

    }


    public function index($id)
    {
       
        if($this->checkProjectPermissions($id)==false){
        return ['error'=>'Access forbidden'];
         }
//     Restrives data function 'index' in 'ProjectService'  (Recupera os dados da função index)
        return $this->repository->skipPresenter()->findWhere(['project_id'=>$id]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        if($this->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
 //      Receives data and save the database (Recebe os dados e salva no banco de dados)
        //nota: Get all values this method '$request->all()' and send from class 'ProjectService' function 'create'
        //nota: Aqui pegamos todos os valores com o metodo '$request->all()' e enviamos para o a classe 'ProjectService' na função 'create'.


        $data = ['project_id'=>$id,
                 'title'=> $request->title,
                 'note'=> $request->note

        ];

      return  $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $noteId)
    {
       
        if($this->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }



//      Returns the value of the id (Retorna o valor do id)
        return $this->service->show($id,$noteId);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id, $idNote)
    {


        if($this->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }

        $data = ['project_id'=>$id,
            'title'=> $request->title,
            'note'=> $request->note

        ];

//        Retrieves the data of the project to according to ID and save the changes(Recupera os dados do project de acordo com ID e salva as alterações feitas)
        return $this->service->update($data, $idNote);
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

        if($this->checkProjectPermissions($valDependente->Project->id)==false){
            return ['error'=>'Access forbidden'];
        }
        $valDependente -> delete();
        return 'Excluido';

//      Retrieves the data of the project and delete (Recupera os dados e os deleta)
       // return $this->repository->delete($noteId);
    }

    //////////////////////// Initiate access validation (Inicia validação de acesso) ////////////////////////////////////
    private function checkProjectOwner($projectID){

        $userId = \Authorizer::getResourceOwnerId();

       return $this->project->isOwner($projectID, $userId);


    }
    private function checkProjectMember($projectID){

        $userId = \Authorizer::getResourceOwnerId();
        return $this->project->hasMember($projectID, $userId);
    }


    private  function checkProjectPermissions($projectID){


        if($this->checkProjectOwner($projectID)or $this->checkProjectMember($projectID)){
            return true;
        }
        return false;
    }
}
