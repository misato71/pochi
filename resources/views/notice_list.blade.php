@extends('layout')
@section('contents')

<div class="container" style="width: 900px">
    <div class="col-10 offset-1 bg-white">
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
@endsection