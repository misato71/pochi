@extends('layout')
@section('contents')

<div class="forms" style="height: 50vh">
    <div class="card" style="width: 500px">
        <div class="card-body">

            <img src="{{ $value->images }}" class="rounded mx-auto d-block" style="width: 200px; height: 200px;">

            <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 35px">{{ $value->title }}</div>

            <div class="font-weight-bold" style="font-size: 30px; color:red">¥{{ number_format($value->price) }}</div>
            
            <div class="form-group mt-3">
                <lavel for="content">商品の説明</lavel>
                    <P>{{ $value->content }}</p>
            </div>
            @if($value->status == 1)
                <div class="form-group mb-0 mt-3">
                    <form action="{{ route('merchandise_edit', ['id'=>$value->id]) }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-block btn-secondary">
                            編集する
                        </button>
                    </form>
                </div>

                <div class="form-group mb-0 mt-3">
                    <form action="{{ route('merchandise_delete_get', ['id'=>$value->id]) }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-block btn-secondary; btn btn-outline-danger">
                            この商品を削除する
                        </button>
                    </form>
                </div>
            @endif

            <div class="form-group mt-3">
                <div class="flex-center">
                <lavel for="">商品の情報
                <ul style="display: flex;list-style:none;">
                    <table border="1">
                    <tr>
                        <th>出品者の情報</th>
                        <td><img src="{{ Auth::user()->avatar }}" class="rounded-circle" style="width: 2rem" alt="..."><br>
                            {{ Auth::user()->nickname }}<br>
                            出品数{{ Auth::user()->items->count() }}<br>
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
                </lavel>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection