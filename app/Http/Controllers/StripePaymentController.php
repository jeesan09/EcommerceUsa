<?php
namespace App\Http\Controllers;
use Stripe;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();
    
        // Retrieve additional data and subtotal from the request
        $CartData = json_decode($request->input('carts'), true);
        $subtotal = $request->input('sub_total');

        //return $subtotal;
    
        // Pass user data, additional data, and subtotal to the view
        return view('stripe', compact('user', 'CartData', 'subtotal'));
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        
        $user = Auth::user();
        $CartData = json_decode($request->input('cartData'), true);
        $subtotal = $request->input('subtotal');



     //   return $subtotal;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // $customer = Stripe\Customer::create(array(

        //     "address" => $user->shipping_address,

        //     "email" => $user->email,

        //     "name" => $user->name,

        //     "source" => $request->stripeToken,
        //  ));

    
        $Charge =  Stripe\Charge::create ([
                "amount" => $subtotal * 100,
                "currency" => "usd",
                "receipt_email" => $user->email, // Provide customer email
                "source" => $request->stripeToken,
                "description" => "Payment done by user:", 
                "receipt_email" => $user->email, // Provide customer email
                "metadata" => [
                    "name" => $user->name,
                    "email" => $user->email,
                    "id"=> $user->id,
                      // Include customer name in metadata
                ]
        ]);


       // return $Charge->id; //here we get charge ID
        
       return $Charge;
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
}