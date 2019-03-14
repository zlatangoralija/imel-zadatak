<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    //Kreiranje slug-a, odnosno dijela URL koji upućuje na određeni post
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = [
        'title', 'body', 'user_id', 'category_id', 'photo_id'
    ];
    //Kreiranje relacije post->user
    public function user(){
        return $this->belongsTo('App\User');
    }
    //Kreiranje relacije post->photo
    public function photo(){
        return $this->belongsTo('App\Photo');
    }
    //Krairanje relacije post->category
    public function category(){
        return $this->belongsTo('App\Category');
    }
    //Kreiranje placeholder slike ukoliko slika nije postavljena prilikom kreiranja post-a
    public function photoPlaceholder(){
        return "http://placehold.it/700x200";
    }
}
