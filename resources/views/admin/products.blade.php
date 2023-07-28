@extends('admin.app')

@section('content')

    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Товары</h3>
            <p>Все товары в маркетплэйсах которые храняться на ваших складах</p>
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
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$product->id}}</th>
                                <td>{{$product->instance_id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->sku}}</td>
                                <td>{{round($product->price, 1)}}</td>
                                <td>{{implode(',', $product->sizes ?? [])}}</td>
                                <td>{{implode(',', $product->colors ?? [])}}</td>
                                <td>{{implode(',', $product->files ?? [])}}</td>
                                <td>{{$product->income_type}}</td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1"
                                            data-id="{{$product->id}}" class="btn btn-danger delete-btn">Удалить
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$products->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="deleteForm" action="{{route('admin.products.deleteProducts')}}" method="post">
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('admin.products.storeProducts')}}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Форма создания</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Id в системе Маркетплэйса</label>
                            <input type="text" placeholder="Укажите Id" class="form-control" required name="instance_id">
                        </div>
                        <div class="form-group">
                            <label for="">Наименование</label>
                            <input type="text" placeholder="Укажите Наименование" class="form-control" required name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Артикул</label>
                            <input type="text" placeholder="Укажите Артикул" class="form-control" required name="sku">
                        </div>
                        <div class="form-group">
                            <label for="">Цена</label>
                            <input type="number" step=".1" placeholder="Укажите Цену" class="form-control" required name="price">
                        </div>
                        <div class="form-group" style="display: flex;
flex-direction: column;">
                            <label for="">Тип поставки</label>
                            <select required style="width: 100%" placeholder="Выберите тип" name="income_type">
                                <option value="TYPE_BOX">Бокс</option>
                                <option value="TYPE_MONOPALLET">Монопаллет</option>
                                <option value="TYPE_SUPER_SAFE">Cэйф</option>
                            </select>
                        </div>
                        <div class="form-group" style="display: flex; flex-direction: column;">
                            <label for="">Цвета</label>
                            <select multiple required name="colors[]" placeholder="Выберите Цвета" data-silent-initial-value-set="true">
                                @foreach(\App\Models\Product::$colors as $color)
                                    <option value="{{$color['id']}}"><span style="height: 20px; width: 20px; background: {{$color['style']}}">{{$color['label']}}</span></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="display: flex; flex-direction: column;">
                            <label for="">Размеры</label>
                            <select multiple required name="sizes[]" placeholder="Выберите Размеры" data-silent-initial-value-set="true">
                                @foreach(\App\Models\Product::$sizes as $size)
                                    <option value="{{$size['id']}}">{{$size['label']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Файлы</label>
                            <input type="file" name="files[]" multiple class="form-control is-invalid">
                            <input type="color" multiple>
                        </div>
                        <div class="form-group" style="display: flex; flex-direction: column;">
                            <label for="">Склады</label>
                            <select multiple required name="warehouses[]" placeholder="Выберите Склады" data-silent-initial-value-set="true">
                                @foreach(\App\Models\Warehouse::query()->get() as $warehouse)
                                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
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
    <script>
        VirtualSelect.init({
            ele: 'select',
            searchPlaceholderText: 'Поиск...',
            allOptionsSelectedText: 'Все',
        });
    </script>
    @include('admin.sort')
@endsection
