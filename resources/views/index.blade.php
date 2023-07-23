@extends('app')

@section('content')

    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Ваши рекламные компании</h3>
            <p>Рекламная компания имеет свои настройки и статистику. Вы может менять значения или смотреть статистику для анализа эффективности.</p>
                <div class="d-flex" style="font-size: 14px; column-gap: 8px;">
                    <div>
                        <a style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success btn-lg" href="#" role="button">Создать »</a></p>
                    </div>
                    <div>
                        <a style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#exampleModal3" class="btn btn-primary btn-lg" href="#" role="button">Настройки »</a>
                    </div>
                    <div>
                        <a style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#exampleModal4" class="btn btn-info btn-lg" href="#" role="button">Массовое добавление »</a></p>
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
        <div class="card">
            <form id="myForm" action="{{route('index')}}">
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
                                <div class="form-check form-switch">
                                    <input id="flexSwitchCheckChecked" class="form-check-input" name="is_archived" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{request()->get('is_archived') ? 'checked' : ''}}>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Отображать Архивные</label>
                                </div>

                                <div class="d-flex mt-4">
                                    <div class="row" style="row-gap: 12px;">

                                        <div class="col-4 d-flex" style="column-gap: 8px;">
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Артикул</label>
                                                <input type="text" style="" class="form-control" name="SKU-search" value="{{request()->get('SKU-search') ?? ''}}">
                                            </div>

                                            <div class="form-group"  style="width: 50%">
                                                <label for="">Статус</label>
                                                <select class="form-control" name="STATUS-in">
                                                    <option value="">Выберите</option>
                                                    @foreach(\App\Models\Product::$statuses as $key => $field)
                                                        <option value="{{$key}}" {{request()->get('STATUS-in') == $key ? 'selected' : ''}}>{{$field}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    <div class="col-4 d-flex" style="column-gap: 8px;">
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Средний бюджет От</label>
                                            <input type="number" step="0.1"class="form-control" name="avg_budget-from" value="{{request()->get('avg_budget-from') ?? ''}}">
                                        </div>

                                        <div class="form-group" style="width: 50%">
                                            <label for="">Средний бюджет До</label>
                                            <input type="number" step="0.1"class="form-control" name="avg_budget-to" value="{{request()->get('avg_budget-to') ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-4 d-flex" style="column-gap: 8px;">
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Сколько потрачено От</label>
                                            <input type="number" step="0.1"class="form-control" name="sum_spentrub-from" value="{{request()->get('sum_spentrub-from') ?? ''}}">
                                        </div>
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Сколько потрачено До</label>
                                            <input type="number" step="0.1"class="form-control" name="sum_spentrub-to" value="{{request()->get('sum_spentrub-to') ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-4 d-flex" style="column-gap: 8px;">
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Заказы От</label>
                                            <input type="number" step="0.1"class="form-control" name="sum_orders-from" value="{{request()->get('sum_orders-from') ?? ''}}">
                                        </div>
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Заказы До</label>
                                            <input type="number" step="0.1"class="form-control" name="sum_orders-to" value="{{request()->get('sum_orders-to') ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-4 d-flex" style="column-gap: 8px;">
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Цена заказов От</label>
                                            <input type="number" step="0.1"class="form-control" name="order_price-from" value="{{request()->get('order_price-from') ?? ''}}">
                                        </div>
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Цена заказов До</label>
                                            <input type="number" step="0.1"class="form-control" name="order_price-to" value="{{request()->get('order_price-to') ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-4 d-flex" style="column-gap: 8px;">
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Количество корзин От</label>
                                            <input type="number" step="0.1"class="form-control" name="sum_basket-from" value="{{request()->get('sum_basket-from') ?? ''}}">
                                        </div>
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Количество корзин До</label>
                                            <input type="number" step="0.1"class="form-control" name="sum_basket-to" value="{{request()->get('sum_basket-to') ?? ''}}">
                                        </div>
                                    </div>

                                    <div class="col-4 d-flex" style="column-gap: 8px;">
                                        <div class="form-group"style="width: 50%">
                                            <label for="">Конверсия корзин От</label>
                                            <input type="number" step="0.1"class="form-control" name="conversion-from" value="{{request()->get('conversion-from') ?? ''}}">
                                        </div>
                                        <div class="form-group" style="width: 50%">
                                            <label for="">Конверсия корзин До</label>
                                            <input type="number" step="0.1"class="form-control" name="conversion-to" value="{{request()->get('conversion-to') ?? ''}}">
                                        </div>
                                    </div>

                                        <div class="col-4 d-flex" style="column-gap: 8px;">
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Цена корзин От</label>
                                                <input type="number" step="0.1"class="form-control" name="basket_price-from" value="{{request()->get('basket_price-from') ?? ''}}">
                                            </div>
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Цена корзин До</label>
                                                <input type="number" step="0.1"class="form-control" name="basket_price-to" value="{{request()->get('basket_price-to') ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="col-4 d-flex" style="column-gap: 8px;">
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Показы От</label>
                                                <input type="number" step="0.1"class="form-control" name="sum_shows-from" value="{{request()->get('sum_shows-from') ?? ''}}">
                                            </div>
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Показы До</label>
                                                <input type="number" step="0.1"class="form-control" name="sum_shows-to" value="{{request()->get('sum_shows-to') ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-4 d-flex" style="column-gap: 8px;">
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Клики От</label>
                                                <input type="number" step="0.1"class="form-control" name="sum_clicks-from" value="{{request()->get('sum_clicks-from') ?? ''}}">
                                            </div>
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Клики До</label>
                                                <input type="number" step="0.1"class="form-control" name="sum_clicks-to" value="{{request()->get('sum_clicks-to') ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-4 d-flex" style="column-gap: 8px;">
                                            <div class="form-group" style="width: 50%">
                                                <label for="">CTR От</label>
                                                <input type="number" step="0.1"class="form-control" name="avg_ctr-from" value="{{request()->get('avg_ctr-from') ?? ''}}">
                                            </div>
                                            <div class="form-group" style="width: 50%">
                                                <label for="">CTR До</label>
                                                <input type="number" step="0.1"class="form-control" name="avg_ctr-to" value="{{request()->get('avg_ctr-to') ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-4 d-flex" style="column-gap: 8px;">
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Цена кликов От</label>
                                                <input type="number" step="0.1"class="form-control" name="avg_cpc-from" value="{{request()->get('avg_cpc-from') ?? ''}}">
                                            </div>
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Цена кликов До</label>
                                                <input type="number" step="0.1"class="form-control" name="avg_cpc-to" value="{{request()->get('avg_cpc-to') ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-4 d-flex" style="column-gap: 8px;">
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Конверсия заказов От</label>
                                                <input type="number" step="0.1"class="form-control" name="avg_cr-from" value="{{request()->get('avg_cr-from') ?? ''}}">
                                            </div>
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Конверсия заказов До</label>
                                                <input type="number" step="0.1"class="form-control" name="avg_cr-to" value="{{request()->get('avg_cr-to') ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="col-4 d-flex" style="column-gap: 8px;">
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Частота От</label>
                                                <input type="number" step="0.1"class="form-control" name="avg_freq-from" value="{{request()->get('avg_freq-from') ?? ''}}">
                                            </div>
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Частота До</label>
                                                <input type="number" step="0.1"class="form-control" name="avg_freq-to" value="{{request()->get('avg_freq-to') ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-4 d-flex" style="column-gap: 8px;">
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Баланс От</label>
                                                <input type="number" step="0.1"class="form-control" name="sum_balance-from" value="{{request()->get('sum_balance-from') ?? ''}}">
                                            </div>
                                            <div class="form-group" style="width: 50%">
                                                <label for="">Баланс До</label>
                                                <input type="number" step="0.1"class="form-control" name="sum_balance-to" value="{{request()->get('sum_balance-to') ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-4 d-flex" style="column-gap: 8px;">
                                        <div class="form-group">
                                            <label for="">Поле для фильтра</label>
                                            <select class="form-control" name="filter_name">
                                                <option value="">Выберите</option>
                                                @foreach(\App\Models\Product::$fields as $key => $field)
                                                    <option value="{{$key}}" {{request()->get('filter_name') == $key ? 'selected' : ''}}>{{$field}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Значение для фильтра</label>
                                            <input type="text" class="form-control" name="filter_value" value="{{request()->get('filter_value') ?? ''}}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Фильтр</button>
                                <a href="{{route('index')}}" type="submit" class="btn btn-info mt-4">Сбросить</a>
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
                        <th scope="col">#</th>
                        <th scope="col">
                            Артикул
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="SKU" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'SKU' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="SKU" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'SKU' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th>
                            Фото
                        </th>
                        <th scope="col">
                            Бюджет
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="avg_budget" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'avg_budget' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="avg_budget" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'avg_budget' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Потрачено
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="sum_spentrub" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'sum_spentrub' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="sum_spentrub" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'sum_spentrub' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Заказы
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="sum_orders" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'sum_orders' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="sum_orders" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'sum_orders' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}"  viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Цена заказа
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="order_price" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'order_price' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="order_price" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'order_price' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Корзины
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="sum_basket" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'sum_basket' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="sum_basket" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'sum_basket' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Конверсия корзины
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="conversion" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'conversion' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="conversion" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'conversion' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Цена корзины
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="basket_price" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'basket_price' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="basket_price" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'basket_price' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Показы
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="sum_shows" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'sum_shows' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="sum_shows" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'sum_shows' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Клики
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="sum_clicks" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'sum_clicks' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="sum_clicks" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'sum_clicks' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            CTR
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="avg_ctr" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'avg_ctr' && request()->sort_value=='desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="avg_ctr" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'avg_ctr' && request()->sort_value=='asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Цена клика
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="avg_cpc" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'avg_cpc' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="avg_cpc" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'avg_cpc' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Конверсия заказа
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="avg_cr" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'avg_cr' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="avg_cr" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'avg_cr' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Частота
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="avg_freq" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'avg_freq' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="avg_freq" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'avg_freq' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">
                            Баланс
                            <div class="d-flex" style="height: 24px;;align-items: center;column-gap: 8px;">
                                <!-- Стрелка вверх -->
                                <svg data-name="sum_balance" data-value="desc" class="form-sort strelka-top-3 {{request()->sort_type == 'sum_balance' && request()->sort_value == 'desc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>

                                <!-- Стрелка вниз -->
                                <svg data-name="sum_balance" data-value="asc" class="form-sort strelka-bottom-3 {{request()->sort_type == 'sum_balance' && request()->sort_value == 'asc' ? 'strelka-hovered' : ''}}" viewBox="0 0 5 9">
                                    <path d="M0.419,9.000 L0.003,8.606 L4.164,4.500 L0.003,0.394 L0.419,0.000 L4.997,4.500 L0.419,9.000 Z" ></path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key => $product)
                            <tr style="cursor: pointer" onclick="openNew({{$product->SKU}})">
                                <td>
                                    {{$key + 1}}
                                </td>
                                <td>
                                    {{$product->SKU}}
                                </td>
                                <td>
                                    @if($product->IMAGE)
                                        <img src="{{$product->IMAGE}}" height="50" width="50" style="border-radius: 50%; object-fit: cover" alt="">
                                    @else
                                        нет
                                    @endif
                                </td>
                                <td>
                                    {{round($product->avg_budget, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{round($product->sum_spentrub, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{round($product->sum_orders, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{ round($product->order_price ?? 0, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{ round($product->sum_basket, 1) ?? 0 ?? 'нет'}}
                                </td>
                                <td>
                                    {{ round($product->conversion, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{ round($product->basket_price, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{ round($product->sum_shows, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{ round($product->sum_clicks, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{round($product->avg_ctr, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{round($product->avg_cpc, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{round($product->avg_cr, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{round($product->avg_freq, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    {{round($product->sum_balance, 1) ?? 'нет'}}
                                </td>
                                <td>
                                    <button style="font-size: 12px;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal6" data-sku="{{$product->SKU}}"  class="phras btn btn-primary" data-extra="{{json_encode(\Illuminate\Support\Facades\DB::select("select * from wb_extra where SKU = $product->SKU"))}}">
                                        Фразовые соответствия
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
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('update.settings')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Изменение настроек</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">Остановить РК, если товара на складе ВБ менее: {{$config && count($config) ? $config[0]->value : 'не указано'}}</label>
                            <input class="form-control" type="text" name="value" required placeholder="Укажите значение">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('store.multiple')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Массовое добавление</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="">
                                <h4>Укажите записи через ;</h4>

                                <div>
                                    <span><b>
                                Примеры(Тип;Управление;Артикул;Макс ставка;Фикс ставка;Период показа;Бюджет)
                                    </b></span>
                                </div>
                                <div>
                                    П;А;40183308;500;;;<br>
                                    П;А;40183308;500;стулья;;400<br>
                                    П;А;40183308;500;стулья;10-12;400<br>
                                </div>
                                <br>
                            </label>
                            <textarea name="value" cols="30" rows="10" class="form-control" placeholder="Укажите значение"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('update.phrase')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Фразовое соответствие</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <input type="hidden" id="phrasesku" name="SKU" value="">
                            <label for="">Укажите фразовое соответствие</label>
                            <input class="form-control" id="phraseText" type="text" name="value" required placeholder="Укажите значение" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        function openNew(sku)
        {
            window.location.href = `/${sku}`;
        }

        $('.phras').click(function (event) {
            event.preventDefault();
            event.stopPropagation();
            const extra = $(this).data('extra');
            let res = '';
            if (extra && extra.length) {
                res = extra[0].FS;
            } else {
                res = '';
            }
            const SKU = $(this).data('sku');
            $('#phraseText').val(res);
            $('#phrasesku').val(SKU);
        })

        const form = document.getElementById('myForm');
        // const checkbox = document.getElementById('flexSwitchCheckChecked');
        //
        // checkbox.addEventListener('change', function() {
        //     form.submit();
        // });

        $('.form-sort').click(function () {
            $('#sort_type_input').val($(this).data('name'));
            $("#sort_value_input").val($(this).data('value'));
            form.submit();
        })
    </script>
@endsection
