<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestStepOption extends Model {
    protected $table = "quest_step_options";

    public function steps() {
        return $this->belongsToMany('App\QuestStep');
    }

}
