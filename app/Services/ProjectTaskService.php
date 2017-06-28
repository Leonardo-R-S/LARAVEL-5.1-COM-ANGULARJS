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
use CodeProject\Repositories\ProjectTaskRepository;

use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class ProjectTaskService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */
    protected $validator;

    protected $projectRepository;

    protected $projectMembers;



    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator, ProjectRepository $projectRepository, ProjectMembersRepository $projectMembers)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->projectMembers = $projectMembers;
        $this->projectRepository = $projectRepository;


    }
//Function resposible for recover data from 'projectTask' and 'project'(Função responsavel por recuperar dados do 'project','project')
    public function index($id)
    {
                $projectTask[] = $this->repository->with('project')->findWhere(['project_id' => $id]);
                return $projectTask;

    }
//Function resposible for validate and create new register (Função responsavel por validar e criar novo registro)
    public function create(array $data)
    {


        try{
            
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);


            return $this->repository->create($data);
        }catch (ValidatorException $e){

            return [
                'error'=> true,
                'message'=>$e->getMessageBag()
            ];

        }

    }

//Function resposible for recover data from 'projectTask'(Função responsavel por recuperar dados do 'projectTask')
    public function show($id){

        try {
            return $this->repository->find($id);
        } catch (\Exception $e) {
            return ['error'=>true, 'Desculpe mas nao foi possivel carregar este Projeto Task'];

        }
    }

//Function resposible for validate and update register(Função responsavel por validar e atualizar registro)
    public function update(array $data, $id)
    {

        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            return $this->repository->skipPresenter()->update($data, $id);

        } catch (ValidatorException $e) {

            return [
                'error'=> true,
                'message'=>$e->getMessageBag()
            ];


        }catch (\Exception $e) {
            return ['error'=>true, 'Desculpe, mas nao foi modificar esta Project Task, verifique se esta Project Task existe.'];
        }
    }

    public function destroy($id)
    {

        try {
            $this->repository->skipPresenter()->find($id)->delete();
            return ['success'=>true, 'Projeto Task deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Projeto Task não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto Task não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o Projeto Task.'];
        }
    }

    //////////////////////// Initiate access validation (Inicia validação de acesso) ////////////////////////////////////
    public function checkProjectOwner($projectID){

        $userId = \Authorizer::getResourceOwnerId();

        return $this->projectRepository->isOwner($projectID, $userId);


    }
    public function checkProjectMember($projectID){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->projectRepository->hasMember($projectID, $userId);
    }


    public  function checkProjectPermissions($projectID){
        if($this->checkProjectOwner($projectID)or $this->checkProjectMember($projectID)){
            return true;
        }
        return false;
    }



}