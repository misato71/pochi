@extends('layout')
@section('contents')

<div class="container" style="width: 1000px">
    <div class="col-10 offset-1 bg-white">
        <div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">売り上げ履歴</div>
        <div class="text-center pb-3 pt-3" style="font-size: 22px">売上金 ¥{{ $metaInfo->total_sales }}</div>
        <div class="text-center border-bottom" style="font-size: 18px">ポイント ¥{{ $metaInfo->point }}</div>
        @if($users)
            @foreach ( $users as $user)
                @foreach ($infos as $info)
                    @if($user->item_id == $info->id)
                    <div class="d-flex mt-3 border position-relative" style="height: 100px">
                        <div>
                            <img src="{{ $info->images }}" class="img-fluid" style="height: 100px;">
                        </div>
                        <div class="flex-fill p-3">
                            {{ $info->title }}
                            <div>
                                <span>{{ $user->created_at->format('Y年n月j日 H:i') }}</span>
                                <span class="font-weight-bold">販売利益</span>
                                <span class="font-weight-bold" style="color:red">¥{{ number_format($user->sales-$user->commission) }}</span>
                                <span class="">販売価格¥{{ number_format($info->price) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('item_get', ['id'=>$user->item_id]) }}" class="stretched-link"></a>
                    </div>
                    @endif    
                @endforeach
            @endforeach
        @endif
    </div>
</div>
@endsection