<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate(50);
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()) {
            abort(403);
        }
        $label = new Label();
        return view('label.create', compact('label'));
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
            'required' => __('validation.required_name')
        ];
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable'], $customMessages);
        $label = new Label();
        $label->fill($data);
        $label->save();
        flash(__('flashes.label_added', ['label' => $request->name]));
        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        if (!Auth::user()) {
            abort(403);
        }
        $label = Label::findOrFail($label->id);
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        if (!Auth::user()) {
            abort(403);
        }
        $label = Label::findOrFail($label->id);
        $customMessages = [
            'required' => __('validation.required_name')
        ];
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable'], $customMessages);
        $label->fill($data);
        $label->save();
        flash(__('flashes.label_updated', ['label' => $request->name]));
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if (!Auth::user()) {
            abort(403);
        }
        $label = Label::findOrFail($label->id);

        if ($label->tasks->isNotEmpty()) {
            flash(__('flashes.label_non-deleted', ['label' => $label->name]))->error();
            return redirect()->route('labels.index');
        }

        if ($label) {
            $label->delete();
        }
        flash(__('flashes.label_deleted', ['label' => $label->name]));
        return redirect()->route('labels.index');
    }
}
