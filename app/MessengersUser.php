<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessengersUser extends Model {
    protected $table = "messengers_users";
    public $timestamps = false;

    protected $fillable = [
        'messenger_identifier', 'quest_done_count', 'quest_created_count', 'messenger_type', 'user_id'
    ];

    public static function getUser($identifier) {
        return MessengersUser::where('messenger_identifier', $identifier)->get()->first();
    }
}
