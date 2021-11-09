<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddressInfo extends Model
{
//発送元・お届け先保存
    public function addressInfo($id, $last_name, $first_name, $last_name_kana, $first_name_kana, $postal_code, $area, $municipalities, $address, $building_name, $telephone_number){
        $user = new self();
        $user->user_id = $id;
        $user->last_name = $last_name;
        $user->first_name = $first_name;
        $user->last_name_kana = $last_name_kana;
        $user->first_name_kana = $first_name_kana;
        $user->postal_code = $postal_code;
        $user->area = $area;
        $user->municipalities = $municipalities;
        $user->address = $address;
        $user->building_name = $building_name;
        $user->telephone_number = $telephone_number;
        $user->save();
    }
//編集
    public function addressInfoEdit($user, $last_name, $first_name, $last_name_kana, $first_name_kana, $postal_code, $area, $municipalities, $address, $building_name, $telephone_number){
        $user->last_name = $last_name;
        $user->first_name = $first_name;
        $user->last_name_kana = $last_name_kana;
        $user->first_name_kana = $first_name_kana;
        $user->postal_code = $postal_code;
        $user->area = $area;
        $user->municipalities = $municipalities;
        $user->address = $address;
        $user->building_name = $building_name;
        $user->telephone_number = $telephone_number;
        $user->save();
    }
//削除
    public function addressDelete($address){
        $address->delete();
    }
}
