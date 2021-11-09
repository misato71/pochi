@extends('layout')
@section('contents')
<div class="subtitle m-b-md">こちらの発送元・お届け先住所を削除してよろしいですか？</div>

<div class="forms" style="height: 50vh">
    <div class="card" style="width: 600px">
        <div class="card-body">
            <form action="{{ route('delete_address', ['id'=>$value->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    お名前<br>
                    {{ $value->last_name }}
                    {{ $value->first_name }} 
                </div>

                <div class="form-group">
                    お名前カナ<br>
                    {{ $value->last_name_kana }}
                    {{ $value->first_name_kana }}  
                </div>

                <div class="form-group">
                    郵便番号<br>
                    {{ $value->postal_code }}
                </div>
                
                <div class="form-group">
                    都道府県<br>
                    {{ $value->area }}
                </div>

                <div class="form-group">
                    市区町村<br>
                    {{ $value->municipalities }}
                </div>

                <div class="form-group">
                    町名番地<br>
                    {{ $value->address }}
                </div>

                <div class="form-group">
                    建物名<br>
                    {{ $value->building_name }}
                </div>

                <div class="form-group">
                    電話番号<br>
                    {{ $value->telephone_number }}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secondary">
                        削除
                    </button>
                </div>
            </form>
        </div>
    </div> 
</div>
@endsection