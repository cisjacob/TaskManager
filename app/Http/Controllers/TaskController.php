<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateStatusTaskRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Auth::user()->assignedTasks()
        ->with(['creator' => function($query){
            $query->select('id', 'name');
        }])->select('id', 'name', 'admin_id', 'description', 'status', 'created_at')
        ->get();

        return view('contents.tasks.index')->with('tasks', $tasks);
        // return $tasks;
    }

    public function create()
    {
        $users = User::where('role', 'User')->pluck('name', 'id');
        return view('contents.tasks.create')->with('users', $users);
    }

    public function store(TaskRequest $request)
    {
        try {
            Task::create([
                'name' => $request->name,
                'description' => $request->description,
                'assigned_user_id' => $request->assigned_user_id,
                'status' => 'Pending',
                'admin_id' => Auth::id()
            ]);
    
            return redirect()->route('admin.dashboard')->with('success', 'Task has been successfully created.');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }

    }

    public function show($id)
    {
        //
    }

    public function edit(Task $task)
    {
        $users = User::where('role', 'User')->pluck('name', 'id');
        return view('contents.tasks.edit')->with('task', $task)->with('users', $users);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $task->update([
                'assigned_user_id' => $request->assigned_user_id,
                'name' => $request->name,
                'description' => $request->description
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Task has been updated');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function editStatus(Task $task){
        return view('contents.tasks.edit-status')->with('task', $task);
    }

    public function updateStatus(UpdateStatusTaskRequest $request, Task $task){
        try {
            $task->update([
                'status' => $request->status
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task has been updated');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return back()->with('success', 'Task has been deleted');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

}
