<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemChannelMessage extends Model
{
    public function message($userId, $id, $content){
        $message = new self();
        $message->owner_id = $userId;
        $message->channel_id = $id;
        $message->content = $content;
        $message->save();
    }
}
