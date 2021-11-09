@extends('layout')
@section('contents')

<div class="container" style="width: 800px">
    <div class="col-10 offset-1 bg-white">
        <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">お気に入り</div>
        @foreach ( $items as $key=>$value )
            @foreach ( $value as $item)
                <div class="d-flex mt-3 border position-relative" style="height: 120px">
                    <div>
                        <img src="{{ $item->images }}" class="img-fluid" style="height: 120px;">
                    </div>
                    <div class="flex-fill p-3">
                        <div class="card-title mt-2 font-weight-bold" style="font-size: 18px">{{ $item->title }}</div>
                        <div>
                            <span class="font-weight-bold" style="color:red">¥{{ $item->price }}</span>
                            <span>商品ID:{{ $item->id }}</span>
                        </div>     
                    </div>
                    <a href="{{ route('merchandise_show', ['id'=>$item->id]) }}" class="stretched-link"></a>
                </div>    
            @endforeach
        @endforeach
    </div>
</div>
@endsection