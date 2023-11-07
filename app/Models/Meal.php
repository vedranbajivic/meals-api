<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    
    public $translatedAttributes = ['title','description'];

    public function category()
    {
        return $this->belongsTo(Category::class)->withTranslation('title', app()->getLocale());
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTranslation('title', app()->getLocale());
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withTranslation('title', app()->getLocale());
    }
    
}


