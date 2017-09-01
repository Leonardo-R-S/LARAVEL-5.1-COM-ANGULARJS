<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 30/12/2016
 * Time: 14:45
 */

namespace CodeProject\Services;



use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;


class ProjectNoteService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */
    protected $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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

//Function resposible for recover data from 'Nota'(Função responsavel por recuperar dados do 'Nota')
    public function show($id, $noteId){

        try {

            
              $result = $this->repository->skipPresenter()->findWhere(['id'=>$noteId,'project_id'=>$id]);
             if(isset($result['data'])&& count($result['data'])==1){
                 $result = ['data' => $result['data'][0]];
             };
             return $result;
        } catch (\Exception $e) {
            return ['error'=>true, 'Desculpe mas nao foi possivel carregar esta nota'];

        }
    }

//Function resposible for validate and update register(Função responsavel por validar e atualizar registro)
    public function update(array $data, $id)
    {

        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->skipPresenter()->update($data, $id);

        } catch (ValidatorException $e) {

            return [
                'error'=> true,
                'message'=>$e->getMessageBag()
            ];


        }catch (\Exception $e) {
            return ['error'=>true, 'Desculpe, mas nao foi modificar esta Nota, verifique se esta Nota existe.'];
        }
    }
   

}