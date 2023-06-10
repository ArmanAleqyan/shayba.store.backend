@extends('admin.layouts.default')
@section('title')
    Информация о нас
@endsection

<style>
    input{
        color: white !important;
    }
    textarea{
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
                    <strong>Поздравляю</strong> Редактирование завершено
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
                                <h4 class="card-title">Информация о нас</h4>

                                <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="display: flex;      height: fit-content;" type="button" class="btn btn-outline-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i> Назад </a>
                            </div>

                            <h1><a target="_blank" href="https://greensms.ru/"> Баланс для звонков пользователь` {{$balance}}</a></h1>
                            <br>
                            <form class="forms-sample" enctype="multipart/form-data" action="{{route('update_shop_description')}}" method="post">
                                @csrf

                                <input type="hidden" name="get_id" value="{{$get->id}}">
                                <div class="form-group">
                                    <label for="exampleInputName1">Номер телефона в загаловке</label>
                                    <input name="header_phone" value="{{old('name')??$get->header_phone}}" type="text" class="form-control" id="exampleInputName1" placeholder="Номер телефона в загаловке" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Вконтакте</label>
                                    <input name="vk_url" value="{{old('name')??$get->vk_url}}" type="text" class="form-control" id="exampleInputName1" placeholder="Вконтакте" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Инстаграм</label>
                                    <input name="instagram_url" value="{{old('name')??$get->instagram_url}}" type="text" class="form-control" id="exampleInputName1" placeholder="Инстаграм" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Ватсап</label>
                                    <input name="watsap_url" value="{{old('name')??$get->watsap_url}}" type="text" class="form-control" id="exampleInputName1" placeholder="Ватсап" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Телеграм</label>
                                    <input name="telegram_url" value="{{old('name')??$get->telegram_url}}" type="text" class="form-control" id="exampleInputName1" placeholder="Телеграм" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Эл.почта</label>
                                    <input name="footer_email" value="{{old('name')??$get->footer_email}}" type="text" class="form-control" id="exampleInputName1" placeholder="Телеграм" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Номер телефона в футере</label>
                                    <input name="footer_phone" value="{{old('name')??$get->footer_phone}}" type="text" class="form-control" id="exampleInputName1" placeholder="Номер телефона в футере" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Адрес в футере</label>
                                    <input name="footer_address" value="{{old('name')??$get->footer_address}}" type="text" class="form-control" id="exampleInputName1" placeholder="Адрес в футере" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Информация о нас</label>
                                    <textarea name="info_o_nas"  type="text" class="form-control" id="exampleInputName1" placeholder="Информация о нас" required>{{old('name')??$get->info_o_nas}}</textarea>
                                </div>

                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between">
                                    <label for="exampleInputName1">ПОЛИТИКА  КОНФИДЕНЦИАЛЬНОСТИ</label>
                                    <label for=""><a target="_blank" href="{{$get->policy_file_url}}">Ссылка на файл</a> </label>
                                    </div>
                                    <input name="file_pdf"  accept="application/pdf,application/vnd.ms-excel"  type="file" class="form-control" id="exampleInputName1" placeholder="Информация о нас">
                                </div>
                                <div class="form-group">

                                            <button type="submit" class="btn btn-inverse-success btn-fw">Редактировать</button>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
