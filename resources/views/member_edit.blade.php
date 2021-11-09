@extends('layout')
@section('contents')
<div class="title m-b-md">本人情報</div>

<div class="forms" style="height: 50vh">
    <div class="card" style="width: 500px">
        <div class="card-body">
            <div style="font-size: 24px">編集</div>

            <form action="{{ route('member_update') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="last_name first_name">お名前</label>
                    <input type="text" class="form-control mt-2" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="例)山田" required>
                        @error('last_name')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                    <input type="text" class="form-control mt-2" name="first_name" value="{{ Auth::user()->first_name }}" placeholder="例)花子" required>
                        @error('first_name')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="name_kana">お名前カナ</label>
                    <input type="text" class="form-control mt-2" name="last_name_kana" value="{{ Auth::user()->last_name_kana }}" placeholder="例)ヤマダ" required>
                        @error('last_name_kana')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                    <input type="text" class="form-control mt-2" name="first_name_kana" value="{{ Auth::user()->first_name_kana }}"placeholder="例)ハナコ" required>
                        @error('first_name_kana')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="birthday">生年月日</label>
                    <input type="date" class="form-control mt-2" name="birthday" value="{{ Auth::user()->birthday }}" placeholder="例)20000101" required>
                        @error('birthday')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secondary">
                        保存
                    </button>
                </div>
            </form>
        </div>
    </div> 
</div>
@endsection