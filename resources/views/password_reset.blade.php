@extends('layout')
@section('contents')
<div class="title m-b-md">設定
</div>

<div class="links">
    <div class="card" style="width: 500px">
        <div class="card-body">
            <div style="font-size: 24px">パスワード変更</div>
            <form action="{{ route('password_reset') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="password">ご本人確認の為、現在のパスワードを入力してください</label>
                    <input type="password" class="form-control mt-2" name="password" required>
                    @error('password')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                    @if(session('message'))
                        <h4 style="color:red">{{ session()->get('message') }}</h4>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="new_password">新しいパスワード</label>
                    <input type="password" class="form-control mt-2" name="new_password" placeholder="7文字以上半角英数字" required>
                    <label for="new_password">新しいパスワード（確認）</label>
                    <input type="password" class="form-control mt-2" name="new_password_confirmation" placeholder="新しいパスワードを再入力" required>
                    @error('new_password')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secondary">
                        送信
                    </button>
                </div>
                <div>
                パスワードを忘れた方は<a href="{{ route('email_verify') }}">こちら</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection