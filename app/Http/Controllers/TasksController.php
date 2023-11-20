<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(25);

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $developers = Developer::all();
        $task_statuses = TaskStatus::all();
        $types = [
            \App\Models\Bug::class,
            \App\Models\Feature::class,
        ];

        return view('tasks.create', [
            'developers' => $developers,
            'task_statuses' => $task_statuses,
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            ...$request->all(),
            'user_id' => $request->user()->id,
        ];

        $task = Task::create($data);

        return view('tasks.edit', [
            'task' => $task,
            'notes' => $task->notes,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
            'notes' => $task->notes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $developers = Developer::all();
        $task_statuses = TaskStatus::all();
        $types = [
            \App\Models\Bug::class,
            \App\Models\Feature::class,
        ];

        return view('tasks.edit', [
            'developers' => $developers,
            'task' => $task,
            'task_statuses' => $task_statuses,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // @see: "A Task status should only be able to move in the following transitions:"
        if (! ($request->task_status_id >= $task->task_status_id))
        {
            return back()->withErrors([
                'task_status_id' => 'Can not change status to a prior stage.',
            ]);
        }

        Task::update($request);

        return $this->edit($task->fresh());
    }
}
