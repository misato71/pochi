@extends('layout')
@section('contents')

<div class="title m-b-md">退会</div>

<div class="links">
    <div class="card" style="width: 400px;">
        <div class="card-body">
            <form action="{{ route('questionnaire') }}" method="post">
                <div style="font-size: 24px;">退会前アンケート</div>
                    <br>
                    <div class="form-check" style="text-align: left;">
                        <input class="form-check-input" type="radio" name="questionnaire" value="欲しい商品がない">
                        <label class="form-check-label" for="flexRadioDefault1">
                            欲しい商品がない
                        </label>
                    </div>

                    <div class="form-check" style="text-align: left;">
                        <input class="form-check-input" type="radio" name="questionnaire" value="商品が売れない">
                        <label class="form-check-label" for="flexRadioDefault2">
                            商品が売れない
                        </label>
                    </div>

                    <div class="form-check" style="text-align: left;">
                        <input class="form-check-input" type="radio" name="questionnaire" value="使うのが面倒">
                        <label class="form-check-label" for="flexRadioDefault2">
                            使うのが面倒
                        </label>
                    </div>

                    <div class="form-check" style="text-align: left;">
                        <input class="form-check-input" type="radio" name="questionnaire" value="使うことができなくなったから">
                        <label class="form-check-label" for="flexRadioDefault2">
                            使うことができなくなったから
                        </label>
                    </div>

                    <div class="form-check" style="text-align: left;">
                        <input class="form-check-input" type="radio" name="questionnaire" value="その他">
                        <label class="form-check-label" for="flexRadioDefault2">
                            その他
                        </label>
                    </div>
                <br>
                <div class="form-group">
                    <textarea style="height: 150px" class="form-control" name="content" placeholder="退会理由をご入力ください">{{ old('content') }}</textarea>
                </div>
                <br>
                <div>
                    ※退会は即時反映され、一度退会すると復活できません。売上金やポイントは全て消滅します。
                </div>
                <br>
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secondary">
                        上記に同意して退会する
                    </button>
                </div>
                <div>
                    <a href="/mypage">同意しません</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection