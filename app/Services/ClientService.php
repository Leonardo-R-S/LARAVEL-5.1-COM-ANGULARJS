<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 27/12/2016
 * Time: 11:29
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{
    /**
     * @var ClientRepository
     */

    protected $repository;

    /**
     * @var ClientValidator
     */
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->repository = $repository;

        $this->validator = $validator;
    }
//Function resposible for validate and create new register (Função responsavel por validar e criar novo registro)
    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);

        } catch (ValidatorException $e) {

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
            return ['error'=>true, 'Desculpe mas nao foi possivel carregar este Cliente'];

        }
    }

//Function resposible for validate and update register(Função responsavel por validar e atualizar registro)
    public function  update(array $data, $id)
    {
    
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
            
        }catch (ValidationException $e){
            return [
                'error'=> true,
                'message'=>$e->getMessageBag()
            ];
        }catch (\Exception $e) {
            return ['error'=>true, 'Desculpe, mas nao foi modificar este Cliente, verifique se este Cliente existe.'];

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