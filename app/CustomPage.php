<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{

    protected $fillable = [
      'title',
      'in_show_menu',
      'detail',
      'slug',
      'is_active',
      	
    ];

    public function menu()
    {
      return $this->belongsTo('App\Menu');
    }
    
}
