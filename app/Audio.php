<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    //
    protected $fillable = [
      'title',
      'fetch_by',
      'keyword',
      'description',
      'thumbnail',
      'poster',
      'genre_id',
      'detail',
      'rating',
      'upload_audio',
      'maturity_rating',
      'featured',
      'type',
      'status',
      'is_protect',
      'password',
      'audiourl'
    ];
}
