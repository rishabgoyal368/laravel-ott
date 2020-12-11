<?php

namespace App\Http\Middleware;

use Closure;
use App\Button;

class CommingSoon
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
        $button = Button::first();
        
        if(isset($button) && $button->comming_soon =='1'){
            $macaddress = $_SERVER['REMOTE_ADDR'];
            $enabled_ip = $button->commingsoon_enabled_ip;

            if(in_array($macaddress, $enabled_ip,true))
            {
                return $next($request);
               
            }
            else{
              
                abort(503);
               
            }
        }
        else{
            return $next($request);
        }

       
    }
}
