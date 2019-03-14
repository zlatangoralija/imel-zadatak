<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];

    //Kreiranje accessor-a da ne bi rucno svaki put pisali source = /images/
    protected $uploads = '/images/';

    public function getFileAttribute($photo){
        return $this->uploads.$photo;
    }
}
