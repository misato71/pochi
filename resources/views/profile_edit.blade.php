@extends('layout')
@section('contents')

<div class="forms" style="height: 50vh">
    <div class="card" style="width: 700px">
        <div class="card-body">
            <div class="col-8 offset-2 bg-white">

                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">プロフィールの設定</div>

                <form action="{{ route('profile') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- プロフィール画像 --}}
                    <div class="avatar">
                        <label for="avatar">プロフィール画像の設定</label>
                        <img src="{{ old('avatar', Auth::user()->avatar) }}" class="rounded mx-auto d-block" style="width: 200px; height: 200px;">
                        <input type="file" name="avatar" id="">
                        <p>プロフィール画像に設定したい画像を選択してください</p>
                        @error('avatar')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                    </div>

                    {{-- ニックネーム --}}
                    <div class="form-group">
                        <label for="nickname">ニックネーム(20文字まで)</label>
                        <input type="text" class="form-control" name="nickname" value="{{ old('nickname', Auth::user()->nickname) }}" required>
                        @error('nickname')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                    </div>

                    {{-- プロフィール --}}
                    <div class="form-group">
                        <label for="content">プロフィール(1000文字まで)</label>
                        <textarea style="height: 200px" class="form-control mt-2" name="content" placeholder="ご入力ください">{{ old('content', Auth::user()->content) }}</textarea>
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
    </div>
</div>
@endsection