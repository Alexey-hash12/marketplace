@extends('logist.app')

@section('content')
    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Расчеты поставок</h3>
            <p>Скрипт рассчитает необходимое кол-во единиц товара для заказа и запланирует пополнение остатков с учетом установленных сроков</p>
            <div class="d-flex" style="font-size: 14px; column-gap: 8px;">
                <div>
                    <a style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success btn-lg" href="#" role="button">Расчитать поставки »</a></p>
                </div>
            </div>
        </div>
    </div>

    @if($session)
        <div class="container_my mt-2">
            <div class="alert alert-success" role="alert">
                {{$session}}
            </div>
        </div>
    @endif

    <div class="container_my mt-5 mb-5">
        <div class="bd-example">
            <ul class="nav nav-tabs" style="border: none;">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('logist.index')}}">Все</a>
                </li>
                @foreach($wareHouses as $wareHouse)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('logist.index')}}">{{$wareHouse->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card" style="border-top-left-radius: 0; border-top-right-radius: 0;">
            <form id="myForm" action="">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <input type="hidden" value="" id="sort_type_input" name="sort_type">
                <input type="hidden" value="" id="sort_value_input" name="sort_value">
                <div class="card-body table-responsive">
                    <table class="table table-hover" style="font-size: 12px;">
                        <thead>
                        <tr>
                            @foreach($data as $key => $item)
                                <th scope="col">
                                    {{$item}}
                                    @if ($key !== 'image')

                                        <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                            <!-- Стрелка вверх -->
                                            <svg data-name="{{$key}}" data-value="desc"
                                                 class="form-sort strelka-top-3 {{request()->sort_type == $key && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}"
                                                 viewBox="0 0 5 9">
                                                <path
                                                    d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z"></path>
                                            </svg>

                                            <!-- Стрелка вниз -->
                                            <svg data-name="{{$key}}" data-value="asc"
                                                 class="form-sort strelka-bottom-3 {{request()->sort_type == $key && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}"
                                                 viewBox="0 0 5 9">
                                                <path
                                                    d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </th>
                            @endforeach
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($supplyCalculations as $key => $income)
                            <tr>
                                <td>{{$income->id}}</td>
                                <td>{{$income->user_name}}</td>
                                <td>{{$income->product_sku}}</td>
                                <td>{{$income->speed}}</td>
                                <td>{{$income->leftovers}}</td>
                                <td>{{$income->count_products}}</td>
                                <td>{{$income->count_days}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$supplyCalculations->withQueryString()->links()}}
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('myForm');

        $('.form-sort').click(function () {
            $('#sort_type_input').val($(this).data('name'));
            $("#sort_value_input").val($(this).data('value'));
            form.submit();
        });

        function openNew(id)
        {
            window.location.href = `/${id}`;
        }
    </script>
    <script>
        $('.image-hover').on('mouseover', function () {
            const imageHover = $(this).data('id');
            $(`#image-hover-${imageHover}`).fadeIn();
        });
        $('.image-hover').on('mouseleave', function () {
            const imageHover = $(this).data('id');
            $(`#image-hover-${imageHover}`).fadeOut();
        })
    </script>
@endsection
