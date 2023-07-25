@extends('admin.app')

@section('content')

    <div class="jumbotron" style="background-color: #e9ecef;padding: 20px;">
        <div class="container">
            <h3 style="font-size: 38px;font-weight: 400;" class="display-3">Пользователи</h3>
            <p>Пользователи системы с их ролями</p>
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
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-id="{{$user->id}}" class="btn btn-danger delete-btn">Удалить</button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$users->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="deleteForm" action="{{route('admin.users.deleteUsers')}}" method="post">
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
        <form action="{{route('admin.users.storeUsers')}}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Форма создания</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Имя</label>
                            <input type="text" placeholder="Укажите Имя" class="form-control" required name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Почта</label>
                            <input type="email" placeholder="Укажите почту" class="form-control" required name="email">
                        </div>
                        <div class="form-group">
                            <label for="">Пароль</label>
                            <input type="password" placeholder="Укажите пароль" class="form-control" required name="password">
                        </div>
                        <div class="form-group">
                            <label for="">Роль</label>
                            <select name="role" required class="form-control">
                                <option value="">Выберите роль</option>
                                @foreach(\App\Models\User::$userRoles as $key => $role)
                                    <option value="{{$key}}">{{$role}}</option>
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

    @include('admin.sort')
@endsection
