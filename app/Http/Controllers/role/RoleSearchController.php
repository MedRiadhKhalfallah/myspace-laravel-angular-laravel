<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleSearchController extends Controller
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleCreateRequest $request
     * @return Illuminate\Http\Request
     */
    public function store(Request $request)
    {
//        var_dump($request);die;
//        return $request->all();
//        return json_decode($request->all());
        $roles = $this->roleRepository->searchWithCriteria($request->all());
        return $roles;
    }

}
