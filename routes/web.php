<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//トップ
// 高い順or低い順
Route::get('/', 'ItemController@top')->name('home');
Route::view('/top/show', 'top')->name('top');
//検索
Route::get('/search', 'ItemController@search');
//カテゴリ
Route::view('category/list', 'category_list');
Route::get('/category/{category}', 'ItemController@category')->name('category');
//商品を表示
Route::get('/merchandise/show/{id}', 'ItemController@showMerchandise')->name('merchandise_show');
Route::view('/show/merchandise/{id}', 'show_merchandise')->name('show_merchandise');

Route::get('/price/{id}', 'ItemController@price')->name('price');

//新規会員登録
Route::view('/register', 'register')->name('register');
Route::post('/register', 'AuthController@sendEmail');
Route::view('/register/sent', 'register_sent')->name('register_sent');
//トークン確認
Route::get('/register/verify/{token}', 'AuthController@verifyToken');
//会員情報入力
Route::view('/member', 'member')->name('member');
Route::post('/member', 'AuthController@member')->name('register_member');
Route::view('/member/sent', 'member_sent')->name('member_sent');
//ログイン
Route::view('/login', 'login')->name('login_view')->middleware('guest');
Route::post('/login', 'AuthController@login')->name('login');
//ログアウト
Route::view('/logout', 'logout')->middleware('auth');
Route::get('/logout/sent', 'Authcontroller@logout')->name('logout_sent');
//パスワード変更
Route::view('/password/reset', 'password_reset')->name('password')->middleware('auth');
Route::post('/password/reset', 'AuthController@passwordReset')->name('password_reset')->middleware('auth');
Route::view('/password/sent', 'password_sent')->name('password_sent')->middleware('auth');
//パスワード再設定
Route::view('/email/verify', 'email_verify')->name('email_verify');
Route::post('/email/verify', 'AuthController@tokenNew')->name('token_new');
Route::get('/password/verify/{token}', 'AuthController@verifyPassword');
Route::view('/password/new', 'password_new')->name('password_new');
Route::post('/password/new', 'AuthController@passwordNew');
//退会
Route::view('/cansel', 'cansel')->middleware('auth');
Route::post('/questionnaire', 'AuthController@questionnaire')->name('questionnaire');
Route::view('/cansel/password/verify', 'cansel_password_verify')->name('cansel_password')->middleware('auth');
Route::post('/cansel/password/verify', 'AuthController@canselPasswordVerify')->middleware('auth');                      
Route::view('/cansel/membership/sent', 'cansel_the_membership_sent')->name('cansel_the_membership_sent')->middleware('auth');


//マイページ表示
Route::get('/mypage', 'MypageController@mypage')->name('mypage')->middleware('auth');
Route::view('/setting', 'setting')->middleware('auth');
//本人情報編集
Route::view('/password/verify', 'password_verify')->middleware('auth');
Route::post('/password/verify', 'AuthController@passwordVerify');
Route::view('/member/edit', 'member_edit')->name('member_edit')->middleware('auth');
Route::post('/member/update', 'AuthController@memberUpdate')->name('member_update')->middleware('auth');
//新規発送元・お届け先登録
Route::view('/address/info', 'address_info')->name('address_info')->middleware('auth');
Route::post('/address/info', 'MypageController@addressInfo')->name('address')->middleware('auth');
//登録完了画面
Route::view('/completion', 'completion')->name('completion')->middleware('auth');
//発送元・お届け先リスト
Route::get('/address', 'MypageController@address');
Route::view('/address/list', 'address_list')->name('address_list')->middleware('auth');
//発送元・お届け先編集
Route::get('/address/get/{id}', 'MypageController@addressEdit')->name('get_address')->middleware('auth', 'id');
Route::view('/address/edit/{id}', 'address_edit')->name('address_edit')->middleware('auth', 'id');
Route::post('/address/update/{id}', 'MypageController@addressUpdate')->name('address_update')->middleware('auth', 'id');
//発送元・お届け先削除
Route::get('/address/remove/{id}', 'MypageController@addressRemove')->name('address_remove')->middleware('auth', 'id');
Route::view('/user/address/delete/{id}', 'address_delete')->name('address_delete')->middleware('auth', 'id');
Route::post('/address/delete/{id}', 'MypageController@addressDelete')->name('delete_address')->middleware('auth', 'id');
//メッセージ
Route::view('/message', 'message')->name('mes')->middleware('auth');
//プロフィールの設定
Route::view('/profile/edit', 'profile_edit')->middleware('auth');
Route::post('/profile', 'MypageController@profile')->name('profile')->middleware('auth');


//出品する
Route::view('/item', 'item')->middleware('auth');
Route::post('/merchandise', 'MypageController@merchandise')->name('merchandise')->middleware('auth');
//出品中のリスト
Route::get('/item/list/get', 'MypageController@itemList')->middleware('auth');
Route::view('/item/list', 'item_list')->name('item_list')->middleware('auth');
//売却済みのリスト
Route::get('/item/sale/list/get', 'MypageController@itemSaleList')->middleware('auth');
Route::view('/item/sale/list', 'item_sale_list')->name('item_sale_list')->middleware('auth');
//出品した商品を表示
Route::get('/item/get/{id}', 'MypageController@itemGet')->name('item_get')->middleware('auth', 'user');
Route::view('/item/show/{id}', 'item_show')->name('item_show')->middleware('auth', 'user');
//出品編集
Route::get('/merchandise/edit/{id}', 'MypageController@merchandiseEdit')->name('merchandise_edit')->middleware('auth', 'user');
Route::view('/item/edit/{id}', 'item_edit')->name('item_edit')->middleware('auth', 'user');
Route::post('/merchandise/update/{id}', 'MypageController@merchandiseUpdate')->name('merchandise_update')->middleware('auth', 'user');
//出品削除
Route::get('/merchandise/delete/get/{id}', 'MypageController@merchandiseDeleteGet')->name('merchandise_delete_get')->middleware('auth', 'user');
Route::view('/merchandise/delete/{id}', 'merchandise_delete')->name('merchandise_delete')->middleware('auth', 'user');
Route::post('/item/delete/{id}', 'MypageController@itemDelete')->name('item_delete')->middleware('auth', 'user');


//購入-ログイン状況確認
Route::get('/checkLogin/{id}', 'ItemController@checkLogin')->name('checklogin');
//購入内容の確認
Route::view('/purchase/{id}', 'purchase')->name('purchase')->middleware('auth');
//購入-ログイン
Route::view('/purchase/login/{id}', 'purchase_login')->name('purchase_login')->middleware('guest');
Route::post('/purchase/login/{id}', 'ItemController@purchaseLogin')->name('purchase_login_get');
//購入-クレカ追加
Route::get('/purchase/card/{id}', 'ItemController@purchase_card')->name('purchase_card');
Route::view('/purchase/card/info/{id}', 'purchase_card_info')->name('purchase_card_info')->middleware('auth');
Route::post('/purchase/card/register/{id}', 'ItemController@purchase')->name('purchase_card_register');
//購入-発送元・お届け先追加
Route::get('/purchase/address/get/{id}', 'ItemController@addressGet')->name('address_get')->middleware('auth');
Route::view('/purchase/address/info/{id}', 'purchase_address_info')->name('purchase_address_info')->middleware('auth');
Route::post('purchase/address/{id}', 'ItemController@purchase_address_info')->name('purchase_address')->middleware('auth');
//購入-新規会員登録
Route::get('/purchase/register/get/{id}', 'ItemController@purchaseRegister')->name('purchase_register_get');
Route::view('/purchase/register/{id}', 'purchase_register')->name('purchase_register');
Route::post('/purchase/register/{id}', 'ItemController@sendEmail')->name('purchase_email');
Route::view('/register/sent', 'register_sent')->name('register_sent');
//購入-トークン確認
Route::get('/register/verify/{id}/{token}', 'ItemController@verifyToken');
//購入-会員情報入力
Route::view('/purchase/member/{id}', 'purchase_member')->name('purchase_member');
Route::post('/purchase/member/info/{id}', 'ItemController@purchaseMember')->name('purchase_member_info');
//購入
Route::post('/purchase/get/{id}', 'ItemController@purchaseGet')->name('purchase_get');

// チャット
Route::get('/channel/{id}', 'ItemController@channel')->name('channel')->middleware('auth');
Route::post('/message/{id}', 'ItemController@message')->name('message')->middleware('auth');
// ステータスの変更
Route::post('/status/{id}', 'ItemController@status')->name('status')->middleware('auth');
// 評価
Route::post('/evaluation/{id}', 'ItemController@evaluation')->name('evaluation')->middleware('auth');

//お知らせ
Route::get('/notice/list/get', 'MypageController@noticeList')->name('notice_list_get')->middleware('auth');
Route::view('/notice/list', 'notice_list')->name('notice_list')->middleware('auth');
// やることリスト
Route::get('/to/do/list/get', 'MypageController@toDoList')->name('to_do_list_get')->middleware('auth');
Route::view('/to/do/list', 'to_do__list')->name('to_do_list')->middleware('auth');
//購入履歴
Route::get('/purchase/history/list/get', 'MypageController@purchaseHistoryList')->name('purchase_history_list_get')->middleware('auth');
Route::view('/purchase/history/list', 'purchase_history_list')->name('purchase_history_list')->middleware('auth');

// お気に入り
Route::get('/like/{id}', 'ItemController@like')->name('like')->middleware('auth');
// お気に入りリスト表示
Route::get('/like/list/get', 'MypageController@likeList')->name('like_list_get')->middleware('auth');
Route::view('/like/list', 'like_list')->name('like_list')->middleware('auth');
// 売り上げ履歴
Route::get('/meta/info/list/get', 'MypageController@metaInfoList')->name('meta_info_list_get')->middleware('auth');
Route::view('/meta/info/list', 'meta_info_list')->name('meta_info_list')->middleware('auth');
// 評価履歴
Route::get('/evaluation/list/get', 'MypageController@evaluationList')->middleware('auth');
Route::view('/evaluation/list', 'evaluation_list')->name('evaluation_list')->middleware('auth');

