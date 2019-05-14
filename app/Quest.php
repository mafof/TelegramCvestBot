<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model {
    protected $table = "quests";

    public function steps() {
        return $this->belongsToMany('App\QuestStep');
    }
}
