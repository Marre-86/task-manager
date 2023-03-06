<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(5);
        return response()->view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()) {
            abort(403);
        }
        $task = new Task();
        $statuses = TaskStatus::all()->sortBy('id');
        $users = User::all()->sortBy('id');
        $label_options = ['null', 'ошибка', 'документация', 'документ', 'доработка'];

        return view('task.create', ['task' => $task, 'statuses' => $statuses,
                                    'users' => $users, 'label_options' => $label_options]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()) {
            abort(403);
        }

        $customMessages = [
            'name.required' => 'Поле "имя" обязательно для заполнения',
            'status_id.required' => 'Необходимо указать статус'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
            'description' => 'nullable',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect(route('tasks.create'))
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = $validator->validated();
        $task = new Task();
        $task->fill($data);
        $task->created_by_id = Auth::id();
        $task->save();

        flash("Задача \"{$request->name}\" была добавлена");
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task = Task::findOrFail($task->id);
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if (!Auth::user()) {
            abort(403);
        }
        $statuses = TaskStatus::all()->sortBy('id');
        $users = User::all()->sortBy('id');
        $label_options = ['null', 'ошибка', 'документация', 'документ', 'доработка'];

        return view('task.edit', ['task' => $task, 'statuses' => $statuses,
                                    'users' => $users, 'label_options' => $label_options]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (!Auth::user()) {
            abort(403);
        }
        $task = Task::findOrFail($task->id);

        $customMessages = [
            'name.required' => 'Поле "имя" обязательно для заполнения',
            'status_id.required' => 'Необходимо указать статус'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
            'description' => 'nullable',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect(route('tasks.edit', $task))
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = $validator->validated();
        $task->fill($data);
        $task->save();

        flash("Задача \"{$request->name}\" была обновлена");
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (!Auth::user() or (Auth::id() !== $task->created_by->id)) {
            abort(403);
        }
        $task = Task::findOrFail($task->id);
        if ($task) {
            $task->delete();
        }
        flash("Задача \"{$task->name}\" была удалена");
        return redirect()->route('tasks.index');
    }
}
