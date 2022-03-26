<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get entire tree
        $tasks = Task::where('parent_task_id',null)
                ->where(function($query) {
                    $query->where('completion','>',date("Y-m-d",mktime(0,0,0,date("m"),date("d")-3,date("Y"))))
                          ->orWhereNull('completion');
                })
                ->orderBy('completion')->orderBy('due')->get();
        return $tasks->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        //
        $input = $request->validated();
        $task = new Task();
        $task->fill($input);
        $task->save();
        $subtasks = $task->subtasks;
        return $task;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
        $input = $request->validated();
        $task->fill($input);
        $task->save();
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        if (isset($_GET['movesubs'])) {
            if ($_GET['movesubs'] == 1) {
                Task::where('parent_task_id', $task->id)->update(['parent_task_id' => $task->parent_task_id]);
            }
        }
        $task->delete();
        return $task;
    }
}
