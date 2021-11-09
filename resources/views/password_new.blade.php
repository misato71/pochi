@extends('layout')
@section('contents')
<div class="title m-b-md">パスワード再設定
</div>

<div class="links">
    <div class="card" style="width: 500px">
        <div class="card-body">
            <form action="{{ route('password_new') }}" method="post">
                @csrf
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
            </form>
        </div>
    </div>
</div>
@endsection