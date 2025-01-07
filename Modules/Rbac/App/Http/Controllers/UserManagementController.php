<?php

namespace Modules\Rbac\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Authentication\App\Models\ComUser;

class UserManagementController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rbac::pages.user-management.index');
    }

    public function create()
    {
        return view('rbac::pages.user-management.form');
    }

    public function edit(ComUser $comUser)
    {
        return view('rbac::pages.user-management.form', [
            "user" => $comUser
        ]);
    }
}
