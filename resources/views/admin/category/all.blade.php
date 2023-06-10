@extends('admin.layouts.default')
@section('title')
    Список категорий
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
                                <h4 class="card-title">Список категорий</h4>
                                <a href="{{route('new_category')}}" class="btn btn-inverse-warning btn-fw createButton">Добавить новую категорию</a>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Название категории </th>
                                    </tr>
                                    </thead>
                                    @foreach($get as $user)
                                        <tbody>
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td style="    display: flex;  justify-content: flex-end;">
                                                <a href="{{route('category',$user->id)}}" class="btn btn-inverse-success btn-fw">Просмотреть</a>
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
