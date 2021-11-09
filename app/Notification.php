<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
// 購入
    public function purchase($userId, $notice){
        $inc = new self();
        $inc->user_id = $userId;
        $inc->status = 2;
        $inc->notice = $notice;
        $inc->save();
    }
// 発送
    public function channel($userId, $notice){
        $inc = new self();
        $inc->user_id = $userId;
        $inc->status = 3;
        $inc->notice = $notice;
        $inc->save();
    }
// 受取評価
    public function evaluation($userId, $notice){
        $inc = new self();
        $inc->user_id = $userId;
        $inc->status = 4;
        $inc->notice = $notice;
        $inc->save();
    }
// 購入者を評価 
    public function evaluationByClient($userId, $notice){
        $inc = new self();
        $inc->user_id = $userId;
        $inc->status = 5;
        $inc->notice = $notice;
        $inc->save();
    }

}
