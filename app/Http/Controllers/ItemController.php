<?php

namespace App\Http\Controllers;

use Facades\App\SalesHistory;
use Facades\App\UserMetaInfo;
use Facades\App\UserComment;
use Facades\App\ItemChannelMessage;
use Facades\App\ItemLike;
use Facades\App\Notification;
use Facades\App\ItemChannel;
use Facades\App\ItemPuchaseHistory;
use Carbon\Carbon;
use Facades\App\User;
use Facades\App\UserPayInfo;
use Facades\App\Item;
use Facades\App\UserAddressInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ItemController extends Controller
{
//トップ   
    public function top(){
        if(Auth::user()){
            $l = ItemLike::where('user_id', Auth::user()->id)->first();
            $like = Auth::user()->itemLikes;
            if($l){
                return view('top')->with([
                    'items' => Item::get(),
                    'like' => $like,
                ]);
            }else{
                return view('top')->with([
                    'items' => Item::get(),
                    'like' => false,
                ]);
            }
        }else{
            return view('top')->with([
                'items' => Item::get(),
                'like' => false,
            ]);
        }
    }
//検索
    public function search(Request $request){
        $query = str_replace('　', ' ', $request->get('q'));
        $query = explode(' ', $query);
        $array = [];
        foreach($query as $q){
            $array[] = ['sq', 'like', "%$q%"];
        }

        $items = Item::select('id', DB::raw('CONCAT(title,content) as sq'));
        $items = Item::joinSub($items, 'search', function ($join) {
            $join->on('items.id', '=', 'search.id');
        })->where($array)->get();
    
        if(Auth::user()){
            $like = Auth::user()->itemLikes;
            if($like){
                return view('top')->with([
                    'items' => $items,
                    'like' => $like,
                ]);
            }else{
                return view('top')->with([
                    'items' => $items,
                    'like' => false,
                ]);
            }
        }else{
            return view('top')->with([
                'items' => $items,  
                'like' => false,
            ]);
        }


    }
//カテゴリ
    public function category(Request $request, $category){
        $item = Item::where('category', $category)->first();
        if($item){
            $items = Item::where('category', $category)->get();
            $like = Auth::user()->itemLikes;
            if($like){
                return view('top')->with([
                    'items' => $items,
                    'like' => $like,
                ]);
            }else{
                return view('top')->with([
                    'items' => $items,
                    'like' => false,
                ]); 
            }
        }else{
            return redirect()->back()->with('message', '商品がみつかりません');
        }

    }
//商品詳細画面
    public function showMerchandise(Request $request, $id){
        $item = Item::where('id', $id)->first();
        $evaluation = UserComment::where('user_id', $item->user_id)->first();
        $evaluation2 = UserComment::where('user_id', $item->user_id)->first();
        $good = 0;
        $bad = 0;
        if($evaluation || $evaluation2){
            $evaluations = UserComment::where('client_id', $item->user_id)->get();
            foreach($evaluations as $evaluation){
                if($evaluation->evaluation == "良い" && $evaluation->type == "購入者"){
                    $good = $good + 1;
                }elseif($evaluation->evaluation == "悪い" && $evaluation->type == "購入者"){
                    $bad = $bad + 1;
                }
            }
        }

        $evaluations = UserComment::where('user_id', $item->user_id)->get();
        foreach($evaluations as $evaluation){
            if($evaluation->evaluation == "良い" && $evaluation->type == "出品者"){
                $good = $good + 1;
            }elseif($evaluation->evaluation == "悪い" && $evaluation->type == "出品者"){
                $bad = $bad + 1;
            }
        }
        // 出品した商品
        if(Auth::user()){
            if($item->user_id == Auth::user()->id){
                return view('item_show')->with([
                    'value' => $item,
                    'good' => $good,
                    'bad' => $bad,
                ]);
            }

        }
        $count = Item::where('user_id', $item->user_id)->count();
        // お気に入りか確認
        if(Auth::user()){
            $like = ItemLike::where('item_id', $id)->where('user_id', Auth::user()->id)->first();
            if($like){
                return view('show_merchandise')->with([
                    'value' => $item,
                    'like' => $like,
                    'user' => User::where('id', $item->user_id)->first(),
                    'good' => $good,
                    'bad' => $bad,
                    'count' => $count,
                ]);
            }else{
                return view('show_merchandise')->with([
                    'value' => $item,
                    'like' => false,
                    'user' => User::where('id', $item->user_id)->first(),
                    'good' => $good,
                    'bad' => $bad,
                    'count' => $count,
                ]);
            }
        }else{
            return view('show_merchandise')->with([
                'value' => $item,
                'like' => false,
                'user' => User::where('id', $item->user_id)->first(),
                'good' => $good,
                'bad' => $bad,
                'count' => $count,
            ]);
        }


    }
//購入内容確認
    public function checkLogin($id){
        $user = Auth::user();
        if($user){
            return view('purchase', ['id'=>$id])->with([
                'value' => Item::where('id', $id)->first(),
                'card' => Auth::user()->pays,
            ]);
        }else{
            return view('purchase_login', ['id'=>$id]);
        }

    }
//ログイン
    public function purchaseLogin(Request $request, $id){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);
        $credentials['status'] = 1;
        if(Auth::attempt($credentials)){
            return view('purchase', ['id'=>$id])->with([
                'value' => Item::where('id', $id)->first(),
                'card' => Auth::user()->pays,
            ]);           
        }else{
            return redirect()->back()->with('message', 'メールアドレスまたはパスワードが違います');
        }

    }
//クレカ登録画面
    public function purchase_card($id){
        return view('purchase_card_info', ['id'=>$id]);

    }
//クレカ登録
    public function purchase(Request $request, $id){
        $request->validate([
            'card_number' => 'required|max:18',
            'year_month' => 'required',
            'security_code' => 'required|max:4',
        ]);
        $user = Auth::user();
        UserPayInfo::purchase(
            $user->id,
            $request->get('card_number'),
            $request->get('year_month'),
            $request->get('security_code'),
        );

        return redirect()->route('checklogin', ['id'=>$id]);
    }
//発送元・お届け先追加
    public function addressGet($id){
        return view('purchase_address_info', ['id'=>$id]);

    }

    public function purchase_address_info(Request $request, $id){
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
        
        return redirect()->route('checklogin', ['id'=>$id]);
    }
//新規会員登録
    public function purchaseRegister($id){
        return view('purchase_register', ['id'=>$id]);

    }
//トークン
    public function sendEmail(Request $request, $id){
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->get('email');
        $token = Str::random(50);
        User::verifyEmail($email, $token);
        return redirect()->route('register_sent');
        
    }
    public function verifyToken($id, $token){
        $user = User::where('email_verify_token', $token)->first();
        if($user){
            session()->put('register_user', $user);
            return view('purchase_member', ['id'=>$id]);
        }else{
            abort(403);
        }
    }
//会員情報入力
    public function purchaseMember(Request $request, $id){
        $now = Carbon::now();
        $request->validate([
            'nickname' => 'required|max:20',
            'password' => 'required|min:7|regex:/^[a-zA-Z0-9]+$/|confirmed',
            'last_name' => 'required|string|max:20',
            'first_name' => 'required|string|max:20',
            'last_name_kana' => 'required|string|max:20',
            'first_name_kana' => 'required|string|max:20',
            'birthday' => 'required|date_format:Y-m-d|before_or_equal:' . $now->format('Y-m-d'),
        ],[
            'password.regex' => '7文字以上の半角英数字で入力'
        ]); 
        $user = session()->get('register_user');
        if(!$user)
            abort(401);

        User::member(
            $user,
            $request->get('nickname'),
            $request->get('password'),
            $request->get('last_name'),
            $request->get('first_name'),
            $request->get('last_name_kana'),
            $request->get('first_name_kana'),
            $request->get('birthday')
        );
        session()->forget('register_user');

        return view('purchase_login', ['id'=>$id]);

    }
//購入
    public function purchaseGet(Request $request, $id){
        //soldout表示
        $item = Item::where('id', $id)->first();
        Item::purchase($item);

        //購入履歴の登録
        $userId = Auth::user()->id;
        ItemPuchaseHistory::purchase(
            $userId,
            $id
        );

        // チャンネル登録
        $clientId = $item->user_id;
        ItemChannel::purchase($userId, $clientId, $id);

        //お知らせの登録
        $nickname = Auth::user()->nickname;
        $title = $item->title;
        $notice = $nickname."さんが".$title."を購入しました。内容を確認の上、商品の発送をお願いします";
        Notification::purchase($clientId, $notice);
        $notice2 = $title."を購入しました。出品者からの発送まで今しばらくお待ちください";
        Notification::purchase($userId, $notice2);

        return redirect()->route('mes')->with('message', 'ご購入ありがとうございます！出品者からの発送をお待ちください');

    }
// お気に入り
    public function like(Request $request, $id){
        // ログイン確認
        if (Auth::user()){
            $user = Auth::user()->id;
        // お気に入りにuser_idとitem_idがあるか確認
            $item = ItemLike::where('item_id', $id)->where('user_id', $user)->first();
            if($item){
                // ある場合削除
                ItemLike::deleteLike($item);
                return redirect()->back();
            }else{
                // ない場合保存
                ItemLike::like($user, $id);
                $like = ItemLike::where('item_id', $id)->where('user_id', $user)->first();
                return redirect()->back()->with([
                    'like' => $like,
                ]);
            }
        }else{
        // ログインしてない場合ログイン画面に
            return view('purchase_login', ['id'=>$id]);
        }

    }
// 購入-チャット
    public function channel(Request $request, $id){
        // チャット履歴があるか
        $channel = ItemChannel::where('item_id', $id)->first();
        $messages = ItemChannelMessage::where('channel_id', $channel->id)->get();
        // 購入者情報
        $user = User::where('id', $channel->user_id)->first();
        // 出品者側のチャットか
        $item = Item::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if($item && $item->puchaseHistory){
            if($messages){
                return view('channel_client')->with([
                    'value' => Item::find($id),
                    'messages' => $messages,
                    'user' => $user,
                    'channel' => $channel,
                ]);
            }else{
                return view('channel_client')->with([
                    'value' => Item::find($id),
                ]);
            }
        }

        // 出品者情報
        $client = User::where('id', $channel->client_id)->first();
        // 購入者側のチャットか
        $user = Auth::user()->purchaseHistories()->where('item_id', $id)->first();
        if($user ){
            if($messages){
                return view('channel')->with([
                    'value' => Item::find($id),
                    'messages' => $messages,
                    'client' => $client,
                    'channel' => $channel,
                ]);
            }else{
                return view('channel')->with([
                    'value' => Item::find($id),
                ]);
            }

        }

        return redirect()->back()->with('message', '間違った動作です' );
    }
// チャット履歴保存
    public function message(Request $request, $id){
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        $userId = Auth::user()->id;
        $content = $request->get('content');
        ItemChannelMessage::message($userId, $id, $content);

        return redirect()->back();

    }
// 発送しました
    public function status(Request $request, $id){
        // ステータスの変更
        $channel = ItemChannel::where('id', $id)->first();
        ItemChannel::status($channel);
        $item = Item::where('id', $channel->item_id)->first();
        Item::channel($item);
        //お知らせの登録
        $notice = "出品者が" . $item->title . "の発送をしました。届きましたら受取評価をしてください";
        Notification::channel($channel->user_id, $notice);
        return redirect()->back();

    }
// 評価
    public function  evaluation(Request $request, $id){
        $request->validate([
            'content' => 'max:1000',
            'evaluation' => 'required',
        ]);

        // 評価を保存
        $channel = ItemChannel::where('id', $id)->first();
        $content = $request->get('content');
        $evaluation = $request->get('evaluation');
        if($channel->user_id == Auth::user()->id){
            $type = '購入者';
        }elseif($channel->client_id == Auth::user()->id){
            $type = '出品者';
        }
        UserComment::evaluation($channel->user_id, $channel->client_id, $channel->item_id, $content, $evaluation, $type);
        $item = Item::where('id', $channel->item_id)->first();
        if($channel->status == 3){
            // ステータス変更
            ItemChannel::evaluation($channel);
            Item::evaluation($item);
            $user = User::where('id', $channel->user_id)->first();
            //お知らせの登録
            $notice = $user->nickname . "さんが受取評価をしました。購入者の評価をしてください";
            Notification::evaluation($channel->client_id, $notice);
        }elseif($channel->status == 4){
            // ステータス変更
            ItemChannel::evaluationByClient($channel);
            Item::evaluationByClient($item);
            //お知らせの登録
            $notice = "出品者が評価をしました。取引は終了しました。";
            Notification::evaluationByClient($channel->user_id, $notice);
            // 売り上げ履歴
            $commission = $item->price*0.1;
            SalesHistory::sales($channel->item_id, $channel->client_id, $item->price, $commission);
            // 売り上げ、ポイント加算
            $inc = UserMetaInfo::where('user_id', $channel->client_id)->first();
            $price = $item->price-$commission;
            if($inc){
                UserMetaInfo::metaInfo($inc, $channel->client_id, $price);
            }else{
                UserMetaInfo::sales($channel->client_id, $price);
            }
        }else{
            return redirect()->back();
        }

        return redirect()->route('mes')->with('message', 'すべての取引が終了しました');
    }
// 高い順、低い順
    public function price($id){
        if($id == 1){
            $items = DB::table('items')
                    ->orderBy('price', 'desc')
                    ->get();
        }elseif($id == 2){
            $items = Item::orderBy('price', 'ASC')->get();
        }

        if(Auth::user()){
            $l = ItemLike::where('user_id', Auth::user()->id)->first();
            $like = Auth::user()->itemLikes;
            if($l){
                return view('top')->with([
                    'items' => $items,
                    'like' => $like,
                ]);
            }else{
                return view('top')->with([
                    'items' => $items,
                    'like' => false,
                ]);
            }
        }else{
            return view('top')->with([
                'items' => $items,
                'like' => false,
            ]);
        }
    }

}