<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TasksResource;
use Database\Factories\TaskFactory;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TasksResource::collection(Task::all());
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
        //$faker = \Faker\Factory::create(1);
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->sentence,
            'file_url' => $request->url,
        ]);
        
        return new TasksResource($task);
        //return 'POST route';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return new TasksResource($task);
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

        $my_task = Task::find($task->id);
        $my_task->update($request->all());
        return $my_task;
        //return 'PUT|PATCH route';
        // $status = ['backlog', 'in_progress', 'waiting_customer_approval', 'approved'];
        // $req_index = array_search($request->input('status'), $status);
        // $task_index = array_search($task->status, $status);
        // if ($req_index == ($task_index + 1)){
        //     //return 'Era pra dar certo';
        //     $task->update([
        //         'status' => $request->input('status'),
        //     ]);
        //     return new TasksResource($task);
        // }else{
        //     return 'Update could not be done.';
        // };
        
        //return new TasksResource($task);
        //return $task->status;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function patch(UpdateTaskRequest $request, Task $task)
    {
        //return 'PUT|PATCH route';
        $status = ['backlog', 'in_progress', 'waiting_customer_approval', 'approved'];
        $req_index = array_search($request->input('status'), $status);
        $task_index = array_search($task->status, $status);
        if ($req_index == ($task_index + 1)){
            //return 'Era pra dar certo';
            $task->update([
                'status' => $request->input('status'),
            ]);
            return new TasksResource($task);
        }else{
            return 'Update could not be done.';
        };
        
        //return new TasksResource($task);
        //return $task->status;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function file(Task $task)
    {
        $res = Response()->json([
            'data' => [
                'file_url' => $task->file_url
            ]
        ]);

        $msg = Response()->json([
            'data' => [
                'message' => 'Status is not approved.'
            ]
        ]);

        if($task->status === 'approved'){
            return $res;
        }else{
            return $msg;
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $res = Response()->json([
            'data' => [
                'message' => 'No delete route was needed.'
            ]
        ]);
        return $res;
    }
}
