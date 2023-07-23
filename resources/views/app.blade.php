<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="d-flex justify-content-between flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom box-shadow">
    <div class="d-flex">
    <h5 class="my-0 mr-md-auto font-weight-normal">Marketplace</h5>

        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{route('index')}}">Главная</a>
        </nav>
    </div>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="btn btn-outline-primary">Выйти</button>
    </form>
</div>
<style>
    @media screen and (min-width: 768px) {
        .container_my {
            margin-left: 20px;
            margin-right: 20px;
        }
    }
    .strelka-left-3,
    .strelka-right-3,
    .strelka-top-3,
    .strelka-bottom-3 {
        width: 12px;
        height: 12px;
        cursor: pointer;
    }
    .strelka-left-3 path,
    .strelka-right-3 path,
    .strelka-top-3 path,
    .strelka-bottom-3 path {
        fill: #c0bebe;
        transition: fill 0.5s ease-out;
    }
    .strelka-left-3 {
        transform: rotate(180deg);
    }
    .strelka-top-3 {
        transform: rotate(90deg);
    }
    .strelka-bottom-3 {
        transform: rotate(270deg);
    }
    .strelka-hovered path,
    .strelka-left-3:hover path,
    .strelka-right-3:hover path,
    .strelka-top-3:hover path,
    .strelka-bottom-3:hover path {
        fill: #000;
    }
</style>
@yield('content')

@include('modals')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
