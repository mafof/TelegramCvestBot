<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model {
    protected $table = "privileges";
    public $timestamps = false;

    public function group() {
        return $this->belongsToMany('App\Group');
    }
}
