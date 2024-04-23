<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Notifications\UserActivationNotification;


class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    public function user_list()
    {
      $users = User::latest()->get();
      return view('admin.user-list.index', compact('users'));
    }

    public function changeStatus(Request $request, $id)
    {
        //return $request;
        $user = User::find($id);
        $user->status = $request->status;
        $user->save();

        // Send email to the user if their account is activated
        if ($user->status == 1) {

            $this->sendActivationEmail($user);

        }


        $users = User::latest()->get();
        Session::flash('success', 'User status updated successfully.');
        return view('admin.user-list.index', compact('users'));
        // Redirect back or return response as needed


    }

    protected function sendActivationEmail(User $user)
    {
            // Send email notification to the user
            $user->notify(new UserActivationNotification($user));
    }

        

}



