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


    protected $membersRepository;

    protected $membersValidator;



    public function __construct(ProjectRepository $repository, ProjectMembersRepository $membersRepository, ProjectValidator $validator, ProjectMembersValidator $membersValidator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->membersRepository = $membersRepository;
        $this->membersValidator = $membersValidator;


    }

//Function resposible for recover data from 'project','user' and 'client'(Função responsavel por recuperar dados do 'project','usuario' e 'cliente')
    public function index()
    {

        return $this->repository->with('user')->with('client')->all();

    }

//Function resposible for validate and create new register (Função responsavel por validar e criar novo registro)
    public function create(array $data)
    {

        try {

            $this->validator->with($data)->passesOrFail();


            return $this->repository->create($data);
        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];

        }
    }

//Function resposible for recover data from 'project'(Função responsavel por recuperar dados do 'project')
    public function show($id)
    {

        try {
            return $this->repository->find($id);
        } catch (\Exception $e) {
            return ['error' => true, 'Desculpe  mas nao foi possivel carregar este projeto'];

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
                'error' => true,
                'message' => $e->getMessageBag()
            ];

        } catch (\Exception $e) {
            return ['error' => true, 'Desculpe, mas nao foi modificar este projeto, verifique se este projeto existe.'];

        }

    }

    public function destroy($id)
    {

        try {
            $this->repository->skipPresenter()->find($id)->delete();
            return ['success' => true, 'Projeto deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error' => true, 'Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao excluir o projeto.'];
        }
    }





//////////////////////// Initiate ProjectMembers (Inicia ProjectMembers) ////////////////////////////////////


    public function showmembers($id)
    {

        try {
            //return $members = $this->repository->with('members')->find($id);
             return $members = $this->membersRepository->with('user')->findWhere(['project_id' => $id]);

        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function isMember($id, $membersId)
    {


        $val = $this->membersRepository->with('user')->find($membersId);
        if (count($val) == null) {
            return [
                'error' => true,
                'message' => "Membro $membersId nao encontrado no Projeto $id",
            ];
        } else {
            return $val;
        }
    }


    public function addMember(array $data)
    {
        try {

            $this->membersValidator->with($data)->passesOrFail();

            return $this->membersRepository->create($data);
        } catch (ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];

        }
    }

    public function destroymembers($membersId)
    {

        try {



                $this->membersRepository->skipPresenter()->find($membersId)->delete();

           /* $project = $this->repository->skipPresenter()->find($id);
            $project->members()->delete($membersId);*/

            return ['success' => true, 'Membro do projeto deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error' => true, 'Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }





}