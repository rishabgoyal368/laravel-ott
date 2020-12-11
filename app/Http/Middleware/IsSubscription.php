<?php

namespace App\Http\Middleware;

use App\Package;
use App\Config;
use Session;
use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Stripe\Customer;
use Stripe\Stripe;
use App\Menu;
use App\MenuSection;
use App\WatchHistory;
use App\HomeBlock;
use App\HomeTranslation;
use App\Actor;
use App\AudioLanguage;
use App\Director;
use App\PricingText;
use App\Genre;
use App\HomeSlider;
use App\LandingPage;
use App\MenuVideo;
use App\PaypalSubscription;
use App\Movie;
use App\User;
use App\Season;
use App\TvSeries;
use App\Button;
use Illuminate\Http\Response;
use Laravel\Cashier\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\FrontSliderUpdate;
use Illuminate\Pagination\LengthAwarePaginator;
use App;

class IsSubscription
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{   
		App::setLocale(Session::get('changed_language'));		
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $current_date = Carbon::now()->toDateString();
		if (Auth::check()) {			
			$auth = Auth::user();
			$catlog= Config::findOrFail(1)->catlog;
			$freesubscription= Config::findOrFail(1)->free_sub;
			$withlogin= Config::findOrFail(1)->withlogin;          
			if ($auth->is_admin == 1) {
				return $next($request);                
			}
			elseif($catlog == 0 && $freesubscription == 0){

				if ($auth->stripe_id != null) {
					// $customer = Customer::retrieve($auth->stripe_id);
					$customer = Cashier::findBillable($auth->stripe_id);
				}
				$paypal = $auth->paypal_subscriptions->sortBy('created_at'); 
				if (isset($customer)) {         
					$alldata = $auth->subscriptions;
					$data = $alldata->last();      
				} 
				if (isset($paypal) && $paypal != null && count($paypal)>0) {
					$last = $paypal->last();
				} 
				$stripedate = isset($data) ? $data->created_at : null;
				$paydate = isset($last) ? $last->created_at : null;
				if($stripedate > $paydate){
					if($auth->subscribed($data->name) && date($current_date) <= date($data->subscription_to))
					{
						if($data->ends_at == null || $request->is('resumesubscription/*')){
							return $next($request);  
						}
						else{
							return redirect('/')->with('deleted', 'Please resume your subscription!');
						}                       
					} 
					else 
					{
						return redirect('/')->with('deleted', 'Your subscription has been expired!');
					}
				}
				elseif($stripedate < $paydate){
					if (date($current_date) <= date($last->subscription_to))
					{
						if($last->status == 1) 
						{
							return $next($request);    
						}
						else{
							return redirect('/')->with('deleted', 'Please resume your subscription!');
						}                    
					} else {
						$last->status = 0;
						$last->save();
						return redirect('/')->with('deleted', 'Your subscription has been expired!');
					}
				}
				else{
					return redirect('account/purchaseplan')->with('deleted', 'You have no subscription please subscribe');

				}
			}
			elseif($catlog == 0 && $freesubscription == 1){
				
				return $next($request);  
				 
			}
			else
			{
				if($freesubscription == 1){
				
					return $next($request);  
				}
				else
				{
					if ($auth->stripe_id != null) 
					{
					// $customer = Customer::retrieve($auth->stripe_id);
						$customer = Cashier::findBillable($auth->stripe_id);
					}
					$paypal = $auth->paypal_subscriptions->sortBy('created_at'); 
					if (isset($customer)) {         
						$alldata = $auth->subscriptions;
						$data = $alldata->last();      
					} 
					if (isset($paypal) && $paypal != null && count($paypal)>0) {
						$last = $paypal->last();
					} 
					$stripedate = isset($data) ? $data->created_at : null;
					$paydate = isset($last) ? $last->created_at : null;
					if($stripedate > $paydate){
						if($auth->subscribed($data->name) && date($current_date) <= date($data->subscription_to))
						{
							if($data->ends_at == null || $request->is('resumesubscription/*')){
								return $next($request);  
							}
							else{
								return redirect('/')->with('deleted', 'Please resume your subscription!');
							}                       
						} 
						else 
						{
							return redirect('/')->with('deleted', 'Your subscription has been expired!');
						}
					}
					elseif($stripedate < $paydate){
						if (date($current_date) <= date($last->subscription_to))
						{
							if($last->status == 1) 
							{
								return $next($request);    
							}
							else{
								return redirect('/')->with('deleted', 'Please resume your subscription!');
							}                    
						} else {
							$last->status = 0;
							$last->save();
							return redirect('/')->with('deleted', 'Your subscription has been expired!');
						}
					}
					else{
						return redirect('account/purchaseplan')->with('deleted', 'You have no subscription please subscribe');

					}
				}
				
			}
		}
	}
}