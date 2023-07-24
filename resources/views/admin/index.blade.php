@extends('admin.app')

@section('content')

    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Склады и Маркетплэйсы</h3>
            <p>Данные о системе</p>
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
        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h2>Все Продукты</h2>
                    <p>
                        Просмотр всех продуктов, получение складов где находятся эти продукты, а также их остатки.

                    </p>
                    <button class="btn btn-outline-light" type="button">Узнать больше</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Все поставки</h2>
                    <p>На основе данных по API (скорости продаж, кол-во единиц в наличии, заказов с региона и др.) и данных своего склада, товара в пути скрипт формирует поставки на склады маркетплейса. Складов несколько...</p>
                    <button class="btn btn-outline-secondary" type="button">Узнать больше</button>
                </div>
            </div>
        </div>

        <div class="card bg-primary text-white mt-5 col-md-6 col-sm-12">
            <form id="myForm" action="{{route('admin.index')}}">
                <div class="card-header">
                    <h3 class="card-title">Маркетплэйсы</h3>
                </div>
                <input type="hidden" value="" id="sort_type_input" name="sort_type">
                <input type="hidden" value="" id="sort_value_input" name="sort_value">
                <div class="card-body table-responsive">
                    <table class="table text-white table-hover" style="font-size: 12px;">
                        <thead>
                        <tr>
                            <th scope="col">
                                ID
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
                                Название
                                <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                    <!-- Стрелка вверх -->
                                    <svg data-name="name" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'name' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>

                                    <!-- Стрелка вниз -->
                                    <svg data-name="name" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'name' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>
                                </div>
                            </th>

                            <th scope="col">
                                Статус
                                <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                    <!-- Стрелка вверх -->
                                    <svg data-name="status" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'status' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>

                                    <!-- Стрелка вниз -->
                                    <svg data-name="status" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'status' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                        <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                    </svg>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($marketPlaces as $key => $marketPlace)
                            <tr style="cursor: pointer">
                                <td>
                                    {{$marketPlace->id}}
                                </td>
                                <td>
                                    {{$marketPlace->name}}
                                </td>
                                <td>
                                    <button type="button" class="{{$marketPlace->status == 'ACTIVE' ? 'btn btn-success' : 'btn btn-danger'}}">{{$marketPlace->status == 'ACTIVE' ? 'Активный' : 'Не активный'}}</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$marketPlaces->withQueryString()->links()}}
                </div>
            </form>
        </div>
    </div>
@endsection
