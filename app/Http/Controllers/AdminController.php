<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $tasks = Task::with(['assignee' => function($query){
            $query->select('id', 'name');
        }, 'creator' => function($query){
            $query->select('id', 'name');
        }])->select('id', 'name', 'assigned_user_id', 'admin_id', 'description', 'status', 'created_at')
        ->get();

        // return $tasks;
        return view('contents.admin.dashboard')->with('tasks', $tasks);
    }
}
