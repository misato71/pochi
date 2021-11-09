<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemChannel extends Model
{
// 購入
    public function purchase($userId, $clientId, $id){
        $channel = new self();  
        $channel->user_id = $userId;
        $channel->client_id = $clientId;
        $channel->item_id = $id;
        $channel->status = 2;
        $channel->save();
    }
// 発送
    public function status($channel){
        $channel->status = 3;
        $channel->save();
    }
// 受取評価
    public function evaluation($channel){
        $channel->status = 4;
        $channel->save();
    }
// 購入者を評価
    public function evaluationByClient($channel){
        $channel->status = 5;
        $channel->save();
    }
}
