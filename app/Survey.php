<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    protected $guarded = ['survey_token'];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function created_by(){
        $user = User::find($this->user_id)->name;
        return $user;
    }


}
