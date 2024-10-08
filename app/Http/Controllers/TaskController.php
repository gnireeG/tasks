<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Request $request){
        return Inertia::render('Tasks', [
            'tasks' => auth()->user()->tasks,
        ]);
    }
}
