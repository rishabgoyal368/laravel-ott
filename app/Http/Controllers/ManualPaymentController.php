<?php

namespace App\Http\Controllers;

use App\ManualPayment;
use App\Menu;
use App\Multiplescreen;
use App\Package;
use App\PaypalSubscription;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ManualPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $manual_payment = ManualPayment::orderby('id', 'desc')->get();

        return view('admin.manual_payment.index', compact('manual_payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $planid)
    {
        //
        //return $request;
        $menus = Menu::all();
        $plan = Package::findorFail($planid);

        if ($file = $request->file('recipt')) {
            $name = "manual_" . time() . $file->getClientOriginalName();
            $file->move('images/recipt', $name);
            $recipt_name = $name;

        }

        $current_date = Carbon::now();
        $end_date = null;

        if ($plan->interval == 'month') {
            $end_date = Carbon::now()->addMonths($plan->interval_count);
        } else if ($plan->interval == 'year') {
            $end_date = Carbon::now()->addYears($plan->interval_count);
        } else if ($plan->interval == 'week') {
            $end_date = Carbon::now()->addWeeks($plan->interval_count);
        } else if ($plan->interval == 'day') {
            $end_date = Carbon::now()->addDays($plan->interval_count);
        }

        $auth = Auth::user();

        $created_subscription = ManualPayment::create([
            'user_id' => $auth->id,
            'payment_id' => 'banktransfer',
            'user_name' => $auth->name,
            'package_id' => $plan->id,
            'price' => $plan->amount,
            'status' => 0,
            'file' => $name,
            'method' => 'banktransfer',
            'subscription_from' => $current_date,
            'subscription_to' => $end_date,
        ]);

        return back()->with('added', 'ManualPayment Recipt has been successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changemanualpayment($id)
    {

        $manual_payment = ManualPayment::findorfail($id);

        if ($manual_payment->status == 1) {
            $manual_payment->status = 0;
            $manual_payment->save();
        } else {

            $manual_payment->status = 1;

            $menus = Menu::all();
            $plan = Package::findorFail($manual_payment->package_id);

            $created_subscription = PaypalSubscription::create([
                'user_id' => $manual_payment->user_id,
                'payment_id' => 'banktransfer',
                'user_name' => $manual_payment->user_name,
                'package_id' => $plan->id,
                'price' => $plan->amount,
                'status' => 1,
                'method' => 'banktransfer',
                'subscription_from' => $manual_payment->subscription_from,
                'subscription_to' => $manual_payment->subscription_to,
            ]);

            if (isset($created_subscription)) {
                $auth = Auth::user();
                $screen = $plan->screens;
                if ($screen > 0) {
                    $multiplescreen = Multiplescreen::where('user_id', $auth->id)->first();
                    if (isset($multiplescreen)) {
                        $multiplescreen->update([
                            'pkg_id' => $plan->id,
                            'user_id' => $auth->id,
                            'screen1' => $screen >= 1 ? $auth->name : null,
                            'screen2' => $screen >= 2 ? 'Screen2' : null,
                            'screen3' => $screen >= 3 ? 'Screen3' : null,
                            'screen4' => $screen >= 4 ? 'Screen4' : null,
                        ]);
                    } else {
                        $multiplescreen = Multiplescreen::create([
                            'pkg_id' => $plan->id,
                            'user_id' => $auth->id,
                            'screen1' => $screen >= 1 ? $auth->name : null,
                            'screen2' => $screen >= 2 ? 'Screen2' : null,
                            'screen3' => $screen >= 3 ? 'Screen3' : null,
                            'screen4' => $screen >= 4 ? 'Screen4' : null,
                        ]);
                    }
                }
            }

            $manual_payment->save();

        }
        return back()->with('Status change successsfully!');

    }
}
