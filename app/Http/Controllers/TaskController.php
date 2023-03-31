<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statuses = TaskStatus::all()->sortBy('id')
            ->mapWithKeys(function ($item, $key) {
                return [$item['id'] => $item['name']];
            })->all();
        $users = User::all()->sortBy('id')
            ->mapWithKeys(function ($item, $key) {
                return [$item['id'] => $item['name']];
            })->all();

        $filter = $request->query('filter');

        if ($filter !== null) {
            $query = Task::query();
            if ($filter['status_id']) {
                $query->where('status_id', $filter['status_id']);
            }
            if ($filter['created_by_id']) {
                $query->where('created_by_id', $filter['created_by_id']);
            }
            if ($filter['assigned_to_id']) {
                $query->where('assigned_to_id', $filter['assigned_to_id']);
            }
            $tasks = $query->orderBy('id')->paginate(25);
            return response()->view('task.index', ['tasks' => $tasks, 'statuses' => $statuses,
                                                   'users' => $users, 'filter' => $filter]);
        }

        $tasks = Task::orderBy('id')->paginate(25);
        return response()->view('task.index', ['tasks' => $tasks, 'statuses' => $statuses,
                                               'users' => $users]);
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
        $statuses = TaskStatus::all()->sortBy('id')
            ->mapWithKeys(function ($item, $key) {
                return [$item['id'] => $item['name']];
            })->all();
        $users = User::all()->sortBy('id')
            ->mapWithKeys(function ($item, $key) {
                return [$item['id'] => $item['name']];
            })->all();
        $labels = Label::all()->sortBy('id')
            ->mapWithKeys(function ($item, $key) {
                return [$item['id'] => $item['name']];
            })->all();

        return view('task.create', ['task' => $task, 'statuses' => $statuses,
                                    'users' => $users, 'labelsDB' => $labels,]);
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
            'name.required' => __('validation.required_name'),
            'name.unique' => __('validation.unique_entity', ['entity' => 'Задача']),
            'status_id.required' => __('validation.required_status')
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tasks',
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

        if (($request->input('labels')) !== null) {
            $labelIDs = array_filter($request->input('labels'));
            $task->labels()->attach($labelIDs);
        }

        flash(__('flashes.task_added', ['task' => $request->name]));
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
        $statuses = TaskStatus::all()->sortBy('id')
            ->mapWithKeys(function ($item, $key) {
                return [$item['id'] => $item['name']];
            })->all();
        $users = User::all()->sortBy('id')
            ->mapWithKeys(function ($item, $key) {
                return [$item['id'] => $item['name']];
            })->all();
        $labels = Label::all()->sortBy('id')
            ->mapWithKeys(function ($item, $key) {
                return [$item['id'] => $item['name']];
            })->all();

        return view('task.edit', ['task' => $task, 'statuses' => $statuses,
                                    'users' => $users, 'labelsDB' => $labels]);
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
            'name.required' => __('validation.required_name'),
            'name.unique' => __('validation.unique_entity', ['entity' => 'Задача']),
            'status_id.required' => __('validation.required_status')
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tasks,name,' . $task->id,
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

        if (($request->input('labels')) !== null) {
            $task->labels()->detach();
            $labelIDs = array_filter($request->input('labels'));
            $task->labels()->attach($labelIDs);
        }

        flash(__('flashes.task_updated', ['task' => $request->name]));
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
            $task->labels()->detach();
            $task->delete();
        }
        flash(__('flashes.task_deleted', ['task' => $task->name]));
        return redirect()->route('tasks.index');
    }
}
