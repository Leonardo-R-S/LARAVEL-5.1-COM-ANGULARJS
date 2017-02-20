<?php

namespace CodeProject\Http\Controllers;



use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectFileService;
use Illuminate\Http\Request;



use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    private $projectRepository;
    private $repository;
    private $service;

    public function __construct(ProjectFileRepository $repository,ProjectRepository $projectRepository, ProjectFileService $service)
    {
        $this->projectRepository = $projectRepository;
        $this->repository = $repository;
        $this->service = $service;
        $this->middleware('oauth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if($this->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
        return $this->service->indexFile($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        try {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            $data['file'] = $file;
            $data['extension'] = $extension;
            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['project_id'] = $request->project_id;

            $this->service->createFile($data);

            return ['success'=>true, 'Arquivo salvo com sucesso.'];

        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao salvar o arquivo.'];
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $fileId)
    {
        if($this->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
        return $this->service->showFile($id, $fileId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, $fileId)
    {
        if($this->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
        return $this->service->update($request, $fileId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $fileId)
    {
        if($this->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
        return $this->service->destroy($fileId);
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
