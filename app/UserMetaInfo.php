<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMetaInfo extends Model
{
    public function sales($userId, $price){
        $user = new self();
        $user->user_id = $userId;
        $user->total_sales = $price;
        $user->point = $price;
        $user->save();
    }

    public function metaInfo($user, $userId, $price){
        $user->user_id = $userId;
        $user->total_sales = $user->total_sales + $price;
        $user->point = $user->point + $price;
        $user->save();
    }

    
}
