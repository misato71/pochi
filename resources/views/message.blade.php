@extends('layout')
@section('contents')
<div class="title m-b-md">
    @if(session('message'))
    {{ session()->get('message') }}
    @endif
</div>

@endsection