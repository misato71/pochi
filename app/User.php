<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//リレーション1対多
    public function histories()
    {
        return $this->hasMany('App\UserAccountHistory');
    }

    public function addresses()
    {
        return $this->hasMany('App\UserAddressInfo');
    }

    public function comments()
    {
        return $this->hasMany('App\UserComment');
    }

    public function metaInfo()
    {
        return $this->hasOne('App\UserMetaInfo');
    }

    public function pays()
    {
        return $this->hasMany('App\UserPayInfo');
    }

    public function transfers()
    {
        return $this->hasMany('App\UserTransferInfo');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function purchaseHistories()
    {
        return $this->hasMany('App\ItemPuchaseHistory');
    }

    public function itemLikes()
    {
        return $this->hasMany('App\ItemLike');
    }

    public function salesHistories()
    {
        return $this->hasMany('App\SalesHistory');
    }

//新規会員登録
    public function verifyEmail($email, $token){
        $user = new self();
        $user->email = $email;
        $user->email_verify_token = $token;
        $user->save();
    }

    public function member($user, $nickname, $password, $last_name, $first_name, $last_name_kana, $first_name_kana, $birthday){
        $user->nickname = $nickname;
        $user->password = Hash::make($password);
        $user->last_name = $last_name;
        $user->first_name = $first_name;
        $user->last_name_kana = $last_name_kana;
        $user->first_name_kana = $first_name_kana;
        $user->birthday = $birthday;
        $user->status = 1;
        $user->email_verify_token = null;
        $user->save();
    }

//パスワード再設定
    public function tokenNew($user, $token){
        $user->email_verify_token = $token;
        $user->save();
    }

    public function passwordNew($user, $new_password){
        $user->password = Hash::make($new_password);
        $user->email_verify_token = null;
        $user->save();
    }
    
}
