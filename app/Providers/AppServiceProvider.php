<?php

namespace App\Providers;

use App\AuthCustomize;
use App\Config;
use App\Language;
use App\Menu;
use App\Package;
use App\seo;
use App\Button;
use App\ChatSetting;
use App\Helpers\SeoHelper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Schema::defaultStringLength(191);

        if (\DB::connection()->getDatabaseName()) {

            if (Schema::hasTable('configs') && Schema::hasTable('seos')) {
                 SeoHelper::settings();
            }

             if (Schema::hasTable('auth_customizes') && Schema::hasTable('configs') && Schema::hasTable('buttons') && Schema::hasTable('languages') && Schema::hasTable('users') && Schema::hasTable('chat_settings')) {

            view()->composer('*', function ($view)
        {
            $auth_customize = AuthCustomize::first();
            $languages = Language::all(); 
            $auth = Auth::user();
            $config = Config::find(1);
            $com_name = $config->w_name;
            $com_add = $config->invoice_add;
            $catlog = $config->catlog;
            $withlogin = $config->withlogin;
            $com_email = $config->w_email;
            $currency_code = $config->currency_code;
            $currency_symbol = $config->currency_symbol;
            $term_con = $config->terms_condition;
            $pri_pol = $config->privacy_pol;
            $refund_pol = $config->refund_pol;
            $copyright = $config->copyright;
            $logo = $config->logo;
            $w_title = $config->title;
            $w_email = $config->email;
            $favicon = $config->favicon;
            $prime_main_slider = $config->prime_main_slider;
            $prime_genre_slider = $config->prime_genre_slider;
            $prime_footer = $config->prime_footer;
            $prime_movie_single = $config->prime_movie_single;
            $stripe_payment = $config->stripe_payment;
            $paypal_payment = $config->paypal_payment;
            $paytm_payment = $config->paytm_payment;
            $payu_payment = $config->payu_payment;
            $braintree = $config->braintree;
            $paystack = $config->paystack;
            $coinpay = $config->coinpay;
            $preloader = $config->preloader;
            $button = Button::find(1);
            $inspect = $button->inspect;
            $rightclick = $button->rightclick;
            $goto = $button->goto;
            $color = $config->color;
            $uc_browser = $button->uc_browser;
            $protip = $button->protip;
            $color_dark = $config->color_dark;
            $remove_subscription =$button->remove_subscription;
             


            $seo = seo::find(1);
            $fb = $seo->fb;
            $google = $seo->google;
            $description = $seo->description;
            $keyword = $seo->keyword;
            $author = $seo->author;

           

            $omdbApiKey = env('OMDB_API_KEY');
            $tmdbApiKey = env('TMDB_API_KEY');

            $view->with(['paytm_payment' => $paytm_payment, 'author' => $author,'color' => $color,'color_dark' => $color_dark,'description' => $description,'keyword' => $keyword,'goto' => $goto,
                'fb' => $fb,'google' => $google,'rightclick' => $rightclick,'inspect'=>$inspect, 'uc_browser'=>$uc_browser, 'company_name' => $com_name, 'w_email' => $com_email, 'invoice_add' => $com_add, 
                'auth' => $auth, 'prime_main_slider' => $prime_main_slider, 'prime_genre_slider' => $prime_genre_slider, 
                'prime_footer' => $prime_footer, 'prime_movie_single' => $prime_movie_single, 'omdbapikey'=>$omdbApiKey,
                'tmdbapikey'=>$tmdbApiKey,'currency_code' => $currency_code, 'currency_symbol' => $currency_symbol, 
                'logo'=> $logo, 'favicon'=> $favicon, 'term_con' => $term_con, 'pri_pol' => $pri_pol,
                 'refund_pol' => $refund_pol, 'copyright' => $copyright, 'w_title' => $w_title, 'languages' => $languages, 
                'braintree' => $braintree, 'paystack' => $paystack, 'coinpay' => $coinpay, 
                 'stripe_payment' => $stripe_payment, 'paypal_payment' => $paypal_payment,
                 'payu_payment' => $payu_payment, 'auth_customize' => $auth_customize, 'preloader' => $preloader,'protip'=>$protip,'remove_subscription'=>$remove_subscription,'config'=>$config]);
        });
        }
      }

        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
