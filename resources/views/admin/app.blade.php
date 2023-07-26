<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/css/virtual-select.min.css')}}">
    <script src="{{asset('/js/virtual-select.min.js')}}"></script>
</head>
<body>
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

<div class="d-flex" style="min-height: 100vh">

    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Маркетплэйс</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{route('admin.index')}}" class="nav-link text-white {{request()->route()->uri == 'admin' ? 'active' : ''}}" aria-current="page">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                    Админ панель
                </a>
            </li>
            <li>
                <a href="{{route('admin.products.index')}}" class="nav-link text-white {{request()->route()->uri == 'admin/products' ? 'active' : ''}}">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                    Товары
                </a>
            </li>
            <li>
                <a href="{{route('admin.incomes.index')}}" class="nav-link text-white {{request()->route()->uri == 'admin/incomes' ? 'active' : ''}}">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                    Поставки
                </a>
            </li>
            <li>
                <a href="{{route('admin.users.index')}}" class="nav-link text-white {{request()->route()->uri == 'admin/users' ? 'active' : ''}}">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                    Пользователи
                </a>
            </li>
            <li>
                <a href="{{route('admin.warehouses.index')}}" class="nav-link text-white {{request()->route()->uri == 'admin/warehouses' ? 'active' : ''}}">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                    Склады
                </a>
            </li>
            <li>
                <a href="{{route('admin.left-overs.index')}}" class="nav-link text-white {{request()->route()->uri == 'admin/leftovers' ? 'active' : ''}}">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                    Остатки
                </a>
            </li>
            <li>
                <a href="{{route('admin.tokens.index')}}" class="nav-link text-white {{request()->route()->uri == 'admin/tokens' ? 'active' : ''}}">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                    Токены
                </a>
            </li>
        </ul>
        <hr>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button class="btn btn-outline-primary">Выйти</button>
        </form>
    </div>
    <div style="width: 100%;">
        @yield('content')
    </div>
</div>
@include('modals')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
