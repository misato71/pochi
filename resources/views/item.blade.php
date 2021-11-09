@extends('layout')
@section('contents')
<div class="title m-b-md">出品</div>

<div class="forms" style="height: 50vh">
    <div class="card" style="width: 700px">
        <div class="card-body">
            <div style="font-size: 24px">商品を出品する</div>
                <form action="{{ route('merchandise') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- 商品画像 --}}
                <div class="images">
                    <label for="images">
                        商品画像
                    </label>
                    <img src="{{ old('images') }}" class="rounded mx-auto d-block" style="width: 200px; height: 200px;">
                    <input type="file" name="images" id="">
                    @error('images')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                {{-- 商品名 --}}
                <div class="form-group mt-3">
                    <label for="title">商品名</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="20文字まで"　required>
                    @error('title')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                {{-- 商品の説明 --}}
                <div class="form-group mt-3">
                    <label for="content">商品の説明</label>
                    <textarea style="height: 200px" class="form-control" name="content" placeholder="色・素材・重さ・定価・注意点などを記載しましょう（1000文字まで）">{{ old('content') }}</textarea>
                    @error('content')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                {{-- カテゴリ --}}
                <div class="form-group mt-3">
                    <label for="category">カテゴリ</label>
                    <select name="category" class="custom-select form-control" value="{{ old('category') }}" required>
                        <option value="">選択してください</option>
                        @foreach(config('category') as $category)
                            <option value="{{ $category }}" @if (old('category') == $category) selected @endif>{{ $category }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                {{-- 商品の状態 --}}
                <div class="form-group mt-3">
                    <label for="condition_item">商品の状態</label>
                    <select name="condition_item" class="custom-select form-control" value="{{ old('condition_item') }}" required>
                        @foreach(config('condition') as $condition)
                            <option value="{{ $condition }}" @if (old('condition_item') == $condition) selected @endif>{{ $condition }}</option>
                        @endforeach
                    </select>
                    @error('condition_item')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                {{-- 発送料の負担 --}}
                <div class="form-group mt-3">
                    <label for="delivery">配送料の負担</label>
                    <select name="delivery" class="custom-select form-control" value="{{ old('delivery') }}" required>
                        @foreach ( config('delivery') as $delivery )
                            <option value="{{ $delivery }}" @if (old('delivery') == $delivery) selected @endif>{{ $delivery }}</option>
                        @endforeach
                    </select>
                    @error('delivery')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                {{-- 配送の方法 --}}
                <div class="form-group mt-3">
                    <label for="delivery_method">発送の方法</label>
                    <select name="delivery_method" class="custom-select form-control" value="{{ old('delivery_method') }}" required>
                        @foreach (config('delivery_method') as $delivery_method)
                            <option value="{{ $delivery_method }}" @if (old('delivery_method') == $delivery_method) selected @endif>{{  $delivery_method }}</option>
                        @endforeach
                    </select>
                    @error('delivery_method')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>
                
                {{-- 発送元の地域 --}}
                <div class="form-group mt-3">
                    <label for="area">発送元の地域</label>
                    <select name="area" class="custom-select form-control" value="{{ old('area') }}" required>
                        <option value="">選択してください</option>
                        @foreach(config('region') as $region)
                            <option value="{{ $region }}" @if (old('area') == $region) selected @endif>{{ $region }}</option>
                        @endforeach
                    </select>
                    @error('area')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                {{-- 発送までの日数 --}}
                <div class="form-group mt-3">
                    <label for="days_to_ship">発送までの日数</label>
                    <select name="days_to_ship" class="custom-select form-control" value="{{ old('days_to_ship') }}" required>
                        @foreach (config('days_to_ship') as $days_to_ship)
                            <option value="{{ $days_to_ship }}" @if (old('days_to_ship') == $days_to_ship) selected @endif>{{ $days_to_ship }}</option>
                        @endforeach
                    </select>
                    @error('days_to_ship')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                {{-- 販売価格 --}}
                <div class="form-group mt-3">
                    <label for="price">販売価格</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>

                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-block btn-secondary">
                        出品する
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection