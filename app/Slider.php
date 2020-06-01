<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'description',
        'photo',
        'status',
        'lang_code',
    ];

    public function language() {
        return $this->hasOne('App\Language','code', 'lang_code');
    }
  
}
