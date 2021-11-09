@extends('layout')
@section('contents')

<div class="title m-b-md">本当に削除してよろしいですか？</div>

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

            <div class="form-group mb-0 mt-3" style="color:red">
                <form action="{{ route('item_delete', ['id'=> $value->id]) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-block btn-secondary; btn btn-outline-danger">
                    商品を削除する
                </button>
                </form>
                ※削除すると二度と復活できません
            </div>

            <div class="form-group mt-3">
                <div class="flex-center">
                <lavel for="">商品の情報
                <ul style="display: flex;list-style:none;">
                    <table border="1">
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