<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'title',
        'code	',
        'is_rtl',
    ];

    public function slider(){
        return $this->hasMany('App\Slider');
    }
    public function about(){
        return $this->hasMany('App\AboutTranslation','lang_code','code' );
    }
 
}
