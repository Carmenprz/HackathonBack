<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create([
            'name' => $request->name, 
            'date' => $request->date, 
            'hour' => $request->hour, 
            'repetition_frequency' => $request->repetition_frequency, 
            'advice' => $request->advice, 
            'end_message' => $request->end_message,
            'user_id' => $request->user_id,
        ]);
        
        $task->save();

        return response()->json($task, 201);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $task = Task::find($id);

        $task->update([
            'name' => $request->name, 
            'date' => $request->date, 
            'hour' => $request->hour, 
            'repetition_frequency' => $request->repetition_frequency, 
            'advice' => $request->advice, 
            'end_message' => $request->end_message,
            'user_id' => $request->user_id,
        ]);

        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $task = Task::find($id);

        $task->delete();

        return response()->json(['message' => 'tarea eliminada correctamente'], 202);
        
    }


}
