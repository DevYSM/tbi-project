<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function translations() {
        return $this->hasMany('App\ProjectTranslations');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function technologies()
    {
        return $this->belongsToMany('App\Technology');
    }

}
