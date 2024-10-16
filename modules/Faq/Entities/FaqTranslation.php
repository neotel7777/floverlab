<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','description'];


}
