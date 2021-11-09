<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 15px;
                top: 18px;
                color: #ffc107;
            }

            .left{
                left: 10px; 
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 30px;
            }

            .subtitle{
                font-size: 20px; 
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                height: 100vh; 
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .th {
                white-space: nowrap;
            } 

        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6f42c1;" >
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Pochi</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/category/list">カテゴリから探す</a>
                        </li>
                    </ul>

                    <form class="d-flex" action="/search">
                        <input class="form-control me-2" type="search" placeholder="何をお探しですか？" aria-label="Search" name="q">
                        <button class="btn btn-outline-warning" type="submit">Search</button>
                    </form>

                    @guest
                    <div class="top-right">
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('login') }}">ログイン</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">新規会員登録</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    @endguest

                    @auth
                    <div class="top-right">
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('notice_list_get') }}">お知らせ</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{ route('mypage') }}">マイページ</a>
                              </li>
                            </ul>
                            <img src="{{ Auth::user()->avatar }}" class="rounded-circle" style="width: 2rem" alt="...">
                        </div>
                    </div>  
                    @endauth
                </div>
            </div>
        </nav>
        
        <div class="flex-center position-ref">
            <div class="content">
                @yield('contents')
            </div> 
            {{-- <div class="menu">
                @yield('menu')
            </div>  --}}
            {{-- <div class="top">
                @yield('top')
            </div> --}}
        </div>
    </body>
</html>
