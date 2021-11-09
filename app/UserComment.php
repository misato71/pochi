<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
// 評価
    public function evaluation($userId, $clientId, $itemId, $content, $evaluation, $type){
        $inc = new self();
        $inc->user_id = $userId;
        $inc->client_id = $clientId;
        $inc->item_id = $itemId;
        $inc->content = $content;
        $inc->evaluation = $evaluation;
        $inc->type = $type;
        $inc->save();
    }


}
