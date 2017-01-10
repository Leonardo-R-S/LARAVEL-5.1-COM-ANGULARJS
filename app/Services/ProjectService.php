<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 30/12/2016
 * Time: 14:45
 */

namespace CodeProject\Services;



use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;



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

    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

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

}