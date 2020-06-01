<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesTranslation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'lang_code',
        'meta_title',
        'meta_desc',
        'meta_keywords',
        'services_id',
        'status',
    ];

    public function service() {
        return $this->belongsTo('App\Services');
    }

}
