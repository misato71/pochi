@extends('layout')
@section('contents')

<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="/item/list/get">出品中</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/item/sale/list/get">売却済</a>
    </li>
  </ul>
  
<div class="container" style="width: 800px">
    <div class="col-10 offset-1 bg-white">
        <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">出品中の商品</div>
            @foreach ($items as $item)
                @if($item->status == 1)
                    <div class="d-flex mt-3 border position-relative" style="height: 120px">
                        <div>
                            <img src="{{ $item->images }}" class="img-fluid" style="height: 120px;">
                        </div>
                        <div class="flex-fill p-3">
                            <span class="badge badge-success px-2 py-2">出品中</span>
                            <div class="card-title mt-2 font-weight-bold" style="font-size: 18px">{{ $item->title }}</div>
                            <div>
                                <span class="font-weight-bold" style="color:red">¥{{ number_format($item->price) }}</span>
                                <span>{{ $item->updated_at->format('Y年n月j日 H:i') }}</span>
                                <span>商品ID:{{ $item->id }}</span>
                            </div>     
                        </div>
                        <a href="{{ route('item_get', ['id'=>$item->id]) }}" class="stretched-link"></a>
                    </div> 
                @endif   
            @endforeach
        </div>
    </div>
</div>
@endsection