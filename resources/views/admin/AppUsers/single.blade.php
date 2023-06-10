@extends('admin.layouts.default')
@section('title')
    Пользватель
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
    .error{
        color: red;

        font-size: x-small;
    }
</style>




@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @if(session('added'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Поздравляю</strong>  Добавление категории завершено
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Упс</strong> что-то пошло не так
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row ">


                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between">
                                <h4 class="card-title">Пользватель</h4>
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="display: flex;      height: fit-content;" type="button" class="btn btn-outline-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i> Назад </a>
                            </div>
                            <form class="forms-sample" enctype="multipart/form-data" action="{{route('add_bonuse_from_user')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Имя</label>
                                    <input name="name" value="{{old('name')??$get->name}}" type="text" class="form-control" id="exampleInputName1" placeholder="Имя" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Ном.телефона</label>
                                    <input  name="phone" value="{{old('name')??$get->phone}}" type="text" class="form-control" id="exampleInputName1" placeholder="Ном.телефона" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Эл.почта</label>
                                    <input name="email" value="{{old('name')??$get->email}}" type="text" class="form-control" id="exampleInputName1" placeholder="Эл.почта">
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Скидка в процентах (%)</label>
                                <input name="bonus" value="{{old('name')??$get->bonus}}" min="0" type="number" class="form-control" id="exampleInputName1" placeholder="Скидка в процентах">
                                @if($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                                <input type="hidden" value="{{$get->id}}" name="user_id">

{{--                                <div class="form-group">--}}
{{--                                    <div style="display: flex; justify-content: space-between">--}}
{{--                                    <label for="exampleInputName1">Пароль</label>--}}
{{--                                    <label for="exampleInputName1">Вы можете назначить только цыфры</label>--}}
{{--                                    </div>--}}
{{--                                    <input name="password"  min="10" type="number" class="form-control" id="exampleInputName1" placeholder="Пароль">--}}
{{--                                    @if($errors->has('name'))--}}
{{--                                        <div class="error">{{ $errors->first('name') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}


                                            <button type="submit" class="btn btn-inverse-success btn-fw">Изменить проценты бонусов</button>





                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
