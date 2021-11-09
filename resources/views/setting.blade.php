@extends('layout')
@section('contents')
<div class="list-group" style="width: 600px">
  <a href="\setting" class="list-group-item list-group-item-action list-group-item-secondary">設定</a>
  <a href="\profile\edit" class="list-group-item list-group-item-action">プロフィールの設定</a>
  <a href="\password\verify" class="list-group-item list-group-item-action">本人情報</a>
  <a href="\address" class="list-group-item list-group-item-action">発送元・お届け先住所変更</a>
  <a href="{{ route('password') }}" class="list-group-item list-group-item-action">パスワード変更</a>
  <a href="\cansel" class="list-group-item list-group-item-action">退会</a>
</div>
@endsection