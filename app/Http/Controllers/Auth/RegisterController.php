<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\NewUserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegistrationRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

      protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'reseller_ID' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      // not needed anymore
       dd( $data['company_name']);


        $user = new User();
        $user->name = $data['name'];
        $user->reseller_ID = $data['reseller_ID'];
        $user->company_name = $data['company_name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $user->save();

        // Send email notification to admin
        $this->sendAdminNotification($user);

        return $user;

    }


    public function register(RegistrationRequest $request)
    {
       // dd($request->all());

        $user = new User();
        $user->name = $request->name;
        $user->reseller_ID = $request->reseller_ID;
        $user->company_name = $request->company_name;
        $user->email = $request->email;
        $user->shipping_address = $request->shipping_address;
        $user->billing_address = $request->billing_address;
        $user->city = $request->city;
        $user->united_region = $request->united_region;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('tax_image')) {
            $image = $request->file('tax_image');
            $filename = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/img/user/'), $filename);
            $user->tax_image = 'frontend/img/user/' . $filename;
        }

        $user->status = 1;
        $user->save();

        Auth::login($user);
        $this->sendAdminNotification($user);

        return redirect('/login')->with('warning', 'Your account will be activated by the admin soon.');

    }


    protected function sendAdminNotification(User $user)
    {
        // Generate activation link
        $activationLink = route('admin.login');
    /*   dd($user->email); */
        // Send email notification to admin
       // Mail::to("sales@megaphonewholesale.com")->send(new NewUserNotification($user, $activationLink));

        return redirect('/login');

    }


}
