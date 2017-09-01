<?php

namespace CodeProject\Http\Controllers;



use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectFileService;
use CodeProject\Services\PermissionsService;
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
    private $PermissionsService;

    public function __construct(ProjectFileRepository $repository,ProjectRepository $projectRepository, ProjectFileService $service, PermissionsService $PermissionsService)
    {
        $this->projectRepository = $projectRepository;
        $this->repository = $repository;
        $this->service = $service;
        $this->PermissionsService = $PermissionsService;
        $this->middleware('oauth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {


        if($this->PermissionsService->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
        
        return $this->service->indexFile($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        if($this->PermissionsService->checkProjectPermissions($request->project_id)==false){

            
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

    public function showFile($id){
        if($this->PermissionsService->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
        $filePath = $this->service->getFilePath($id);
        $fileContent = file_get_contents($filePath);
        
        $file64 = base64_encode($fileContent);
        return [
            'file'=> $file64,
            'size'=>filesize($filePath),
            'name'=>$this->service->getFileName($id)
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $fileId)
    {
        if($this->PermissionsService->checkProjectPermissions($id)==false){
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
        if($this->PermissionsService->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }


        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['project_id'] = $request->project_id;
        return $this->service->update($data, $fileId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $fileId)
    {


        if($this->PermissionsService->checkProjectPermissions($id)==false){
            return ['error'=>'Access forbidden'];
        }
        return $this->service->destroy($fileId);
    }
   
}
