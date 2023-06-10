@extends('admin.layouts.default')
@section('title')
    Список Пользвателей
@endsection

<style>
    input{
        color: white !important;
    }
    .swal2-container.swal2-center>.swal2-popup {
        background: #0f1116 !important;

    }
    /*.swal2-styled.swal2-confirm{*/
    /*    background-color: #a5dc86 !important;*/
    /*    border: none !important;*/
    /*}*/

    .createButton{
        height: 31%;
    }
</style>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row ">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between">
                                <h4 class="card-title"> Список Пользователей - количество  ` {{$getUserCount}}</h4>
                                <div class="form-group">
                                    <form action="{{route('search_user')}}" method="get">
                                    <div class="input-group">
                                        <input name="search" type="text" class="form-control" placeholder="Поиск" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-primary" type="button">Поиск</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Имя </th>
                                        <th> Эл.почта </th>
                                        <th> Ном.телефона </th>
                                        <th> Подтверждения номера телефона </th>
                                        <th>Скидка в процентах (%)</th>
                                    </tr>
                                    </thead>
                                    @foreach($getUser as $user)
                                        <tbody>
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td> {{$user->email}} </td>
                                            <td>+{{$user->phone}} </td>
                                            @if($user->phone_verify == 1)
                                            <td> Подтвержденный </td>
                                            @else
                                                <td><a class="btn btn-inverse-warning btn-fw createButton" href="{{route('success_register', $user->id)}}">Потвердить</a></td>
                                            @endif
                                            <td>{{$user->bonus}}</td>
                                            <td >
                                                <a href="{{route('app_user_single_page',$user->id)}}" class="btn btn-inverse-success btn-fw">Просмотреть</a>
                                            </td>

                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <br><br>
                            <div style="display: flex; justify-content: center">{{ $getUser->appends(['search' => request()->search, 'per_page' => request()->per_page])}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
