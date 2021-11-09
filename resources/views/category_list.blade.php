@extends('layout')
@section('contents')

<div class="title m-b-md">カテゴリ一覧</div>
<div class="subtitle m-b-md" style=color:red>
    @if(session('message'))
    {{ session()->get('message') }}
    @endif
</div>

<div class="links" style="height: 50vh">
    <div class="list-group" style="width: 500px">
        @foreach ( config('category') as $category)
            <a href="{{ route('category', ['category'=>$category]) }}" class="list-group-item list-group-item-action">{{ $category }}</a>
            <br>
        @endforeach
    </div>
</div>
@endsection