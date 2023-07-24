@extends('admin.app')

@section('content')

    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Поставки</h3>
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
                        <th scope="col">Маркеплэйс</th>
                        <th scope="col">Период</th>
                        <th scope="col">Дни</th>
                        <th scope="col">Минимальная ставка</th>
                        <th scope="col">Количество заявок</th>
                        <th scope="col">Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($incomes as $income)
                        <tr>
                            <th scope="row">{{$income->id}}</th>
                            <td>{{$income->marketplace->name}}</td>
                            <td>{{$income->period}}</td>
                            <td>{{$income->min_stocks}}</td>
{{--                        todo add warehouses --}}
                            <td>{{$income->count_articles}}</td>
                            <td>{{$income->created_at}}</td>
                    </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$incomes->withQueryString()->links()}}
            </div>
        </div>
    </div>
@endsection
