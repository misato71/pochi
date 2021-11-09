<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPuchaseHistory extends Model
{
    public function purchase($userId, $id){
        $user = new self();
        $user->user_id = $userId;
        $user->item_id = $id;
        $user->status = 1;
        $user->save();
    }
}
