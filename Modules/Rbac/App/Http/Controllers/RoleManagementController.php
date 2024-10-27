<?php

namespace Modules\Rbac\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Rbac\App\Models\ComRole;

class RoleManagementController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rbac::pages.role-management.index');
    }

    public function create()
    {
        return view('rbac::pages.role-management.form');
    }

    public function edit(ComRole $comRole)
    {   
        return view('rbac::pages.role-management.form', [
            "role" => $comRole
        ]);
    }
}
