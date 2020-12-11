<?php

namespace App\Http\Controllers;

use App\SplashScreen;
use Illuminate\Http\Request;

class SplashScreenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $splashscreen = SplashScreen::first();
        return view('admin.splashscreen.index', compact('splashscreen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Display the specified resource.
     *
     * @param  \App\SplashScreen  $splashScreen
     * @return \Illuminate\Http\Response
     */
    public function show(SplashScreen $splashScreen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SplashScreen  $splashScreen
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SplashScreen  $splashScreen
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $old = SplashScreen::first();

        $input= $request->all();

        

         if ($file = $request->file('image')) {
            $name = 'splashscreen_' . time() . $file->getClientOriginalName();
            if ($old->image != null) {
                $content = @file_get_contents(public_path() . '/images/splashscreen/' . $old->image);
                if ($content) {
                    unlink(public_path() . '/images/splashscreen/' . $old->image);
                }
            }
            $file->move('images/splashscreen/', $name);
            $input['image'] = $name;
        }

         if ($file = $request->file('logo')) {
            $logoname = 'splashscreen_' . time() . $file->getClientOriginalName();
            if ($old->logo != null) {
                $content = @file_get_contents(public_path() . '/images/splashscreen/logo/' . $old->logo);
                if ($content) {
                    unlink(public_path() . '/images/splashscreen/logo/' . $old->logo);
                }
            }
            $file->move('images/splashscreen/logo/', $logoname);
            $input['logo'] = $logoname;
        }


        $input['logo_enable'] = isset($request->logo_enable) ? $request->logo_enable : 0;
         //return $input;

        $old->update($input);

       

        return redirect('admin/splashscreen')->with('updated', 'SplashScreen has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SplashScreen  $splashScreen
     * @return \Illuminate\Http\Response
     */
  
   

   

}
