@extends('admin.layouts.default')
@section('title')
    Добавление модератора
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
            @if(session('updated'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Поздравляю</strong>  Редактирование модератора завершено
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
                                <h4 class="card-title">Добавить нового модератора</h4>
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="display: flex;      height: fit-content;" type="button" class="btn btn-outline-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i> Назад </a>
                            </div>
                            <form class="forms-sample" action="{{route('update_moderator')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Эл.почта</label>
                                    <input name="email" value="{{$get->email}}" type="email" class="form-control" id="exampleInputEmail3" placeholder="Эл.почта" required>
                                    @if($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <input type="hidden" name="user_id" value="{{$get->id}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Номер телефона</label>
                                    <input name="phone" value="{{$get->phone}}" type="text" class="form-control" id="exampleInputEmail3" placeholder="Номер телефона" required>
                                    @if($errors->has('phone'))
                                        <div class="error">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword4">Пароль</label>
                                    <input name="password"   type="text" class="form-control" id="exampleInputPassword4" placeholder="Пароль" >
                                    @if($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div style="display: flex; justify-content: space-between">
                                <button type="submit" class="btn btn-inverse-success btn-fw">Редактирование </button>
                                    <a href="{{route('delete_moderator', $get->id)}}" class="btn btn-outline-danger btn-fw">Удалить</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
