@extends('layout')
@section('contents')

<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="/item/list/get">出品中</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="/item/sale/list/get">売却済み</a>
    </li>
  </ul>
  
<div class="container" style="width: 800px">
    <div class="col-10 offset-1 bg-white">
        <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">売却した商品</div>
            @foreach ($items as $item)
                @if($item->status > 1)
                    <div class="d-flex mt-3 border position-relative" style="height: 120px">
                        <div>
                            <img src="{{ $item->images }}" class="img-fluid" style="height: 120px;">
                        </div>
                        <div class="flex-fill p-3">
                            @if($item->status == 2)
                                <span class="badge badge-primary px-2 py-2">発送待ち</span>
                            @elseif($item->status == 3)
                                <span class="badge badge-success px-2 py-2">配送中</span>
                            @elseif($item->status == 4)
                                <span class="badge badge-secondary px-2 py-2">評価待ち</span>
                            @else
                                <span class="badge badge-danger px-2 py-2">売却済み</span>
                            @endif
                            <div class="card-title mt-2 font-weight-bold" style="font-size: 18px">{{ $item->title }}</div>
                            <div>
                                <span class="font-weight-bold" style="color:red">¥{{ number_format($item->price) }}</span>
                                <span>{{ $item->updated_at->format('Y年n月j日 H:i') }}</span>
                                <span>商品ID:{{ $item->id }}</span>
                            </div>     
                        </div>
                        <a href="{{ route('channel', ['id'=>$item->id]) }}" class="stretched-link"></a>
                    </div>
                @endif    
            @endforeach
        </div>
    </div>
</div>
@endsection