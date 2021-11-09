@extends('layout')
@section('contents')

<div class="wrapper row">
    {{-- マイページメニュー --}}
    <div class="row col-3 mt-3">
        <div class="container" style="width: 300px">
            <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">マイページメニュー</div>
            <br>
            <div class="list-group" style="width: 250px">
                <a href="{{ route('like_list_get') }}" class="list-group-item list-group-item-action">お気に入り</a>
                <a href="{{ route('to_do_list_get') }}" class="list-group-item list-group-item-action">やることリスト</a>
            </div>

            <div class="list-group" style="width: 250px">
            <label>出品</label>
                <a href="\item" class="list-group-item list-group-item-action">商品を出品する</a>
                <a href="\item\list\get" class="list-group-item list-group-item-action">出品した商品</a>
            </div>

            <div class="list-group" style="width: 250px">
            <label>購入</label>
                <a href="{{ route('purchase_history_list_get') }}" class="list-group-item list-group-item-action">購入した出品</a>
            </div>

            <div class="list-group" style="width: 250px">
            <label>設定・ヘルプ・その他</label>
                <a href="\setting" class="list-group-item list-group-item-action">設定</a>
                <a href="{{ route('meta_info_list_get') }}" class="list-group-item list-group-item-action">売上確認</a>
                <a href="\logout" class="list-group-item list-group-item-action">ログアウト</a>
            </div>
        </div>
    </div>

    <div class="row col-9 mt-3" style="left: 30px;">
        {{-- プロフィール --}}
        <div class="container" style="width: 900px">
            <img src="{{ Auth::user()->avatar }}" class="rounded-circle" style="width: 6rem" alt="...">
            <div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">{{ Auth::user()->nickname }}</div>
            出品数{{ Auth::user()->items->count() }}<br>
            😄{{ $good }}　😢{{ $bad }}
            <a href="/evaluation/list/get" class="stretched-link"></a>
        </div>
        {{-- お知らせ --}}
        <div class="container" style="width: 900px">
            <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">お知らせ</div>
                @foreach ($notices as $notice)
                    <div class="d-flex mt-3 border position-relative">
                        <div class="flex-fill p-3">
                            <p>{{ $notice->notice }}</p>
                            <p>{{ $notice->created_at }}</p>
                        </div>
                        <a href="" class="stretched-link"></a>
                    </div>    
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection