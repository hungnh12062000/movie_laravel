<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $path_view_controller = 'admin.dashboard.';
    private $controller_name      = 'dashboard';

    public function __construct()
    {

        view()->share('controller_name', $this->controller_name);
    }

    public function index(){
        return view($this->path_view_controller.'index');
    }

    public function slider(){
        return view('admin.slider.index');
    }
}
