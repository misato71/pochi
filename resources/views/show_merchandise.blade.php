@extends('layout')
@section('contents')

<div class="forms" style="height: 50vh">
    <div class="card" style="width: 500px">
        <div class="card-body">
            <form action="{{ route('checklogin', ['id'=>$value->id]) }}" method="get">
                <div class="position-relative overflow-hidden">
                    <img src="{{ $value->images }}" class="rounded d-block" style="width: 500px; height: 500px;">
                    @if ($value->status > 1)
                        <div class="position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="left: 0; top: 0; color: white; background-color: #EA352C; transform: translate(-50%,-50%) rotate(-45deg); width: 200px; height: 200px; font-size: 30px;">
                            <span>SOLD</span>
                        </div>
                    @endif
                </div>
                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 35px">{{ $value->title }}</div>

                <div class="font-weight-bold" style="font-size: 30px; color:red">¥{{ number_format($value->price) }}</div>

                @if($value->status > 1)
                <div class="form-group mb-0 mt-3">
                    <button type="submit" disabled="true" class="btn btn-dark btn-block">
                        売り切れました
                    </button>
                </div>
                @elseif($value->status == 1)
                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-block btn-secondary; btn btn-danger">
                        購入する
                    </button>
                </div>
                @endif
            </form>

            <br>
            @if($like)
            <a href="{{ route('like', ['id'=>$value->id]) }}">♥お気に入りを解除する</a>
            @else
            <a href="{{ route('like', ['id'=>$value->id]) }}">♡お気に入り</a>
            @endif

            <div class="form-group mt-3">
                <lavel for="content" style="font-size: 23px">商品の説明</lavel>
                    <P>{{ $value->content }}</p>
            </div>

            <div class="form-group mt-3">
                <div class="flex-center">
                <lavel for="" style="font-size: 23px">商品の情報</lavel>
                <ul style="display: flex;list-style:none;">
                    <table border="1">
                    <tr>
                        <th>出品者の情報</th>
                        <td><img src="{{ $user->avatar }}" class="rounded-circle" style="width: 2rem" alt="..."><br>
                            {{ $user->nickname }}<br>
                            出品数{{ $count }}<br>
                            😄{{ $good }}　😢{{ $bad }}
                        </td>
                    </tr>
                    <tr>
                        <th>カテゴリ</th>
                        <td>{{ $value->category }}</td>
                    </tr>
                    <tr>
                        <th>商品の状態</th>
                        <td>{{ $value->condition_item }}</td>
                    </tr>
                    <tr>
                        <th>配送料の負担</th>
                        <td>{{ $value->delivery }}</td>
                    </tr>
                    <tr>
                        <th>発送の方法</th>
                        <td>{{ $value->delivery_method }}</td>
                    </tr>
                    <tr>
                        <th>発送元の地域</th>
                        <td>{{ $value->area }}</td>
                    </tr>
                    <tr>
                        <th>発送までの日数</th>
                        <td>{{ $value->days_to_ship }}</td>
                    </tr>
                    </table>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection