<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesHistory extends Model
{
    public function sales($itemId, $userId, $sales, $commission){
        $inc = new self();
        $inc->item_id = $itemId;
        $inc->user_id = $userId;
        $inc->sales = $sales;
        $inc->commission = $commission;
        $inc->save();
    }

}
