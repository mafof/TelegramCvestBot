<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {
    protected $table = "groups";

    public function users() {
        return $this->hasMany('App\User', 'id');
    }

    public function privilege() {
        return $this->belongsToMany('App\Privilege');
    }
}
