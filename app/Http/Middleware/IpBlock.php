<?php

namespace App\Http\Middleware;

use Closure;
use App\Button;

class IpBlock
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
        
        if(isset($button) && $button->ip_block =='1'){
            $macaddress = $_SERVER['REMOTE_ADDR'];
            $block_ip = $button->block_ips;

            if(isset($block_ip) && in_array($macaddress, $block_ip,true))
            {
                abort(403);
               
            }
            else{
              return $next($request);
            }

        }
        else{
            return $next($request);
        }
    }
}
