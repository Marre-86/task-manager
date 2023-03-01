<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::paginate(15);
        return view('task_status.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()) {
            abort(403);
        }
        $taskStatus = new TaskStatus();
        return view('task_status.create', ['task_status' => $taskStatus]);
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
            'required' => 'Поле "имя" обязательно для заполнения'
        ];
        $data = $this->validate($request, [
            'name' => 'required'], $customMessages);
        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();
        flash("Статус \"{$request->name}\" был добавлен");
        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        if (!Auth::user()) {
            abort(403);
        }
        $taskStatus = TaskStatus::findOrFail($taskStatus->id);
        return view('task_status.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        if (!Auth::user()) {
            abort(403);
        }
        $taskStatus = TaskStatus::findOrFail($taskStatus->id);
        $customMessages = [
            'required' => 'Поле "имя" обязательно для заполнения'
        ];
        $data = $this->validate($request, [
            'name' => 'required'], $customMessages);
        $taskStatus->fill($data);
        $taskStatus->save();
        flash("Статус \"{$request->name}\" был обновлён");
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        //
    }
}
