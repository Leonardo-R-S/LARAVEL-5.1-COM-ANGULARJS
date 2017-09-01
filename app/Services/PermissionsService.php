<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 30/12/2016
 * Time: 14:45
 */

namespace CodeProject\Services;



use CodeProject\Repositories\ProjectRepository;

class PermissionsService
{


    /**
     * @var ProjectRepository
     */
    protected $repository;



    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;

    }


    

    //////////////////////// Initiate access validation (Inicia validação de acesso) ////////////////////////////////////
    public function checkProjectOwner($projectID)
    {
       
        $userId = \Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projectID, $userId);


    }


    public function checkProjectMember($projectID)
    {

        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectID, $userId);
    }


    public function checkProjectPermissions($projectID)
    {

        if ($this->checkProjectOwner($projectID) or $this->checkProjectMember($projectID)) {
            return true;
        }
        return false;
    }





}