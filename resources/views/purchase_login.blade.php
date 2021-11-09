@extends('layout')
@section('contents')
            
<div class="title m-b-md">ログイン
</div>

<div class="links">
    <div class="card" style="width: 500px">
        <div class="card-body">

        <form action="{{ route('purchase_login_get', ['id'=>$id]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" class="form-control mt-2" name="email" required>
                @error('email')
                    <h4 style="color:red">{{ $message }}</h4>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control mt-2" name="password" required>
                @error('password')
                    <h4 style="color:red">{{ $message }}</h4>
                @enderror
                @if(session('message'))
                    <h4 style="color:red">{{ session()->get('message') }}</h4>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-secondary">
                    ログイン
                </button>
            </div>
            <div>
                アカウントをお持ちでない方は<a href="{{ route('purchase_register_get', ['id'=>$id]) }}">こちら</a>
            </div>
            <div>
                パスワードを忘れた方は<a href="{{ route('email_verify') }}">こちら</a>
            </div>
        </form>
   
    </div>
</div>
@endsection