@extends('admin.layouts.default')
@section('title')
    Вкусы
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
                                <h4 class="card-title">Список вкусов</h4>
                                <div class="form-group" style="width: 49%;">
                                    <form action="{{route('search_all_taste')}}" method="get">
                                        
                                    <div class="input-group">
                                        <input name="search" type="text" class="form-control" placeholder="Поиск вкусов" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-primary" type="submit">Поиск</button>
                                        </div>

                                    </div>
                                    </form>
                                </div>
                                <a href="{{route('new_all_taste')}}" class="btn btn-inverse-warning btn-fw createButton">Добавить</a>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Название </th>
                                    </tr>
                                    </thead>
                                    @foreach($get as $user)
                                        <tbody>
                                        <tr>
                                            <a href="{{route('category',$user->id)}}"><td>{{$user->name}}</td></a>
                                            {{--                                            <td>{{$user->category->name}}</td>--}}
                                            <td style="    display: flex;  justify-content: flex-end;">
                                                <a href="{{route('single_page_taste',$user->id)}}" class="btn btn-inverse-success btn-fw">Просмотреть</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <br><br>
                            <div style="display: flex; justify-content: center">{{$get->appends(request()->all())}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
