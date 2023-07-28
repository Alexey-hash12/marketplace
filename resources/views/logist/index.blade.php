@extends('logist.app')

@section('content')
    @if($marketPlace->name == 'Wildberries')
        <style>

            .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
                background: linear-gradient(102.42deg,#da15b8 59.69%,#8d06cc) !important;
            }

            .accordion-button {
                background: linear-gradient(102.42deg,#da15b8 59.69%,#8d06cc) !important;
                border: 0 !important;
            }
            .btn-success {
                transition: .1s all ease-in;
                background: linear-gradient(102.42deg,#da15b8 59.69%,#8d06cc) !important;
                border: 0 !important;
            }
            .btn-primary {
                background: linear-gradient(102.42deg,#da15b8 59.69%,#8d06cc) !important;
                border: none;
            }
            .btn-primary:hover, .btn-success:hover {
                color: #8d06cc !important;
            }
            .btn-info {
                background: #8d06cc!important;
                border: none;
                color:white;
            }
            .btn-info:hover {
                background: #cb5bff !important;
                color: #8d06cc !important;
            }
        </style>
    @elseif($marketPlace->name == 'OZON')
        <style>

            .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
                background: linear-gradient(102.42deg, #1536da 59.69%, #0662cc) !important;
            }

            .accordion-button {
                background: linear-gradient(102.42deg, #1536da 59.69%, #0662cc) !important;

                border: 0 !important;
            }
            .btn-success {
                transition: .1s all ease-in;
                background: linear-gradient(102.42deg, #1536da 59.69%, #0662cc) !important;

                border: 0 !important;
            }
            .btn-primary {
                background: linear-gradient(102.42deg, #1536da 59.69%, #0662cc) !important;

                border: none;
            }
            .btn-primary:hover, .btn-success:hover {
                color: #063ecc !important;
            }
            .btn-info {
                background: #063ecc!important;
                border: none;
                color:white;
            }
            .btn-info:hover {
                background: #5b7cff !important;
                color: #063ecc !important;
            }
        </style>
    @endif
    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Продукты</h3>
            <p>Все Продукты</p>
            <div class="d-flex" style="font-size: 14px; column-gap: 8px;">
                <div>
                    <a style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success btn-lg" href="#" role="button">Создать »</a></p>
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
                @foreach($wareHouses as $wareHouse)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">{{$wareHouse->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card" style="border-top-left-radius: 0; border-top-right-radius: 0;">
            <form id="myForm" action="">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <img src="/images/filter.svg" style="width: 30px">
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="d-flex mt-4">
                                        <div class="row" style="row-gap: 12px;">
                                            <div class="d-flex col-4" style="column-gap: 8px;">
                                                <div class="form-group col-4" style="width: 50%">
                                                    <label for="">Идентификатор</label>
                                                    <input type="text" style="" class="form-control" name="incomeId-search" value="{{request()->get('incomeId-search') ?? ''}}">
                                                </div>

                                                <div class="form-group" style="width: 50%">
                                                    <label for="">Наименование</label>
                                                    <input type="text" style="" class="form-control" name="name-search" value="{{request()->get('name-search') ?? ''}}">
                                                </div>
                                            </div>

                                            <div class="d-flex col-4" style="column-gap: 8px;">
                                                <div class="form-group"  style="width: 50%">
                                                    <label for="">сКГТ-признак</label>
                                                    <select class="form-control" name="isLargeCargo-in">
                                                        <option value="">Выберите</option>
                                                        <option value="true" {{request()->get('isLargeCargo-in') == "true" ? 'selected' : ''}}>Да</option>
                                                        <option value="false" {{request()->get('isLargeCargo-in') == "false" ? 'selected' : ''}}>Нет</option>
                                                    </select>
                                                </div>
                                                <div class="form-group"  style="width: 50%">
                                                    <label for="">Статус</label>
                                                    <select class="form-control" name="done-in">
                                                        <option value="">Выберите</option>
                                                        <option value="true" {{request()->get('done-in') == "true" ? 'selected' : ''}}>Выполнена</option>
                                                        <option value="false" {{request()->get('done-in') == "false" ? 'selected' : ''}}>Не выполнена</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-4 d-flex" style="column-gap: 8px;">
                                                <div class="form-group" style="width: 50%">
                                                    <label for="">Дата создания От</label>
                                                    <input type="datetime-local" class="form-control" name="createdAt-from" value="{{request()->get('createdAt-from') ?? ''}}">
                                                </div>
                                                <div class="form-group" style="width: 50%">
                                                    <label for="">Дата создания До</label>
                                                    <input type="datetime-local" class="form-control" name="createdAt-to" value="{{request()->get('createdAt-to') ?? ''}}">
                                                </div>
                                            </div>

                                            <div class="col-4 d-flex" style="column-gap: 8px;">
                                                <div class="form-group" style="width: 50%">
                                                    <label for="">Дата закрытия От</label>
                                                    <input type="datetime-local" class="form-control" name="closedAt-from" value="{{request()->get('closedAt-from') ?? ''}}">
                                                </div>
                                                <div class="form-group" style="width: 50%">
                                                    <label for="">Дата закрытия До</label>
                                                    <input type="datetime-local" class="form-control" name="closedAt-to" value="{{request()->get('closedAt-to') ?? ''}}">
                                                </div>
                                            </div>

                                            <div class="col-4 d-flex" style="column-gap: 8px;">
                                                <div class="form-group" style="width: 50%">
                                                    <label for="">Дата скана От</label>
                                                    <input type="datetime-local" class="form-control" name="scanDt-from" value="{{request()->get('scanDt-from') ?? ''}}">
                                                </div>
                                                <div class="form-group" style="width: 50%">
                                                    <label for="">Дата скана До</label>
                                                    <input type="datetime-local" class="form-control" name="scanDt-to" value="{{request()->get('scanDt-to') ?? ''}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Фильтр</button>
                                    <a href="{{route('index')}}" style="margin-left: 12px;" type="submit" class="btn btn-info ml-2 mt-4">Сбросить</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                </th>
                            @endforeach
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomes as $key => $income)
                            <tr style="cursor: pointer" onclick="openNew('{{$income->incomeId}}')">

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$incomes->withQueryString()->links()}}
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
@endsection
