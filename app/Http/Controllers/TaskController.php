<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate(5);
        return response()->view('task.index', compact('tasks'));
    }
}
