@extends('admin.layouts.default')
@section('title')
   Новые заказы
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
                                <h4 class="card-title">Новые заказы</h4>
{{--                                <a href="" class="btn btn-inverse-warning btn-fw createButton">Добавить новую категорию</a>--}}
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Номер заказа </th>
                                        <th>Номер телефона </th>
                                        <th>Эл.почта </th>
                                        <th>Создан </th>
                                        @if(auth()->user()->role_id == 1)
                                        <th>Пользователь  </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    @foreach($get as $user)
                                        <tbody>
                                        <tr>
                                            <td>{{$user->order_id}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->created_at}}</td>
                                            @if(auth()->user()->role_id == 1)
                                            <td><a href="{{route('app_user_single_page', $user->user->id)}}">{{$user->user->name}}</a> </td>
                                            @endif
                                            <td style="    display: flex;  justify-content: flex-end;">
                                                <a href="@if(auth()->user()->role_id == 4 || auth()->user()->role_id == 1){{route('single_new_shop', $user->id)}} @else {{route('ShowNewShopDetails', $user->id)}} @endif" class="btn btn-inverse-success btn-fw">Детали</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <br><br>
                            <div style="display: flex; justify-content: center">{{$get->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
