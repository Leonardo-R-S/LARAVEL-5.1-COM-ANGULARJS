<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 30/12/2016
 * Time: 14:45
 */

namespace CodeProject\Services;



use CodeProject\Repositories\ProjectMembersRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectMembersValidator;
use CodeProject\Validators\ProjectValidator;


use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;



class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */
    protected $validator;

    protected $membersRepository;

    protected $membersValidator;

    protected $filesystem;

    protected $storage;


     public function __construct(ProjectRepository $repository, ProjectMembersRepository $membersRepository, ProjectValidator $validator, ProjectMembersValidator $membersValidator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->membersRepository = $membersRepository;
        $this->membersValidator = $membersValidator;

    }
//Function resposible for recover data from 'project','user' and 'client'(Função responsavel por recuperar dados do 'project','usuario' e 'cliente')
    public function index(){
        return $this->repository->with('user')->with('client')->all();

   }
//Function resposible for validate and create new register (Função responsavel por validar e criar novo registro)
    public function create(array $data)
    {

        try{
            
            $this->validator->with($data)->passesOrFail();


            return $this->repository->create($data);
        }catch (ValidatorException $e){

            return [
                'error'=> true,
                'message'=>$e->getMessageBag()
            ];

        }
    }
//Function resposible for recover data from 'project'(Função responsavel por recuperar dados do 'project')
    public function show($id){

        try {
            return $this->repository->find($id);
        } catch (\Exception $e) {
            return ['error'=>true, 'Desculpe mas nao foi possivel carregar este projeto'];

        }
    }


//Function resposible for validate and update register(Função responsavel por validar e atualizar registro)
    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data, $id);

        } catch (ValidatorException $e) {

            return [
                'error'=> true,
                'message'=>$e->getMessageBag()
            ];

        }catch (\Exception $e) {
            return ['error'=>true, 'Desculpe, mas nao foi modificar este projeto, verifique se este projeto existe.'];

        }

    }

    public function destroy($id)
    {
        try {
            $this->repository->find($id)->delete();
            return ['success'=>true, 'Projeto deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o projeto.'];
        }
    }

//////////////////////// Initiate ProjectMembers (Inicia ProjectMembers) ////////////////////////////////////


    public function showmembers($id){

        try {
            return $members = $this->repository->with('members')->find($id);
           // return $members = $this->repository->with('members')->find($id);

        } catch (\Exception $e) {
            return [
                'error'=> true,
                'message'=>$e->getMessage()
            ];
        }
    }
    public function isMember($id, $membersId){


           $val = $this->membersRepository->with('user')->findWhere(['project_id'=>$id, 'user_id'=>$membersId]);
        if (count($val) == null ) {
            return [
                'error' => true,
                'message' => "Membro $membersId nao encontrado no Projeto $id",
            ];
        }else{ return $val; }
    }


    public function addMember(array $data)
    {
        try{

            $this->membersValidator->with($data)->passesOrFail();

            return $this->membersRepository->create($data);
        }catch (ValidatorException $e){

            return [
                'error'=> true,
                'message'=>$e->getMessageBag()
            ];

        }
    }

    public function destroymembers($id, $membersId)
    {

        try {


            $project = $this->repository->skipPresenter()->find($id);
            $project->members()->delete($membersId);

            return ['success'=>true, 'Membro do projeto deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return [
                'error'=> true,
                'message'=>$e->getMessage()
            ];
        }
    }

//////////////////////// Initiate ProjectFile (Inicia ProjectFile) ////////////////////////////////////
    public function  createFile(array $data){

        $project = $this->repository->skipPresenter()->find($data['project_id']);

        $projectFile = $project->files()->create($data);

        $this->storage->put($projectFile->id.".".$data['extension'], $this->filesystem->get($data['file']));
    }

    public function  indexFile($id){
        return $this->repository->skipPresenter()->with('files')->find($id);
    }
    public function  showFile($id, $fileId){

        $project = $this->repository->skipPresenter()->find($id);
        return $project->files()->find($fileId);


    }

    //Function resposible for validate and update register(Função responsavel por validar e atualizar registro)
    public function updateFile(array $data, $fileId)
    {
        return $data;

        return  $project = $this->repository->skipPresenter()->find($data['project_id']);

        return  $projectFile = $project->files()->update($data, $fileId);

        //$this->storage->put($projectFile->id.".".$data['extension'], $this->filesystem->get($data['file']));

           // return $this->repository->update($data, $id);


    }


}