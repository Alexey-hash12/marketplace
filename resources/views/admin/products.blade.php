@extends('admin.app')

@section('content')

    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Товары</h3>
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

    <div class="container_my mt-5 mb-5">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id в системе маркеплэйса</th>
                        <th scope="col">Маркеплэйс</th>
                        <th scope="col">Наименование</th>
                        <th scope="col">Артикул</th>
                        <th scope="col">Размеры</th>
                        <th scope="col">Цвета</th>
                        <th scope="col">Файлы</th>
                        <th scope="col">Тип поставки</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->instance_id}}</td>
                            <td>{{$product->marketplace->name}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->sku}}</td>
                            <td>{{round($product->price, 1)}}</td>
                            <td>{{implode(',', $product->sizes ?? [])}}</td>
                            <td>{{implode(',', $product->colors ?? [])}}</td>
                            <td>{{implode(',', $product->files ?? [])}}</td>
                            <td>{{$product->income_type}}</td>
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
@endsection
