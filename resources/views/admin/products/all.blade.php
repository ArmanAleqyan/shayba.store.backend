@extends('admin.layouts.default')
@section('title')
   Продукты
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
                                <h4 class="card-title">Список Товаров</h4>
                                <div class="form-group">
                                    <form action="{{route('search_product')}}" method="get">
                                    <div class="input-group">
                                        <input name="search" @if(isset($_GET['search']))  value="{{$_GET['search']}}" @endif type="text" class="form-control" placeholder="Поиск" aria-label="Поиск" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-primary" type="submit">Поиск</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                @if(auth()->user()->role_id != 1)
                                <a href="{{route('add_product')}}" class="btn btn-inverse-warning btn-fw createButton">Добавить новый товар</a>
                                    @endif
                            </div>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Название товара</th>
                                        <th>Цена</th>
                                        <th>Артикул</th>
                                        <th>Код в магазине</th>
                                        <th>Тип товара</th>
                                        @if(auth()->user()->id == 1)
                                            <th>Владелец</th>
                                        @endif
                                        @if(isset($_GET['search']))
                                        <th>Статус</th>
                                            @endif
                                    </tr>
                                    </thead>
                                    @foreach($get as $user)
                                        <tbody>
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->price}}</td>
                                            <td>{{$user->art}}</td>
                                            <td>{{$user->shop_id}}</td>
                                            <td>{{$user->category->name}}</td>
                                            @if(auth()->user()->role_id == 1)
                                            <td>    <a href="{{route('single_page_user',$user->user_id)}}">{{$user->user->name}}</a></td>
                                            @endif
                                            @if(isset($_GET['search']))
                                            @if($user->status == 1)
                                                <td>Активный</td>
                                                @elseif($user->status == 2)
                                                <td>Снят с продажы</td>
                                                @endif
                                            @endif
                                            <td style="    display: flex;  justify-content: flex-end;">
                                                <a href="{{route('product_page',$user->id)}}" class="btn btn-inverse-success btn-fw">Просмотреть</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <br><br>
                            <div style="display: flex; justify-content: center">{{ $get->appends(['search' => request()->search, 'per_page' => request()->per_page])}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
