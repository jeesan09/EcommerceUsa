<?php
namespace App\Http\Controllers;

use App\Cart;
use Stripe;
use Session;
use App\Order;
use Exception;
use App\Shipping;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        if($subtotal <= 0 ){
            Session::flash('success_delete', 'Cart list is empty');
         return redirect()->back();
        }
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
        $carts = json_decode($request->input('cartData'), true);
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
        
    //   return $Charge;

        if ($Charge->status == "succeeded") {
        
            DB::beginTransaction();

            try {
                // Deduct the amount from the sender's account
                $order_id = Order::insertGetId([
                    'user_id' => Auth::id(),
                    'invoice' =>  mt_rand(10000000, 99999999),
                    'payment_type' => "online",
                    'total' => $subtotal,
                    'payment_inside'=>'payment done',
                    'payment_status'=>1,
                    'order_status'=>'2',
                    'subtotal' => $subtotal,
                    'stripe_id' => $Charge->id,
                    'stripe_url' => $Charge->receipt_url,
                    'created_at' => Carbon::now(),
                ]);

                if (  count($carts) >= 1) {
                    foreach ($carts as $cart) {

                    //return $cart['product_varient']['color_id'];
                    OrderItem::insert([
                        'order_id' => $order_id,
                        'product_id' => $cart['product_id'],
                        'product_qty' => $cart['qty'],
                        'product_variant_id' => $cart['product_varient_id'],
                        'product_color' => $cart['product_varient']['color_id'],
                        'created_at' => Carbon::now(),
                    ]);
                    }
                }

                Shipping::insert([
                    'order_id' => $order_id,
                    'user_name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'shiping_address' => $user->shipping_address,
                    'created_at' => Carbon::now(),
                ]);

                DB::commit();

            } catch (Exception $e) {
                // If an exception occurred, rollback the transaction
                DB::rollback();
                
                // Log the error or handle it appropriately
                // For example:
                Log::error('Transaction failed: ' . $e->getMessage());
        
                // You might also throw the exception again to let the caller know something went wrong
                throw $e;
            }
            $carts = Cart::where('user_ip',   $user->id)->delete();
            return redirect()->to('my-profile/')->with('success', 'Payment successfuly Done !');
        } else {
            
         Session::flash('error', 'Payment failed!');
         return back();
  
       }
                   
        
    }





}