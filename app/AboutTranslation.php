<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutTranslation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'lang_code',
        'meta_title',
        'meta_desc',
        'meta_keywords',
        'about_id',
        'status',
    ];

    public function language() {
        return $this->hasOne(Language::class,'code', 'lang_code');
    }

    public function about() {
        return $this->belongsTo('App\About');
    }
    

}
