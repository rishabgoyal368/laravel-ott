<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('configs')->delete();
        
        \DB::table('configs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'logo' => 'logo_1550663262logo.png',
                'favicon' => 'favicon.png',
                'livetvicon' => 'livetvicon_1584525047liveicon4.png',
                'title' => '{"en":"Nexthour","Spanish":"Nexthour","spanish":"Nexthour","FR":"Nexthour","EN":"Nexthour"}',
                'w_email' => 'contact@nexthour.com',
                'verify_email' => 0,
                'download' => 0,
                'free_sub' => 0,
                'free_days' => 40,
                'stripe_pub_key' => '',
                'stripe_secret_key' => '',
                'paypal_mar_email' => '',
                'currency_code' => 'USD',
                'currency_symbol' => 'fa fa-dollar',
                'invoice_add' => '{"en":null}',
                'prime_main_slider' => 0,
                'catlog' => 1,
                'withlogin' => 1,
                'prime_genre_slider' => 1,
                'donation' => 0,
                'donation_link' => NULL,
                'prime_footer' => 1,
                'prime_movie_single' => 1,
                'terms_condition' => '{"en":"<p>new goodes<\\/p>","nl":"<p>newvious&nbsp;goodesioanos<\\/p>"}',
                'privacy_pol' => NULL,
                'refund_pol' => '{"en":"<p>Refund<\\/p>"}',
                'copyright' => '{"en":"Next Hour | All Rights Reserved."}',
                'stripe_payment' => 0,
                'paypal_payment' => 0,
                'razorpay_payment' => 0,
                'age_restriction' => 0,
                'payu_payment' => 0,
                'bankdetails' => 0,
                'account_no' => NULL,
                'branch' => NULL,
                'account_name' => NULL,
                'ifsc_code' => NULL,
                'bank_name' => NULL,
                'paytm_payment' => 0,
                'paytm_test' => 0,
                'preloader' => 1,
                'fb_login' => 1,
                'gitlab_login' => 1,
                'google_login' => 1,
                'wel_eml' => 0,
                'blog' => 0,
                'is_playstore' => 0,
                'is_appstore' => 0,
                'playstore' => 'https://www.youtube.com/upload',
                'appstore' => 'https://www.youtube.com/upload',
                'color' => 'default',
                'color_dark' => 0,
                'user_rating' => 0,
                'comments' => 0,
                'braintree' => 0,
                'paystack' => 0,
                'remove_landing_page' => 0,
                'coinpay' => 0,
                'captcha' => 0,
                'amazon_login' => 0,
                'created_at' => NULL,
                'updated_at' => '2020-11-02 12:10:15',
            ),
        ));
        
        
    }
}