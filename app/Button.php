<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
   protected $casts = [
        'commingsoon_enabled_ip' => 'array',
        'block_ips' => 'array',
        'maintenance_enabled_ip' => 'array',
    ];
  

   protected $fillable = [
      'inspect',
      'rightclick',
      'goto',
      'color',
      'uc_browser',
      'comming_soon',
      'commingsoon_enabled_ip',
      'comming_soon_text',
      'ip_block',
      'block_ips',
      'remove_subscription',
      'protip'
      
    ];
}


