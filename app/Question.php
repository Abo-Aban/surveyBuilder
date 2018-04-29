<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function survey(){
        return $this->belongsTo(Survey::class);
    }

    public function partici(){
        return $this->hasMany(Partici::class);
    }

}
