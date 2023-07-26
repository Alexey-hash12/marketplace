@extends('admin.app')

@section('content')

    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Остатки</h3>
            <p>...</p>
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

    @if($error ?? null)
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
                            <th scope="col">
                                #
                                <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                    <!-- Стрелка вверх -->
                                    <svg data-name="id" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'id' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>

                                    <!-- Стрелка вниз -->
                                    <svg data-name="id" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'id' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>
                                </div>
                            </th>
                            <th scope="col">
                                Название склада
                                <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                    <!-- Стрелка вверх -->
                                    <svg data-name="warehouse_name" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'warehouse_name' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>

                                    <!-- Стрелка вниз -->
                                    <svg data-name="warehouse_name" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'warehouse_name' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>
                                </div>
                            </th>
                            <th scope="col">
                                Название продукта
                                <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                    <!-- Стрелка вверх -->
                                    <svg data-name="product_name" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'product_name' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>

                                    <!-- Стрелка вниз -->
                                    <svg data-name="product_name" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'product_name' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>
                                </div>
                            </th>
                            <th scope="col">
                                Количество
                                <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                    <!-- Стрелка вверх -->
                                    <svg data-name="quantity" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'quantity' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>

                                    <!-- Стрелка вниз -->
                                    <svg data-name="quantity" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'quantity' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>
                                </div>
                            </th>
                            <th scope="col">
                                Дата создания
                                <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                    <!-- Стрелка вверх -->
                                    <svg data-name="created_at" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'created_at' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>

                                    <!-- Стрелка вниз -->
                                    <svg data-name="created_at" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'created_at' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>
                                </div>
                            </th>
                            <th>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leftOver as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->warehouse_name}}</td>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-id="{{$item->id}}" class="btn btn-danger delete-btn">Удалить</button>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$leftOver->withQueryString()->links()}}
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
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="deleteForm" action="{{route('admin.left-overs.deleteLeftOver')}}" method="post">
            @csrf
            <input type="hidden" id="deleteId" name="delete_id" value="">
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('admin.left-overs.storeLeftOver')}}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Форма создания</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $('.delete-btn').click(function () {

            const id = $(this).data('id');
            $('#deleteId').val(id);
        })
    </script>
@endsection
