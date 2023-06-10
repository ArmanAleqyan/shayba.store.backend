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
                                <h4 class="card-title">Создание категории</h4>
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="display: flex;      height: fit-content;" type="button" class="btn btn-outline-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i> Назад </a>
                            </div>
                            <form class="forms-sample" enctype="multipart/form-data" action="{{route('add_new_category')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Название</label>
                                    <input name="name" value="{{old('name')}}" type="text" class="form-control" id="exampleInputName1" placeholder="Название" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div>
                                        <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="" alt="Обязательно выберите фотографию для категории" id="blahas">
                                        <br>
                                        <input required  accept="image/*" style="display: none" name="photo" id="file-logos" class="btn btn-outline-success" type="file">
                                        <br>
                                        <div style="display: flex; justify-content: space-between">
                                        <label style="width: 200px" for="file-logos" class="custom-file-upload btn btn-outline-success">
                                            Выбрать
                                        </label>
                                        <button type="submit" class="btn btn-inverse-success btn-fw">Создать</button>
                                        </div>
                                    </div>
                                    <br><br><br><br>
                                    <br><br><br>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
