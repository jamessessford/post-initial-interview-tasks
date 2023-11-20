<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Note;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        dd($task->notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Task  $task
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, Note $note)
    {
        dd($note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, Note $note)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, Note $note)
    {
        // 
    }
}
