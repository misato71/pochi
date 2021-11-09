@extends('layout')
@section('contents')

<div class="title m-b-md">パスワードの再設定
</div>

<div class="links">
    <div class="card" style="width: 500px">
        <div class="card-body">
            <div style="font-size: 18px">下記のメールアドレス宛にパスワードの再設定メールを送信します。</div>

            <form action="{{ route('token_new') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control mt-2" name="email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <h4 style="color:red">{{ $message }}</h4>
                @enderror
                @if(session('message'))
                    <h4 style="color:red">{{ session()->get('message') }}</h4>
                @endif
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