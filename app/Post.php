<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'content',
        'slug'
    ];

    static public function titleToSlug($string)
    {
        $baseSlug = Str::of($string)->slug('-')->__toString();
        $slug = $baseSlug;
        $_i = '1';
        while (self::where('slug', $slug)->first()) {
            $slug = "$baseSlug-$_i";
            $_i++;
        }
        return $slug;
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
