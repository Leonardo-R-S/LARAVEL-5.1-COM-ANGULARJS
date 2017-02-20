<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 30/12/2016
 * Time: 14:45
 */

namespace CodeProject\Services;




use CodeProject\Repositories\ProjectFileRepository;


use CodeProject\Repositories\ProjectRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;



class ProjectFileService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */


    protected $filesystem;
    private $projectRepository;
    protected $storage;


     public function __construct(ProjectFileRepository $repository,ProjectRepository $projectRepository, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
        $this->filesystem = $filesystem;
        $this->storage = $storage;


    }


//////////////////////// Initiate ProjectFile (Inicia ProjectFile) ////////////////////////////////////
    public function  createFile(array $data){


        $project = $this->projectRepository->skipPresenter()->find($data['project_id']);

        $projectFile = $project->files()->create($data);

        $this->storage->put($projectFile->id.".".$data['extension'], $this->filesystem->get($data['file']));
    }

    public function  indexFile($id){

        return $this->repository->findWhere(['project_id'=>$id]);


    }
    public function  showFile($id, $fileId){


        return $this->repository->find($fileId);

    }
    public function update($request, $fileId)
    {
        try {

            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['project_id'] = $request->project_id;

            return $this->repository->update($data, $fileId);



        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao aterar o arquivo.'];
        }



    }

    public function destroy($fileId)
    {

        try {
            $file =  $this->repository->skipPresenter()->find($fileId);


           if($this->storage->delete($file->id.'.'.$file->extension)){
               $this->repository->find($fileId)->delete();
           }else{
               return ['success'=>true, 'Desculpe não foi possivel excluir o arquivo.'];
           }


            return ['success'=>true, 'Arquivo deletado com sucesso.'];

        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o arquivo.'];
        }



          
    }

}