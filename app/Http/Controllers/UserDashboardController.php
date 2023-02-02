<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;



//Auth, Hash
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

//Models
use App\Models\Task;
use App\Models\User;

class UserDashboardController extends Controller
{
    public function index(){
        $user = Auth::user();

        $taskStatus = [
            'sumCount' => Auth::user()->assignedTasks()->count(),
            'pending' => Auth::user()->assignedTasks()->where('status', 'Pending')->count(),
            'processing' => Auth::user()->assignedTasks()->where('status', 'Processing')->count(),
            'done' => Auth::user()->assignedTasks()->where('status', 'Done')->count(),
        ];
        return view('contents.user.dashboard')->with('taskStatus', $taskStatus)->with('user', $user);

        // return $taskStatus;
    }

    public function editProfile(){
        $user = Auth::user();
        return view('contents.user.edit-profile')->with('user', $user);
    }

    public function editPassword(){
        return view('contents.user.edit-password');
    }

    public function updateProfile(UpdateProfileRequest $request){
        try {
            $user = Auth::user();

            $user->update([
                'name' => $request->name
            ]);

            return redirect()->route('user.dashboard')->with('success', 'You have successfully updated your profile.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
        
    }

    public function updatePassword(UpdatePasswordRequest $request){
        try {
            $user = Auth::user();
            
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->route('user.dashboard')->with('success', 'You have successfully updated your password.');

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
