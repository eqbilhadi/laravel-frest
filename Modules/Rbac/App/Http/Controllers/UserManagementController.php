<?php

namespace Modules\Rbac\App\Http\Controllers;

use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rbac::pages.user-management.index');
    }
}
