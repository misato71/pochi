@extends('layout')
@section('contents')
<div class="title m-b-md">会員情報入力</div>

<div class="forms" style="height: 50vh">
    <div class="card" style="width: 500px">
        <div class="card-body">
            <div style="font-size: 24px">会員情報入力</div>

            <form action="{{ route('register_member') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nickname">ニックネーム</label>
                    <input type="text" class="form-control mt-2" name="nickname" value="{{ old('nickname') }}" placeholder="例)pochi" required>
                        @error('nickname')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" class="form-control mt-2" name="password" placeholder="7文字以上半角英数字" required>
                </div>
                <div class="form-group">
                    <label for="password">パスワード確認</label>
                    <input type="password" class="form-control mt-2" name="password_confirmation" placeholder="パスワードを再入力" required>
                        @error('password')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="last_name first_name">お名前</label>
                    <input type="text" class="form-control mt-2" name="last_name" value="{{ old('last_name') }}" placeholder="例)山田" required>
                        @error('last_name')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                    <input type="text" class="form-control mt-2" name="first_name" value="{{ old('first_name') }}" placeholder="例)花子" required>
                        @error('first_name')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="name_kana">お名前カナ</label>
                    <input type="text" class="form-control mt-2" name="last_name_kana" value="{{ old('last_name_kana') }}" placeholder="例)ヤマダ" required>
                        @error('last_name_kana')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                    <input type="text" class="form-control mt-2" name="first_name_kana" value="{{ old('first_name_kana') }}"placeholder="例)ハナコ" required>
                        @error('first_name_kana')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="birthday">生年月日</label>
                    <input type="date" class="form-control mt-2" name="birthday" value="{{ old('birthday') }}" placeholder="例)20000101" required>
                        @error('birthday')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secondary">
                        登録
                    </button>
                </div>
            </form>
        </div>
    </div> 
</div>
@endsection