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
        \Log::info('Посещение списка статусов');
        $taskStatuses = TaskStatus::orderBy('id')->paginate(20);
        return view('task_status.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $taskStatus = new TaskStatus();
        return view('task_status.create', compact('taskStatus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $customMessages = [
            'required' => __('validation.required_name'),
            'unique' => __('validation.unique_entity', ['entity' => 'Статус'])
        ];
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses'], $customMessages);
        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();
        flash(__('flashes.status_added', ['status' => $request->name]));
        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        if (Auth::user() === null) {
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
        if (Auth::user() === null) {
            abort(403);
        }
        $taskStatus = TaskStatus::findOrFail($taskStatus->id);
        $customMessages = [
            'required' => __('validation.required_name'),
            'unique' => __('validation.unique_entity', ['entity' => 'Статус'])
        ];
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name,' . $taskStatus->id], $customMessages);
        $taskStatus->fill($data);
        $taskStatus->save();
        flash(__('flashes.status_updated', ['status' => $request->name]));
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $taskStatus = TaskStatus::findOrFail($taskStatus->id);

        if ($taskStatus->tasks->isNotEmpty()) {
            flash(__('flashes.status_non-deleted', ['status' => $taskStatus->name]))->error();
            return redirect()->route('task_statuses.index');
        }

        $taskStatus->delete();

        flash(__('flashes.status_deleted', ['status' => $taskStatus->name]));
        return redirect()->route('task_statuses.index');
    }
}
