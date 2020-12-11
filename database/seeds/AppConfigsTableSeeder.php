<?php

use Illuminate\Database\Seeder;

class AppConfigsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('app_configs')->delete();
        
        \DB::table('app_configs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'logo' => 'applogo_1606642921logo.png',
                'title' => 'Nexthour',
                'stripe_payment' => 0,
                'paypal_payment' => 0,
                'razorpay_payment' => 0,
                'brainetree_payment' => 0,
                'bankdetails' => 0,
                'fb_check' => 0,
                'google_login' => 0,
                'amazon_lab_check' => 0,
                'git_lab_check' => 0,
                'ADMOB_APP_KEY' => NULL,
                'banner_admob' => 0,
                'banner_id' => NULL,
                'interstitial_admob' => 0,
                'interstitial_id' => NULL,
                'rewarded_admob' => 0,
                'rewarded_id' => NULL,
                'native_admob' => 0,
                'native_id' => NULL,
                'created_at' => NULL,
                'updated_at' => '2020-11-29 15:12:01',
            ),
        ));
        
        
    }
}