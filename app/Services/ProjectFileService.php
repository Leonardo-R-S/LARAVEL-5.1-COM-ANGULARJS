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
use CodeProject\Validators\ProjectFileValidator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Prettus\Validator\Contracts\ValidatorInterface;


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
    protected $validator;


     public function __construct(ProjectFileRepository $repository,ProjectFileValidator $validator ,ProjectRepository $projectRepository, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->validator = $validator;


    }


//////////////////////// Initiate ProjectFile (Inicia ProjectFile) ////////////////////////////////////
    public function  createFile(array $data){
        

        try {

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);

            $projectFile = $project->files()->create($data);

            $this->storage->put($projectFile->getFileName(), $this->filesystem->get($data['file']));

            return $projectFile;

        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];

        }


    }

    public function  indexFile($id){



        return $this->repository->findWhere(['project_id'=>$id]);


    }
    public function  showFile($id, $fileId){

        try {
            return $this->repository->find($fileId);

        } catch (\Exception $e) {
            return ['error' => true, 'Desculpe  mas nao foi possivel carregar este Arquivo'];

        }



    }
    public function update($data, $fileId)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);



            return $this->repository->update($data, $fileId);
        }catch (ValidatorException $e){

                return [
                    'error' => true,
                    'message' => $e->getMessageBag()
                ];

        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao aterar o arquivo.'];
        }

    }

    public function getFilePath($id){
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseURL($projectFile);
    }

    public function getFileName($id){
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $projectFile->getFileName();
    }

    public function getBaseURL($projectFile){
        switch ($this->storage->getDefaultDriver()){
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix().'/'.$projectFile->getFileName();
        }


    }

    public function destroy($fileId)
    {

        try {

            $file =  $this->repository->skipPresenter()->find($fileId);


           if($this->storage->exists($file->getFileName())){

                $this->storage->delete($file->getFileName());
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