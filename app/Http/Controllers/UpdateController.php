<?php

namespace App\Http\Controllers;

use App\Config;
use Artisan;
use Carbon\Carbon;
use Crypt;
use Hash;
use App\Movie;
use App\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan as FacadesArtisan;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Http\Controllers\InitializeController;
use Illuminate\Support\Facades\Http;

class UpdateController extends Controller
{
       //Existing user 
    public function exitterm(){
        return view('install.existeula');
    }


    public function updateeula(Request $request){

        

        $d = \Request::getHost();
        $domain = str_replace("www.", "", $d);  
        if(strstr($domain,'localhost') || strstr($domain,'.test') || strstr($domain,'mediacity.co.in') || strstr($domain,'castleindia.in')){
             $put = 1;
            file_put_contents(public_path().'/config.txt', $put);
            return $this->process($request);
        }
        else{
            
            $request->validate([
            'eula' => 'required',
            'domain'=>'required',
            'code'=>'required'
        ],
        [
            'eula.required'=>'Please accept Terms and Conditions !',
            'domain.required'=>'Please enter your domain name !',
            'code.required'=>'Please enter your envato purchase code !'
        ]);

            $alldata = ['app_id' => "24626244", 'ip' => $request->ip(), 'domain' => $domain , 'code' => $request->code];
        
            $data = $this->make_request($alldata);

            if ($data['status'] == 1)
            {

                $put = 1;
                file_put_contents(public_path().'/config.txt', $put);
                return $this->process($request);
            }
            elseif ($data['msg'] == 'Already Register')
            {  
                notify()->error('User is already registered');
                return back()->withInput();
            }
            else
            {
                notify()->error($data['msg']);
                return back()->withInput();
            }


        }
        
        

    }



  public function process($request){
     
     if (env('IS_INSTALLED') == 0) {
           
                ini_set('memory_limit', '-1');

                try
                {
                    \DB::connection()
                        ->getPdo();

                    if (env('IS_INSTALLED') == 0) {

                        if (\Schema::hasTable('configs')) {

                            try{
                                Artisan::call('migrate', [
                                    '--path' => 'database/migrations/existing',
                                    '--force' => true,
                                ]);

                               

                                Artisan::call('db:seed' ,['--class'=>'ChatSettingsTableSeeder']);
                                Artisan::call('db:seed' ,['--class'=>'AppConfigsTableSeeder']);
                                Artisan::call('db:seed' ,['--class'=>'AppSlidersTableSeeder']);
                                Artisan::call('db:seed' ,['--class'=>'SplashScreensTableSeeder']);

                                $movies = Movie::where('slug','=', NULL)->get();
                                if(isset($movies) && count($movies) > 0){
                                    foreach($movies as $movie){
                                     $m = Movie::find($movie->id);
                                     if(isset($m)){
                                        $m->slug = str_slug($m->title, '-');
                                        $m->slug;
                                        $m->save();
                                     }
                                        
                                    }
                                }
                                


                                $seasons = Season::where('season_slug','=', NULL)->get();
                                if(isset($seasons) && count($seasons) > 0){
                                    foreach($seasons as $season){
                                    $s = Season::find($season->id);
                                        if(isset($s)){
                                            $s->season_slug = str_slug($s->tvseries->title . '-season-' . $s->season_no, '-');;
                                            $s->save();
                                         }
                                   
                                    }
                                }
                               
                               if (!is_dir(public_path() . '/images/genre')) {
                                    mkdir(public_path() . '/images/genre');
                                }
                                if (!is_dir(public_path() . '/images/event')) {
                                    mkdir(public_path() . '/images/event');
                                }
                                if (!is_dir(public_path() . '/images/event/thumbnail')) {
                                    mkdir(public_path() . '/images/event/thumbnail');
                                }
                                if (!is_dir(public_path() . '/images/audio')) {
                                    mkdir(public_path() . '/images/audio');
                                }
                                if (!is_dir(public_path() . '/images/audio/poster')) {
                                    mkdir(public_path() . '/images/audio/poster');
                                }
                                if (!is_dir(public_path() . '/images/audio/thumbnail')) {
                                    mkdir(public_path() . '/images/audio/thumbnail');
                                }

                                if (!is_dir(public_path() . '/audio')) {
                                    mkdir(public_path() . '/audio');
                                }

                                // $add_on_field = "\nAMAZON_LOGIN_ID=\n\nAMAZON_LOGIN_SECRET=\n\nAMAZON_LOGIN_REDIRECT=\n\nNOCAPTCHA_SITEKEY=\n\nNOCAPTCHA_SECRET=\n\nIS_INSTALLED=1";
                               
                                // @file_put_contents(base_path() . '/.env', $add_on_field . PHP_EOL, FILE_APPEND);

                               $this->changeEnv(['IS_INSTALLED' => '1']);

                                 notify()->success('Updated Successfully');
                                return redirect('/');
                            }
                            catch(\Exception $e){
                                 notify()->error($e->getMessage());
                                return back()->withInput();
                            }
                           
                        }

                    } else {
                        return redirect('/');
                    }

                } catch (\Exception $e) {
                   // return $e->getMessage();
                    notify()->error($e->getMessage());
                    return redirect()->route('existterm')->withInput();

                }

            
        } 
  }

   public function make_request($alldata)
    {
        $response = Http::post('https://mediacity.co.in/purchase/public/api/verifycode', [
            'app_id' => $alldata['app_id'],
            'ip' => $alldata['ip'],
            'code' => $alldata['code'],
            'domain' => $alldata['domain']
        ]);

        $result = $response->json();
        
        if($response->successful()){
            if ($result['status'] == '1')
            {
                $file = public_path() . '/intialize.txt';
                file_put_contents($file, $result['token']);
                file_put_contents(public_path() . '/code.txt', $alldata['code']);
                file_put_contents(public_path() . '/ddtl.txt', $alldata['domain']);
                return array(
                    'msg' => $result['message'],
                    'status' => '1'
                );
            }
            else
            {
                $message = $result['message'];
                return array(
                    'msg' => $message,
                    'status' => '0'
                );
            }
        }else
        {
            $message = "Failed to validate";
            return array(
                'msg' => $message,
                'status' => '0'
            );
        }

       
    }

   protected function changeEnv($data = array())
    {
        {
            if (count($data) > 0) {

                // Read .env-file
                $env = file_get_contents(base_path() . '/.env');

                // Split string on every " " and write into array
                $env = preg_split('/\s+/', $env);

                // Loop through given data
                foreach ((array) $data as $key => $value) {
                    // Loop through .env-data
                    foreach ($env as $env_key => $env_value) {
                        // Turn the value into an array and stop after the first split
                        // So it's not possible to split e.g. the App-Key by accident
                        $entry = explode("=", $env_value, 2);

                        // Check, if new key fits the actual .env-key
                        if ($entry[0] == $key) {
                            // If yes, overwrite it with the new one
                            $env[$env_key] = $key . "=" . $value;
                        } else {
                            // If not, keep the old one
                            $env[$env_key] = $env_value;
                        }
                    }
                }

                // Turn the array back to an String
                $env = implode("\n\n", $env);

                // And overwrite the .env with the new data
                file_put_contents(base_path() . '/.env', $env);

                return true;

            } else {

                return false;
            }
        }
    }
}
