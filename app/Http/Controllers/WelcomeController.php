<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class welcomeController extends Controller
{
    public function welcome ()
    {
        return 'Welcome to Api';
    }
    public function hello()
    {
        return "hello my dear";
    }
};
