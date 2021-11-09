<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemLike extends Model
{
// お気に入り
    public function like ($user, $item){
        $like = new self();
        $like->user_id = $user;
        $like->item_id = $item;
        $like->save();
    }
//　お気に入りを解除    
    public function deleteLike($item){
        $item->delete();
    }
}
