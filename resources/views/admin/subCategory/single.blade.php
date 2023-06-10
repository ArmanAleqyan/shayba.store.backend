@extends('admin.layouts.default')
@section('title')
    Создание категории
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
                    <strong>Поздравляю</strong>  Добавление  завершено
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                @if(session('updated'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Поздравляю</strong>  Редактирование успешно завершено
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
                                <h4 class="card-title">Редактирование</h4>
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="display: flex;      height: fit-content;" type="button" class="btn btn-outline-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i> Назад </a>
                            </div>
                            <form class="forms-sample" enctype="multipart/form-data" action="{{route('update_sub_category')}}" method="post">
                                @csrf
                                <input type="hidden" name="sub_id" value="{{$get->id}}">
                                <div class="form-group">
                                    <label for="exampleInputName1">Название</label>
                                    <input name="name" value="{{$get->name}}" type="text" class="form-control" id="exampleInputName1" placeholder="Название" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="" style="width: 30%;">
                                    <h3 style="color: #2f5687">Подключенные типы</h3>
                                @foreach($getCategory2 as $gets2)
                                    <span  >{{$gets2->name}}</span> &nbsp;&nbsp;&nbsp; <a style="color: red" href="{{route('delete_category_id_from_made_in',[$gets2->id,$get->id])}}">Удалить</a> <br>
                                @endforeach
                                </div>
                                <br>
                                <br>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Другие типы продуктов</label>
                                    <div class="col-sm-9">
                                        <select name="category_id[]" multiple class="form-control selectpicker" >
                                            @foreach($getCategory as $gets)
                                                    <option  value="{{$gets->id}}">{{$gets->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{--                                    <div>--}}
                                    {{--                                        <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="" alt="Обязательно выберите фотографию для категории" id="blahas">--}}
                                    {{--                                        <br>--}}
                                    {{--                                        <input required  accept="image/*" style="display: none" name="photo" id="file-logos" class="btn btn-outline-success" type="file">--}}
                                    {{--                                        <br>--}}
                                    {{--                                        <div style="display: flex; justify-content: space-between">--}}
                                    {{--                                            <label style="width: 200px" for="file-logos" class="custom-file-upload btn btn-outline-success">--}}
                                    {{--                                                Выбрать--}}
                                    {{--                                            </label>--}}
                                    {{--                                          --}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <br><br><br><br>--}}
                                    {{--                                    <br><br><br>--}}
                                    <div style=" display: flex; justify-content: space-between;">
                                    <button type="submit" class="btn btn-inverse-success btn-fw">Редактировать</button>
                                    <a href="{{route('delete_sub_category', $get->id)}}" class="btn btn-outline-danger btn-fw">Удалить</a>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
