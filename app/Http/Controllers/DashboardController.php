<?php

namespace App\Http\Controllers;

use inertia\inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(){
        return inertia::render('Dashboard');
    }
}
