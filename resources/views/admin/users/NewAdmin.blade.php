@extends('admin.layouts.default')
@section('title')
    Новый магазин
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
                    <strong>Поздравляю</strong>  Добавление магазина завершено
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
                            <h4 class="card-title">Создание магазина</h4>
                         <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="display: flex;      height: fit-content;" type="button" class="btn btn-outline-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i> Назад </a>
                            </div>
                            <form class="forms-sample" action="{{route('add_new_shop')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Название магазина</label>
                                    <input name="name" value="{{old('name')}}" type="text" class="form-control" id="exampleInputName1" placeholder="Название магазина" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail3">Эл.почта</label>
                                    <input name="email" value="{{old('email')}}" type="email" class="form-control" id="exampleInputEmail3" placeholder="Эл.почта" required>
                                    @if($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail3">Номер телефона</label>
                                    <input name="phone" value="{{old('phone')}}" type="text" class="form-control" id="exampleInputEmail3" placeholder="Номер телефона" required>
                                    @if($errors->has('phone'))
                                        <div class="error">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Адрес</label>
                                    <input name="address" value="{{old('address')}}" type="text" class="form-control" id="exampleInputEmail3" placeholder="Адрес" required>
                                    @if($errors->has('address'))
                                        <div class="error">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword4">Пароль</label>
                                    <input name="password" value="{{old('password')}}"  type="text" class="form-control" id="exampleInputPassword4" placeholder="Пароль" required>
                                    @if($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword4">Идентификатор магазина</label>
                                    <input name="shop_id" value="{{old('shop_id')}}"  type="text" class="form-control" id="exampleInputPassword4"  placeholder="Идентификатор магазина">
                                    @if($errors->has('shop_id'))
                                        <div class="error">{{ $errors->first('shop_id') }}</div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-inverse-success btn-fw">Создать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
