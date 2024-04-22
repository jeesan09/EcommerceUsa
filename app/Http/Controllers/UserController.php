<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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

        $users = User::latest()->get();
        Session::flash('success', 'User status updated successfully.');
        return view('admin.user-list.index', compact('users'));
        // Redirect back or return response as needed
    }
        

}



