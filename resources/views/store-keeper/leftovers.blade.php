@extends('store-keeper.app')

@section('content')
    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Остатки</h3>
            <p>Остатки продуктов в наших складах</p>
            <div class="d-flex" style="font-size: 14px; column-gap: 8px;">
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
                        <a class="nav-link {{$wareHouse->id == $warehouse->id ? 'active' : ''}}" aria-current="page" href="{{route('store-keeper.leftovers', $wareHouse->id)}}">{{$wareHouse->name}}</a>
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
                                                    <input type="text" style="" class="form-control" name="item_id-search" value="{{request()->get('item_id-search') ?? ''}}">
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
                        @foreach($products as $key => $income)
                            <tr>
                                <td>
                                    {{$income->item_id}}
                                </td>
                                <td>
                                    {{$income->name}}
                                </td>
                                <td>
                                    <img class="image-hover" data-id="{{$income->id}}" src="{{$income->files && count($income->files) ? $income->files[0] : '' }}" style="width: 40px; height: 40px;" alt="нет">
                                    <div style="position: relative">
                                        <img id="image-hover-{{$income->id}}" src="{{$income->files && count($income->files) ? $income->files[0] : '' }}" style="width: 200px; height: 200px;display: none;position: absolute;object-fit:contain;top: -40px;left: 40px;" alt="нет">
                                    </div>
                                </td>
                                <td>
                                    {{$income->sku}}
                                </td>
                                <td>
                                    {{$income->price}}
                                </td>
                                <td>
                                {{$income->product_left_count}}
                                <td>
                                    {{$income->income_type}}
                                </td>
                                <td>
                                    <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal6"
                                            data-warehouse="{{$income->warehouses_id}}" data-id="{{$income->item_id}}" class="btn btn-primary change-leftovers-btn">Изменить остатки на складе</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$products->withQueryString()->links()}}
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="deleteForm" action="{{route('store-keeper.leftovers.add')}}" method="post">
            @csrf
            <input type="hidden" id="deleteId" name="leftover_id" value="">
            <input type="hidden" id="warehouseid" name="warehouseid" value="">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Изменение Остатков</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Укажите остатки</label>
                            <input type="number" required step="0.1" class="form-control" name="value" id="leftovervalue">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Изменить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $('.change-leftovers-btn').click(function () {

            const id = $(this).data('id');
            const warehouse = $(this).data('warehouse')
            $('#deleteId').val(id);
            $('#warehouseid').val(warehouse)
        })
    </script>
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
