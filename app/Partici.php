<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partici extends Model
{

    protected $table = 'participations';


    public function question(){
        return $this->belongsTo(Question::class);
        // return $this->belongsTo(َQuestion::class);
    }
}
