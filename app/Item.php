<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
//リレーション1対多
    public function channels()
    {
        return $this->hasMany('App\ItemChannel');
    }

    public function messages()
    {
        return $this->hasMany('App\ItemChannelMessage');
    }

    public function likes()
    {
        return $this->hasMany('App\ItemLike');
    }

    public function puchaseHistory()
    {
        return $this->hasOne('App\ItemPuchaseHistory');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

//出品
    public function merchandise($id, $path, $title, $content, $category, $condition_item, $delivery, $delivery_method, $area, $days_to_ship, $price){
        $user = new self();
        $user->user_id = $id;
        $user->images = $path;
        $user->title = $title;
        $user->content = $content;
        $user->category = $category;
        $user->condition_item = $condition_item;
        $user->delivery = $delivery;
        $user->delivery_method = $delivery_method;
        $user->area = $area;
        $user->days_to_ship = $days_to_ship;
        $user->price = $price;
        $user->status = 1;
        $user->save();
    }
//編集    
    public function merchandiseUpdate($item, $path, $title, $content, $category, $condition_item, $delivery, $delivery_method, $area, $days_to_ship, $price){
        $item->images = $path;
        $item->title = $title;
        $item->content = $content;
        $item->category = $category;
        $item->condition_item = $condition_item;
        $item->delivery = $delivery;
        $item->delivery_method = $delivery_method;
        $item->area = $area;
        $item->days_to_ship = $days_to_ship;
        $item->price = $price;
        $item->save();
    }
//削除
    public function itemDelete($item){
        $item->delete();
    }
//購入
    public function purchase($item){
        $item->status = 2;
        $item->save();
    }
// 配送中
    public function channel($item){
        $item->status = 3;
        $item->save();
    }
// 受取評価
    public function evaluation($item){
        $item->status = 4;
        $item->save();
    }
// 購入者を評価
    public function evaluationByClient($item){
        $item->status = 5;
        $item->save();
    }
}
