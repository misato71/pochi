@extends('layout')
@section('contents')

{{-- 値段、高い順、低い順 --}}
<ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="{{ route('price', ['id'=>1]) }}">高い順</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('price', ['id'=>2]) }}">低い順</a>
    </li>
</ul>

<div class="wrapper row" style="width: 1300px">
    {{-- 商品 --}}
    @foreach ($items as $item)
        <div class="card col-2 mt-3 border-light">
            <div class="position-relative overflow-hidden">
                <img class="card-img-top" src="{{ $item->images }}" alt="...">
                <div class="position-absolute py-2 px-3" style="left: 0; bottom: 20px; color: white; background-color: rgba(0, 0, 0, 0.7)">
                    <span class="ml-1">¥{{ number_format($item->price) }}</span>
                </div>
                @if ($item->status > 1)
                    <div class="position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="left: 0; top: 0; color: white; background-color: #EA352C; transform: translate(-50%,-50%) rotate(-45deg); width: 125px; height: 125px; font-size: 20px;">
                        <span>SOLD</span>
                    </div>
                @endif
                <a href="{{ route('merchandise_show', ['id'=>$item->id]) }}" class="stretched-link"></a>
            </div>

            <div class="card-body">
                <p class="card-title">{{$item->title}}</p>
                @if($like)
                    @foreach ($like as $key=>$value)
                        @if($value->item_id == $item->id)
                            <div class="position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="right: 0; bottom: 0; font-size: 25px;">
                                <a href="{{ route('like', ['id'=>$item->id]) }}">♥</a>
                            </div>
                        @else
                            <div class="position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="right: 0; bottom: 0; font-size: 25px;">
                                <a href="{{ route('like', ['id'=>$item->id]) }}">♡</a>
                            </div>
                        @endif
                    @endforeach
                @else
                <div class="position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="right: 0; bottom: 0; font-size: 25px;">
                    <a href="{{ route('like', ['id'=>$item->id]) }}">♡</a>
                </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection