<?php

namespace App\Http\Controllers;

use App\Config;
use App\Mail\SendInvoiceMailable;
use App\Menu;
use App\Package;
use App\PaypalSubscription;
use App\PricingText;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Stripe\Customer;
use Stripe\Subscription;
use \Stripe\Coupon;
use \Stripe\Invoice;
use \Stripe\Stripe;
use Laravel\Cashier\Cashier;

class UserAccountController extends Controller
{

    public function index()
    {
        // Set your secret key: remember to change this to your live secret key in production
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $auth = Auth::user();
        if ($auth->stripe_id != null) {
            // $customer = Customer::retrieve($auth->stripe_id);
           $customer = Cashier::findBillable($auth->stripe_id);
        }
        $paypal = $auth->paypal_subscriptions->sortBy('created_at');
        $plans = Package::all();
        $current_subscription = null;
        $method = null;
        $current_date = Carbon::now()->toDateString();
        if (isset($customer)) {
            //return $alldata = $user->asStripeCustomer()->subscriptions->data;
            $alldata = $auth->subscriptions;
            $data = $alldata->last();
        }
        if (isset($paypal) && $paypal != null && count($paypal) > 0) {
            $last = $paypal->last();
        }
        $stripedate = isset($data) ? $data->created_at : null;
        $paydate = isset($last) ? $last->created_at : null;
        if ($stripedate > $paydate) {
            if ($auth->subscribed($data->name)) {
                $current_subscription = $data;
                $method = 'stripe';
            }
        } elseif ($stripedate < $paydate) {
            if (date($current_date) <= date($last->subscription_to)) {
                $current_subscription = $last;
                $method = 'paypal';
            }
        }
        
        return view('user.index', compact('plans', 'current_subscription', 'method'));
    }

    public function purchase_plan()
    {
        $plans = Package::all();
        $pricingTexts = PricingText::all();
        return view('user.purchaseplan', compact('plans', 'pricingTexts'));
    }

    public function get_payment($id)
    {
        $plan = Package::findOrFail($id);
        $bankdetails = Config::findOrFail(1)->bankdetails;
        $razorpay_payment = Config::findOrFail(1)->razorpay_payment;
        $account_name = Config::findOrFail(1)->account_name;
        $account_no = Config::findOrFail(1)->account_no;
        $ifsc_code = Config::findOrFail(1)->ifsc_code;
        $bank = Config::findOrFail(1)->bank_name;
        return view('subscribe', compact('plan', 'bankdetails', 'account_no', 'account_name', 'ifsc_code', 'bank','razorpay_payment'));
    }

    public function subscribe(Request $request)
    {
        $menus = Menu::all();
        ini_set('max_execution_time', 80);
        // Set your secret key: remember to change this to your live secret key in production
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $auth = Auth::user();
        $token = $request->stripeToken;
        $coupon_valid = false;
        $coupon = $request->coupon;
        $plan = Package::find($request->plan);
        $paymentMethod = $request->paymentMethod;

        if(!$plan){
            dd('Plan not found !');
        }

        if ($coupon != null) {

            try
            {
                $stripe_coupon = Coupon::retrieve($coupon);
                $coupon_valid = true;
                if ($stripe_coupon->valid == false) {
                    $coupon_valid = false;
                    return back()->with('deleted', 'Coupon has been expired');
                }
            } catch (\Exception $e) {
                $error =  $e->getMessage();
                $coupon_valid = false;
            }


        }

        if($coupon_valid == false && $request->coupon){
            return back()->with('deleted', $error);
        }

        
            $plan_id = $plan->plan_id;
            $plan_name = $plan->name;

            if($coupon_valid == true && $request->coupon){

                 $purchased = $auth->newSubscription($plan_name, $plan_id)->withCoupon($request->coupon)->create($paymentMethod, [
                    'email' => $auth->email,
                ]);

                $last_plan = $auth->subscriptions->last(); 
                   $current_date = Carbon::now();
                    $end_date = null;

                    if ($plan->interval == 'month') {
                        $end_date = Carbon::now()->addMonths($plan->interval_count);
                    } else if($plan->interval == 'year') {
                        $end_date = Carbon::now()->addYears($plan->interval_count);
                    } else if($plan->interval == 'week') {
                        $end_date = Carbon::now()->addWeeks($plan->interval_count);
                    } else if($plan->interval == 'day') {
                        $end_date = Carbon::now()->addDays($plan->interval_count);
                    }

               \DB::table('subscriptions')->where('id','=',$last_plan->id)->update([
                    'subscription_from'=>$current_date,
                    'subscription_to'=> $end_date,
                    'amount' => $plan->amount
               ]);

            }
            else{
              

                $purchased = $auth->newSubscription($plan_name, $plan_id)
                    ->create($paymentMethod, [
                    'email' => $auth->email
                ]);

               $last_plan = $auth->subscriptions->last(); 
                   $current_date = Carbon::now();
                    $end_date = null;

                    if ($plan->interval == 'month') {
                        $end_date = Carbon::now()->addMonths($plan->interval_count);
                    } else if($plan->interval == 'year') {
                        $end_date = Carbon::now()->addYears($plan->interval_count);
                    } else if($plan->interval == 'week') {
                        $end_date = Carbon::now()->addWeeks($plan->interval_count);
                    } else if($plan->interval == 'day') {
                        $end_date = Carbon::now()->addDays($plan->interval_count);
                    }

               \DB::table('subscriptions')->where('id','=',$last_plan->id)->update([
                    'subscription_from'=>$current_date,
                    'subscription_to'=> $end_date,
                    'amount' => $plan->amount
               ]);

               
               
                
            }
           
            if (isset($purchased) || $purchased != null) {
                Mail::to($auth->email)->send(new SendInvoiceMailable());
                if (isset($menus) && count($menus) > 0) {
                    return redirect()->route('home', $menus[0]->slug)->with('added', 'Your are now a subscriber !');
                }
                return redirect('/')->with('added', 'Your are now a subscriber !');
            } else {
                return back()->with('deleted', 'Subscription failed ! Please check your debit or credit card.');
            }
        
    }

    public function edit_profile()
    {
        return view('user.edit_profile');
    }

    public function update_profile(Request $request)
    {
        $auth = Auth::user();

        if (Hash::check($request->current_password, $auth->password)) {
            if ($request->new_email !== null) {
                $request->validate([
                    'new_email' => 'required|email',
                    'current_password' => 'required',
                ]);
                $auth->update([
                    'email' => $request->new_email,
                ]);
                return back()->with('updated', 'Email has been updated');
            }

            if ($request->new_name !== null) {
                $request->validate([
                    'new_name' => 'required|',
                    'current_password' => 'required',
                ]);
                $auth->update([
                    'name' => $request->new_name,
                ]);
                return back()->with('updated', 'Name has been updated');
            }

            if ($request->new_password !== null) {
                $request->validate([
                    'new_password' => 'required|min:6',
                    'current_password' => 'required',
                ]);
                $auth->update([
                    'password' => bcrypt($request->new_password),
                ]);
                return back()->with('updated', 'Password has been updated');
            }

        } else {
            return back()->with("deleted", "Your password doesn't match");
        }
        return back();
    }

    public function history()
    {
        $auth = Auth::user();
        // Set your secret key: remember to change this to your live secret key in production
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paypal_subscriptions = PaypalSubscription::where('user_id', $auth->id)->get();
        $customer = Cashier::findBillable($auth->stripe_id);

       // $customer = Invoice::retrieve($auth->stripe_id);
        if($customer){
            $invoices = $customer->invoices();
        }
       
        // $invoices = $auth->subscriptions;
        return view('user.history', compact('invoices', 'paypal_subscriptions'));
    }
    public function cancelSub($plan_id)
    {
        $auth = Auth::user();
        $auth->subscription($plan_id)->cancel();
        return back()->with('deleted', 'Subscription has been cancelled');
    }

    public function resumeSub($plan_id)
    {
        $auth = Auth::user();
        $auth->subscription($plan_id)->resume();
        return back()->with('updated', 'Subscription has been resumed');
    }

    public function PaypalCancel()
    {
        $auth = Auth::user();
        $auth->paypal_subscriptions->last()->status = 0;
        $auth->paypal_subscriptions->last()->save();
        return back()->with('deleted', 'Subscription has been cancelled');
    }

    public function PaypalResume()
    {
        $auth = Auth::user();
        $last = $auth->paypal_subscriptions->last();
        $last->status = 1;
        $last->save();
        return back()->with('updated', 'Subscription has been resumed');
    }
    public function watchhistory()
    {

        return view('search');
    }
}
