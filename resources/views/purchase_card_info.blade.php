@extends('layout')
@section('contents')

<div class="title m-b-md border-bottom pb-3">支払い方法</div>

<div class="forms">
    <div class="card" style="width: 400px;">
        <div class="card-body">
            <form action="{{ route('purchase_card_register', ['id'=>$id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="card_number">カード番号</label>
                    <input type="card_number" class="form-control mt-2" name="card_number" required>
                    @error('card_number')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">有効期限
                        <br>
                        <label for="year_month">年/月</label>
                        <input type="month" class="form-control mt-2" name="year_month" required>
                　　</label>
                    @error('year_month')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">セキュリティコード</label>
                    <input type="security_code" class="form-control mt-2" name="security_code" required>
                    @error('security_code')
                        <h4 style="color:red">{{ $message }}</h4>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secondary">
                        登録する
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection