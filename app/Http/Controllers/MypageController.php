<?php

namespace App\Http\Controllers;

use App\ItemChannel;
use App\UserComment;
use Facades\App\ItemLike;
use Facades\App\User;
use Facades\App\UserMetaInfo;
use Facades\App\Item;
use Facades\App\Notification;
use Facades\App\UserAddressInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
// マイページ表示
    public function mypage(Request $request){
        $userId = Auth::user()->id;
        $evaluations = UserComment::where('client_id', $userId)->get();
        $good = 0;
        $bad = 0;
        foreach($evaluations as $evaluation){
            if($evaluation->evaluation == "良い" && $evaluation->type == "購入者"){
                $good = $good + 1;
            }elseif($evaluation->evaluation == "悪い" && $evaluation->type == "購入者"){
                $bad = $bad + 1;
            }
        }

        $evaluations = UserComment::where('user_id', $userId)->get();
        foreach($evaluations as $evaluation){
            if($evaluation->evaluation == "良い" && $evaluation->type == "出品者"){
                $good = $good + 1;
            }elseif($evaluation->evaluation == "悪い" && $evaluation->type == "出品者"){
                $bad = $bad + 1;
            }
        }
        return view('mypage')->with([
            'notices' => Notification::where('user_id', $userId)->get(),
            'good' => $good,
            'bad' => $bad,
        ]);

    }
//プロフィールの設定
    public function profile(Request $request){
        $request->validate([
            'avatar' => 'image|file',
            'nickname' => 'required|string|max:20',
            'content' => 'max:1000',
        ]);

        $user = Auth::user();
        if($request->has('avatar')){
            $path = $request->file('avatar')->store('public/avatars');
            $path = str_replace('public', '/storage', $path);
            $user->avatar = $path;
        }

        if($request->has('content')){
            $user->content = $request->get('content');
        }

        $user->nickname = $request->get('nickname');
        $user->save();
        return redirect()->route('completion');

    }
//発送元・お届け先リスト
    public function address(){
        return view('address_list')->with([
            'address' => Auth::user()->addresses,
        ]);

    }
//新規発送元・お届け先保存 
    public function addressInfo(Request $request){
        $request->validate([
            'last_name' => 'required|string|max:20',
            'first_name' => 'required|string|max:20',
            'last_name_kana' => 'required|string|max:20',
            'first_name_kana' => 'required|string|max:20',
            'postal_code' => 'required|integer',
            'area' => 'required',
            'municipalities' => 'required|max:30',
            'address' => 'required|max:100',
            'building_name' => 'max:50',
            'telephone_number' => 'required',
        ]);

        $user = Auth::user();
        UserAddressInfo::addressInfo(
            $user->id,
            $request->get('last_name'),
            $request->get('first_name'),
            $request->get('last_name_kana'),
            $request->get('first_name_kana'),
            $request->get('postal_code'),
            $request->get('area'),
            $request->get('municipalities'),
            $request->get('address'),
            $request->get('building_name'),
            $request->get('telephone_number'),   
        );
        
        return view('completion');

    }
//発送元・お届け先編集
    public function addressEdit(Request $request, $id){
        return view('address_edit')->with([
            'value' => UserAddressInfo::where('id', $id)->first(),
        ]);

    }

    public function addressUpdate(Request $request, $id){
        $request->validate([
            'last_name' => 'required|string|max:20',
            'first_name' => 'required|string|max:20',
            'last_name_kana' => 'required|string|max:20',
            'first_name_kana' => 'required|string|max:20',
            'postal_code' => 'required|integer',
            'area' => 'required',
            'municipalities' => 'required|max:30',
            'address' => 'required|max:100',
            'building_name' => 'max:50',
            'telephone_number' => 'required',
        ]);

        $user = UserAddressInfo::where('id', $id)->first();

        UserAddressInfo::addressInfoEdit(
            $user,
            $request->get('last_name'),
            $request->get('first_name'),
            $request->get('last_name_kana'),
            $request->get('first_name_kana'),
            $request->get('postal_code'),
            $request->get('area'),
            $request->get('municipalities'),
            $request->get('address'),
            $request->get('building_name'),
            $request->get('telephone_number'),   
        );
        
        return view('completion');

    }
//発送元・お届け先削除
    public function addressRemove(Request $request, $id){
        return view('address_delete')->with([
            'value' => UserAddressInfo::where('id', $id)->first(),
        ]);

    }

    public function addressDelete(Request $request, $id){
        $address = UserAddressInfo::where('id', $id)->first();
        UserAddressInfo::addressDelete($address);
        return redirect()->route('message')->with('message', '削除しました');

    }


//出品する
    public function merchandise(Request $request){
        $request->validate([
            'images' => 'required|image|file',
            'title' => 'required|max:20',
            'content' => 'max:1000',
            'category' => 'required',
            'condition_item' => 'required',
            'delivery' => 'required',
            'delivery_method' => 'required',
            'area' => 'required',
            'days_to_ship' => 'required',
            'price' => 'required|integer|max:1000000',
        ]);

        $path = $request->file('images')->store('public/images');
        $path = str_replace('public', '/storage', $path);
        $user = Auth::user();
        Item::merchandise(
            $user->id,
            $path,
            $request->get('title'),
            $request->get('content'),
            $request->get('category'),
            $request->get('condition_item'),
            $request->get('delivery'),
            $request->get('delivery_method'),
            $request->get('area'),
            $request->get('days_to_ship'),
            $request->get('price'),
        );

        return redirect()->route('mes')->with('message', '出品しました');
    }
//出品中の商品一覧
    public function itemList(Request $request){
        return view('item_list')->with([
            'items' => Auth::user()->items,
        ]);

    }
//売却中の商品一覧
    public function itemSaleList(Request $request){
        return view('item_sale_list')->with([
            'items' => Auth::user()->items,
        ]);

    }
//出品した商品
    public function itemGet(Request $request, $id){
        $evaluations = Auth::user()->comments;
        $good = 0;
        $bad = 0;
        foreach($evaluations as $evaluation){
            if($evaluation->evaluation == "良い"){
                $good = $good + 1;
            }elseif($evaluation->evaluation == "悪い"){
                $bad = $bad + 1;
            }
        }
        return view('item_show')->with([
            'value' => Item::where('id', $id)->first(),
            'good' => $good,
            'bad' => $bad,
        ]);

    }
//出品編集
    public function merchandiseEdit(Request $request, $id){
        return view('item_edit')->with([
            'value' => Item::where('id', $id)->first(),
        ]);
    }

    public function merchandiseUpdate(Request $request, $id){
        $request->validate([
            'images' => 'required|image|file',
            'title' => 'required|max:20',
            'content' => 'required|max:1000',
            'category' => 'required',
            'condition_item' => 'required',
            'delivery' => 'required',
            'delivery_method' => 'required',
            'area' => 'required',
            'days_to_ship' => 'required',
            'price' => 'required|integer|max:1000000',
        ]);

        $path = $request->file('images')->store('public/images');
        $path = str_replace('public', '/storage', $path);
        $item = Item::where('id', $id)->first();

        Item::merchandiseUpdate(
            $item,
            $path,
            $request->get('title'),
            $request->get('content'),
            $request->get('category'),
            $request->get('condition_item'),
            $request->get('delivery'),
            $request->get('delivery_method'),
            $request->get('area'),
            $request->get('days_to_ship'),
            $request->get('price'),
        );

    return redirect()->route('message')->with('message', '編集しました');

    }
//商品削除
    public function merchandiseDeleteGet(Request $request, $id){
        return view('merchandise_delete')->with([
            'value' => Item::where('id', $id)->first(),
        ]);
    }

    public function itemDelete(Request $request, $id){
        $value = Item::where('id', $id)->first();
        Item::itemDelete($value);
        return redirect()->route('message')->with('message', '削除しました');

    }
// お知らせリスト
    public function noticeList(Request $request){
        $userId = Auth::user()->id;
        return view('notice_list')->with([
            'notices' => Notification::where('user_id', $userId)->get(),
        ]);

    }
// やることリスト
    public function toDoList(Request $request){
        $userId = Auth::user()->id;
        return view('to_do_list')->with([
            'notices' => Notification::where('user_id', $userId)->get(),
        ]);
    }
// 購入履歴表示
    public function purchaseHistoryList(){
        $users = Auth::user()->purchaseHistories;
        $items = [];
        foreach($users as $user){
            $items[] = Item::where('id', $user->item_id)->get();
        }

        return view('purchase_history_list')->with([
            'items' => $items,
        ]);

    }
//お気に入りリスト表示
    public function likeList(){
        // お気に入り商品があるか確認
        $like = ItemLike::where('user_id', Auth::user()->id)->first();
        if($like){
            $users = Auth::user()->itemLikes;
            foreach($users as $user){
                $items[] = Item::where('id', $user->item_id)->get();
            }

            return view('like_list')->with([
                'users' => $users,
            ])->with('items', $items);
        // お気に入りがなかったら
        }else{
            return redirect()->back();
        }

    }
// 売り上げ履歴
    public function metaInfoList(){
        $pay = UserMetaInfo::where('user_id', Auth::user() ->id)->first();
        if(!$pay){
            $price = 0;
            UserMetaInfo::sales(Auth::user() ->id, $price);
            $metaInfo = Auth::user()->metaInfo;
            return view('meta_info_list')->with([
                'users' => false,
                'infos' => false,
                'metaInfo' => $metaInfo,
            ]);
        }else{
            $users = Auth::user()->salesHistories;
            $items = [];
            foreach($users as $user){
                $items[] = $user->item_id;
            }

            $infos = [];
            foreach($items as $item){
                $infos[] = Item::where('id', $item)->first();
            }
            // 売上金
            $metaInfo = Auth::user()->metaInfo;
            return view('meta_info_list')->with([
                'users' => $users,
                'infos' => $infos,
                'metaInfo' => $metaInfo,
            ]);
        }
    
    }
// 評価履歴
    public function evaluationList(Request $request){
        $comments = UserComment::where('client_id', Auth::user()->id)->get();
        $users = [];
        foreach($comments as $comment){
            $users[] = User::where('id', $comment->user_id)->first();
        }

        return view('evaluation_list')->with([
            'comments' => $comments,
            'users' => $users,
        ]);
    }

}
