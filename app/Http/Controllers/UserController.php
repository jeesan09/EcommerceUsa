<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\UserActivationNotification;


class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin')->except('updateShippingAddress');
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

        return Redirect::route('all-user.list')->with('success', 'User status updated successfully.');


        // $users = User::latest()->get();
        // Session::flash('success', 'User status updated successfully.');
        // return view('admin.user-list.index', compact('users'));
        // Redirect back or return response as needed


    }

    public function show($id)
    {
        // Fetch the user details based on the provided ID
        $user = User::findOrFail($id);
        
       // return $user;
        // Pass the user details to the view
        return view('admin.user-list.show', ['user' => $user]);
    }

    public function updateShippingAddress(Request $request)
    {
        $user = Auth::user();

        // Update user's shipping address
        $user->shipping_address = $request->input('shipping_address');
        // Update other details if needed
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Save changes
        $user->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User deleted successfully.');
    }



    protected function sendActivationEmail(User $user)
    {
            // Send email notification to the user
            $user->notify(new UserActivationNotification($user));
    }

        

}



