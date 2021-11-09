@extends('layout')
@section('contents')

<div class="title m-b-md">購入内容の確認</div>
<div class="forms" style=" width: 700px">
  <form action="{{ route('purchase_get', ['id'=>$id]) }}" method="post">
  @csrf

 {{-- 商品 --}}
    <div class="form-group mt-3 border-bottom pb-3">
      <img src="{{ $value->images }}" class="rounded mx-auto d-block" style="width: 100px; height: 100px;">
      <div class="font-weight-bold text-center" style="font-size: 18px">{{ $value->title }}</div>
      <div class="font-weight-bold pt-3" style="font-size: 30px; color:red">¥{{ $value->price }}</div>
    </div>

  {{-- 支払い方法 --}}
    <div class="form-group mt-3 border-bottom pb-3">
      <div style="font-size: 24px;">支払方法</div>
      <br>
      <div class="form-check" style="text-align: left;">
        @if (Auth::user()->pays)
          @foreach(Auth::user()->pays as $key => $card)
            <input class="form-check-input" type="radio" name="pay" value={{ $card }} required>
            <label class="form-check-label" for="flexRadioDefault1">
              pochiカード<br>
              {{ $card->card_number }}/
              {{ $card->year_month }}
            </label>
            <br>
          @endforeach
        @endif
        <br>
          <input class="form-check-input" type="radio" name="pay" required>
          <label class="form-check-label" for="flexRadioDefault1">
              コンビニ/ATM払い
          </label>
      </div>
    
    <a href="{{ route('purchase_card', ['id'=>$id]) }}">クレジットカードを追加</a>
    </div>
  
  {{-- 配送先 --}}
    <div class="form-group mt-3 border-bottom pb-3">
      <div style="font-size: 24px;">配送先</div>
      <br>
      @if (Auth::user()->addresses)
        <div class="form-check" style="text-align: left;">
          @foreach(Auth::user()->addresses as $key => $value)
            <input class="form-check-input" type="radio" name="address" value="{{ $value }}" required>
            <label class="form-check-label" for="flexRadioDefault1">
              {{ $value->last_name }} {{ $value->first_name }}<br>
              〒{{ $value->postal_code }}<br>
              {{ $value->area }} {{ $value->municipalities }} {{ $value->address }} {{ $value->building_name }} <br>
              {{ $value->telephone_number }}
            </label>
            <br>
          @endforeach
        </div>
      @endif
      <div>
        <a href="{{ route('address_get', ['id'=>$id]) }}">発送元・お届け先を追加</a>
      </div>
      ※配送先に変更がないかご確認ください
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-block btn-secondary">
          購入する
      </button>
    </div>
  </form>
</div>
@endsection