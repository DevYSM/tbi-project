<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillalbe = [
        'main_title',
        'icon',
        'photo',
        'status',
    ];

    public function translations() {
        return $this->hasMany('App\ServicesTranslation');
    }

}
