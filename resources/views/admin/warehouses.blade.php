@extends('admin.app')

@section('content')

    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Склады</h3>
            <p>Зарегистрированные склады в системе</p>
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

    @if($error)
        <div class="container_my mt-2">
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        </div>
    @endif

    <form action="" id="myForm">
        <input type="hidden" name="sort_type" id="sort_type_input">
        <input type="hidden" name="sort_value" id="sort_value_input">

        <div class="container_my mt-3 mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Создать
            </button>
        <div class="card mt-3">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        @foreach($data as $key => $item)
                            <th scope="col">
                                {{$item}}
                                <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                    <!-- Стрелка вверх -->
                                    <svg data-name="{{$key}}" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == $key && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>

                                    <!-- Стрелка вниз -->
                                    <svg data-name="{{$key}}" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == $key && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>
                                </div>
                            </th>
                        @endforeach
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($warehouses as $warehouse)
                        <tr>
                            <th scope="row">{{$warehouse->id}}</th>
                            <td>{{$warehouse->name}}</td>
                            <td>{{$warehouse->marketplace_name ?? 'Наш склад'}}</td>
                            <td>{{$warehouse->count_products}}</td>
                            <td>{{$warehouse->created_at}}</td>
                            <td>
                                <div>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal4" data-object="{{$warehouse}}" class="btn btn-primary update-btn">Изменить</button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-id="{{$warehouse->id}}" class="btn btn-danger delete-btn">Удалить</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$warehouses->withQueryString()->links()}}
            </div>
        </div>
    </div>
    </form>

    <script>
        const form = document.getElementById('myForm');

        $('.form-sort').click(function () {
            $('#sort_type_input').val($(this).data('name'));
            $("#sort_value_input").val($(this).data('value'));
            form.submit();
        })
    </script>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('admin.warehouses.storeWarehouse')}}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Форма создания</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Название</label>
                            <input type="text" class="form-control" required name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Маркетплэйс</label>
                            <select name="marketplace_type_id" class="form-control">
                                <option value="">Наш склад</option>
                                @foreach(\App\Models\MarketplaceType::where('status', 'active')->get() as $marketPlace)
                                    <option value="{{$marketPlace->id}}">{{$marketPlace->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('admin.warehouses.updateWarehouse')}}" method="post">
            <input type="hidden" name="id" id="warehouseid">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Форма изменения</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Название</label>
                            <input type="text" id="warehousename" class="form-control" required name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Маркетплэйс</label>
                            <select name="marketplace_type_id" id="warehousemarketplace" class="form-control">
                                <option value="">Наш склад</option>
                                @foreach(\App\Models\MarketplaceType::where('status', 'active')->get() as $marketPlace)
                                    <option value="{{$marketPlace->id}}">{{$marketPlace->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="deleteForm" action="{{route('admin.warehouses.deleteWarehouse')}}" method="post">
            @csrf
            <input type="hidden" id="deleteTokenId" name="delete_id" value="">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Удаление</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Вы точно хотите удалить?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $('.delete-btn').click(function () {

            const id = $(this).data('id');
            $('#deleteTokenId').val(id);
        })

        $('.update-btn').click(function () {
           const object = $(this).data('object');
           $('#warehousename').val(object.name);
            $('#warehouseid').val(object.id);
            $('#warehousemarketplace').val(object.marketplace_type_id).change();
            console.log(object.marketplace_type_id);
        });

    </script>
@endsection
