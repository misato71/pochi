@extends('layout')
@section('contents')

<div class="title m-b-md">新規会員登録
</div>

<div class="links">
    <div class="card" style="width: 500px">
        <div class="card-body">
            <div style="font-size: 24px">メールアドレス認証</div>

            <form action="{{ route('purchase_email', ['id'=>$id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control mt-2" name="email" placeholder="メールアドレスで登録する" required>
                </div>
                @error('email')
                    <h4 style="color:red">{{ $message }}</h4>
                @enderror
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