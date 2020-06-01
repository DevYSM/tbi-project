<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{

    protected $fillable = [
        'main_title',
        'status',
    ];

    // Get All Transliations Of About
    public function translations() {
        return $this->hasMany('App\AboutTranslation');
    }
    
}
