<?php

namespace Modules\Rbac\App\Http\Controllers;

use App\Http\Controllers\Controller;

class RoleManagementController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rbac::pages.role-management.index');
    }
}
