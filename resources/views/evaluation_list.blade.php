@extends('layout')
@section('contents')

<div class="form-group mt-3">
    @foreach ($comments as $value)
        <div class="wrapper row">
            <label for="">
                購入者<br>
                <img src="{{ $value->user->avatar }}" class="rounded-circle" style="width: 2rem" alt="...">
                {{ $value->user->nickname }}
            </label>    
        </div>    
        {{-- 評価履歴 --}}
        <div class="shadow p-3 mb-5 bg-white rounded">
            {{ $value->content }}<br>
            {{ $value->created_at }}
        </div>
    @endforeach
</div>


@endsection