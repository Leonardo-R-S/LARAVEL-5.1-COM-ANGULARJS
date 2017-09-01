<?php

namespace CodeProject\Http\Middleware;

use Closure;

use CodeProject\Services\PermissionsService;




class CheckProjectPermission
{


    /**
     * The Guard implementation.
     *
     * @var ProjectService
     */
    private $service;





    public function __construct(PermissionsService $service )
    {

        $this->service = $service;



    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       $projectId = $request->route('id') ? $request->route('id') : $request->route('project');

       
        if ($this->service->checkProjectPermissions($projectId)== false) {

            return ['error'=> 'You haven\'t permission to access project'];
            //return redirect('/');
        }

        return $next($request);
    }
}
