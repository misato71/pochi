<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPayInfo extends Model
{
//購入-クレカ登録
    public function purchase($id, $card_number, $year_month, $security_code){
        $card = new self();
        $card->user_id = $id;
        $card->card_number = $card_number;
        $card->year_month = $year_month;
        $card->security_code = $security_code;
        $card->save();
    }
}
