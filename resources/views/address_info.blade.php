@extends('layout')
@section('contents')
<div class="title m-b-md">設定</div>

<div class="forms" style="height: 50vh">
    <div class="card" style="width: 600px">
        <div class="card-body">
            <div style="font-size: 24px">発送元・お届け先住所変更</div>
            
            <form action="{{ route('address') }}" method="post">
                @csrf
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
-                <div class="form-group">
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
                    <label for="postal_code">郵便番号</label>
                    <input type="text" class="form-control mt-2" name="postal_code" value="{{ old('postal_code') }}" placeholder="例)1234567" required>
                        @error('postal_code')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="area">都道府県</label>
                    <select name="area" class="form-control mt-2" value="{{ old('area') }}" required>
                        <option value="">選択してください</option>
                        @foreach(config('region') as $region)
                        <option value="{{ $region }}" @if(old('area') == $region) selected @endif>{{ $region }}</option>
                        @endforeach
                    </select>
                        @error('area')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="municipalities">市区町村</label>
                    <input type="text" class="form-control mt-2" name="municipalities"　value="{{ old('municipalities') }}" placeholder="例)○○市" required>
                        @error('municipalities')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="address">町名番地</label>
                    <input type="text" class="form-control mt-2" name="address"　value="{{ old('address') }}" placeholder="例)○○1-1-1" required>
                        @error('address')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="building_name">建物名</label>
                    <input type="text" class="form-control mt-2" name="building_name"　value="{{ old('building_name') }}" placeholder="例)○○ビル102">
                        @error('building_name')
                            <h4 style="color:red">{{ $message }}</h4>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="telephone_number">電話番号</label>
                    <input type="text" class="form-control mt-2" name="telephone_number"　value="{{ old('telephone_number') }}" placeholder="例)00011112222" required>
                        @error('telephone_number')
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