@extends('layout')
@section('contents')

{{-- 商品情報 --}}
<div class="container" style="width: 600px">
    <div class="d-flex mt-3 border position-relative" style="height: 120px">
        <div>
            <img src="{{ $value->images }}" class="img-fluid" style="height: 120px;">
        </div>
        <div class="flex-fill p-3">
            <div class="card-title mt-2 font-weight-bold" style="font-size: 18px">{{ $value->title }}</div>
            <div>
                <span class="font-weight-bold" style="color:red">¥{{ number_format($value->price) }}</span>
                <span>{{ $value->updated_at->format('Y年n月j日 H:i') }}</span>
                <span>商品ID:{{ $value->id }}</span>
            </div>     
        </div>
        <a href="{{ route('merchandise_show', ['id'=>$value->id]) }}" class="stretched-link"></a>
    </div>    
</div>
{{-- ステータス --}}
<div class="container" style="width: 600px">
    <div class="pt-3" style="font-size: 18px">①発送待ち→②配送中→③受取評価→取引終了</div>
    <div class="font-weight-bold text-center border-bottom pb-3" style="font-size: 22px">
        @if($channel->status == 2)
            <br>出品者の発送をお待ちください
        @elseif($channel->status == 3)
            <br>発送されました<br>
            届きましたら、受取評価をしてください
            <div class="container" style="width: 500px">
                <form action="{{ route('evaluation', ['id'=>$channel->id]) }}" method="post">
                    @csrf
                    <div class="form-check" style="text-align: left; font-size: 18px;">
                        <input class="form-check-input" type="radio" name="evaluation" value="良い" required>
                        <label class="form-check-label" for="flexRadioDefault1">
                            良い出品者です
                        </label>
                    </div>
                    <div class="form-check" style="text-align: left; font-size: 18px;">
                        <input class="form-check-input" type="radio" name="evaluation" value="悪い" required>
                        <label class="form-check-label" for="flexRadioDefault2">
                            悪い出品者です
                        </label>
                    </div>
                    <div class="form-group mt-3">
                        <textarea style="height: 100px" class="form-control" name="content" placeholder="この度はお取引ありがとうございました">{{ old('content') }}</textarea>
                        @error('content')

                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                    </div>
                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-block btn-danger">
                            評価をして取引を終了する
                        </button>
                    </div>
                </form>
            </div>
        @elseif($channel->status == 4)
            <br>出品者からの評価をお待ちください
        @elseif($channel->status == 5)
            <br>すべての取引が終了しました
        @endif
    </div>
    {{-- チャット --}}
    <div class="form-group mt-3">
        @foreach ($messages as $key=>$value)
            <div class="wrapper row">
                {{-- 購入者 --}}
                @if($value->owner_id == Auth::user()->id)
                    <label for="">
                        <img src="{{ Auth::user()->avatar }}" class="rounded-circle" style="width: 2rem" alt="...">
                        {{ Auth::user()->nickname }}
                    </label>
                {{-- 出品者 --}}
                @elseif($value->owner_id == $client->id)
                    <label for="">
                        <img src="{{ $client->avatar }}" class="rounded-circle" style="width: 2rem" alt="...">
                        {{ $client->nickname }}
                    </label>
                @endif
                {{-- チャット履歴 --}}
                <div class="shadow p-3 mb-5 bg-white rounded">{{ $value->content }}</div>
            </div>
        @endforeach
    </div>
    {{-- メッセージ送信 --}}
    <form action="{{ route('message', ['id'=>$channel->id]) }}" method="post">
        @csrf
        <div class="form-group mt-3">
            <textarea style="height: 100px" class="form-control" name="content" placeholder="安心してお取引をする為にメッセージのやりとりをしましょう" required>{{ old('content') }}</textarea>
            @error('content')
                <h4 style="color:red">{{ $message }}</h4>
            @enderror
        </div>
    
        <div class="form-group mb-0 mt-3">
            <button type="submit" class="btn btn-block btn-secondary">
                取引メッセージを送る
            </button>
        </div>
    </form>
    
</div>
@endsection