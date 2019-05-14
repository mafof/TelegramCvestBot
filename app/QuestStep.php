<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestStep extends Model {
    protected $table = "quest_steps";

    public function quests() {
        return $this->belongsToMany('App\Quest');
    }

    public function options() {
        return $this->belongsToMany('App\QuestStepOption');
    }
}
