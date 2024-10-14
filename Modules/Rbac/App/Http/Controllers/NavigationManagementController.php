<?php

namespace Modules\Rbac\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Rbac\App\Models\ComMenu;

class NavigationManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rbac::pages.navigation-management.index');
    }
    
    public function create()
    {
        return view('rbac::pages.navigation-management.form');
    }

    public function edit(ComMenu $comMenu)
    {   
        return view('rbac::pages.navigation-management.form', [
            "menu" => $comMenu
        ]);
    }
}
