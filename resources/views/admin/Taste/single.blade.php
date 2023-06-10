@extends('admin.layouts.default')
@section('title')
    Новый вкус
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
                    <strong>Поздравляю</strong>  Добавление вкуса  завершено
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
                            <form class="forms-sample" enctype="multipart/form-data" action="{{route('update_taste')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Название</label>
                                    <input type="hidden" name="taste_id" value="{{$getTaste->id}}">
                                    <input name="name" value="{{$getTaste->name}}" type="text" class="form-control" id="exampleInputName1" placeholder="Название" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div style="width: 30%">
                                    <h3 style="color: #1f4287">Подключённые категории</h3>
                                    @foreach($getcategory2 as $getcategory22)
                                    <p style="border: 1px solid #1f4287; display: flex; padding: 3px; justify-content: space-between">{{$getcategory22->name}}<a  style="color: red" href="{{route('delete_category_from_taste',[$getcategory22->id,$getTaste->id])}}">Удалить</a></p>
                                        @endforeach
                                </div>
                                <br>
                                <br>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Категория</label>
                                    <div class="col-sm-9">
                                        <select style="    height: 254px;" name="category_id[]" multiple class="form-control">
                                            @foreach($getcategory as$gets)
                                                <option value="{{$gets->id}}">{{$gets->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div style="width: 30%">
                                    <h4 style="color: #1f4287">Подключённые Производители</h4>
                                    @foreach($getSubCategory2 as $getcategory22)
                                        <p style="border: 1px solid #1f4287; display: flex; padding: 3px; justify-content: space-between">{{$getcategory22->name}} <a  style="color: red" href="{{route('delete_made_in_from_taste',[$getcategory22->id,$getTaste->id])}}">Удалить</a></p>
                                    @endforeach
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Производители</label>
                                    <div class="col-sm-9">
                                        <select style="    height: 254px;" name="made_in_id[]" multiple class="form-control">
                                            @foreach($getSubCategory as$get_made_ins)
                                                <option value="{{$get_made_ins->id}}">{{$get_made_ins->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style=" display: flex; justify-content: space-between;">
                                    <button type="submit" class="btn btn-inverse-success btn-fw">Редактировать</button>
                                    <a href="{{route('delete_taste', $getTaste->id)}}" class="btn btn-outline-danger btn-fw">Удалить</a>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
