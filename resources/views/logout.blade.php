@extends('layout')
@section('contents')


<div class="links">
    <div class="card" style="width: 500px">
        <div class="card-body">

            <form action="{{ route('logout_sent') }}" method="get">
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secondary">
                        ログアウト
                    </button>
                </div>

                <div>
                    マイページに<a href="/mypage">戻る</a>
                </div>    
            </form>
        </div>
    </div>
</div>
@endsection