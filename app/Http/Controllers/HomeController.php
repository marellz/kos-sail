<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function help ()
    {
        return inertia('help/index');
    }

    public function docs ()
    {
        return inertia('docs/index');
    }
}
