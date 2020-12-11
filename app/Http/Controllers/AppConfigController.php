<?php

namespace App\Http\Controllers;

use App;
use App\AppConfig;
use App\Button;
use App\Config;
use Illuminate\Http\Request;

class AppConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $appconfig = AppConfig::whereId(1)->first();

      

        return view('admin.appconfig.appsettings', compact('appconfig'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppConfig  $appConfig
     * @return \Illuminate\Http\Response
     */
    public function show(AppConfig $appConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppConfig  $appConfig
     * @return \Illuminate\Http\Response
     */
    public function edit(AppConfig $appConfig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppConfig  $appConfig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
         $appconfig = AppConfig::findOrFail($id);
         $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $input = $request->all();
        // logo
        if ($file = $request->file('logo')) {
            $name = 'applogo_' . time() . $file->getClientOriginalName();
            if ($appconfig->logo != null) {
                $content = @file_get_contents(public_path() . '/images/app/logo/' . $appconfig->logo);
                if ($content) {
                    unlink(public_path() . '/images/app/logo/' . $appconfig->logo);
                }
            }
            $file->move('images/app/logo', $name);
            $input['logo'] = $name;
            $appconfig->update([
                'logo' => $input['logo'],
            ]);
        }

        //payment 
        if (isset($input['stripe_payment'])) {
        $input['stripe_payment'] = 1;
        }

        if (isset($input['paypal_payment'])) {
            $input['paypal_payment'] = 1;
        }

        if (isset($input['razorpay_payment'])) {
            $input['razorpay_payment'] = 1;
        }

        if (isset($input['brainetree_payment'])) {
            $input['brainetree_payment'] = 1;
        }

        if (isset($input['paystack_payment'])) {
            $input['paystack_payment'] = 1;
        }

        if (!isset($input['bankdetails'])) {
            $input['bankdetails'] = 0;
        }

        // social login 
        if (!isset($input['fb_check'])) {
            $input['fb_check'] = 0;
        }
        if (!isset($input['google_login'])) {
            $input['google_login'] = 0;
        }
        if (!isset($input['amazon_lab_check'])) {
            $input['amazon_lab_check'] = 0;
        }
        if (!isset($input['git_lab_check'])) {
            $input['git_lab_check'] = 0;
        }

        // ADMOB Detail
        if(isset($input['banner_admob']) && $input['banner_admob'] == 1){
            $request->validate([
                'banner_id' => 'required'
            ],
            [
                'banner_id.required' => 'Please enter Banner ID'
            ]);
        }else{
            $input['banner_admob'] = 0;
        }
        if(isset($input['interstitial_admob']) && $input['interstitial_admob'] == 1){
            $request->validate([
                'interstitial_id' => 'required'
            ],
            [
                'interstitial_id.required' => 'Please enter Interstitial ID'
            ]);
        }else{
            $input['interstitial_admob'] = 0;
        }
        if(isset($input['rewarded_admob']) && $input['rewarded_admob'] == 1){
            $request->validate([
                'rewarded_id' => 'required'
            ],
            [
                'rewarded_id.required' => 'Please enter Rewarded ID'
            ]);
        }else{
            $input['rewarded_admob'] = 0;
        }
        if(isset($input['native_admob']) && $input['native_admob'] == 1){
            $request->validate([
                'rewarded_id' => 'required'
            ],
            [
                'native_id.required' => 'Please enter Native ID'
            ]);
        }else{
            $input['native_admob'] = 0;
        }

         $appconfig->update([
            'title' => $input['title'],
            'banner_admob' => $input['banner_admob'],
            'banner_id' => $request->banner_id,
            'interstitial_admob' => $input['interstitial_admob'],
            'interstitial_id' => $request->interstitial_id,
            'rewarded_admob' => $input['rewarded_admob'],
            'rewarded_id' => $request->rewarded_id,
            'native_admob' => $input['native_admob'],
            'native_id' => $request->native_id,
            'ADMOB_APP_KEY' => $request->ADMOB_APP_KEY
         ]);

          return back()->with('updated', 'App Settings has been updated');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppConfig  $appConfig
     * @return \Illuminate\Http\Response
     */
   
}
