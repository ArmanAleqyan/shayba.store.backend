@extends('admin.layouts.default')
@section('title')
    Создание слайдера
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
                    <strong>Поздравляю</strong>  Добавление слайдера завершено
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
                                <h4 class="card-title"> Создание слайдера</h4>
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="display: flex;      height: fit-content;" type="button" class="btn btn-outline-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i> Назад </a>
                            </div>
                            <form class="forms-sample" enctype="multipart/form-data" action="{{route('create_slider')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Загаловок</label>
                                    <input name="title" value="{{old('title')}}" type="text" class="form-control" id="exampleInputName1" placeholder="Загаловок" required>
                                    @if($errors->has('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Под загаловок</label>
                                    <input name="sub_title" value="{{old('sub_title')}}" type="text" class="form-control" id="exampleInputName1" placeholder="Под загаловок" required>
                                    @if($errors->has('title'))
                                        <div class="error">{{ $errors->first('sub_title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Описание</label>
                                    <textarea style="color: white !important;" name="description" value="{{old('description')}}" type="text" class="form-control" id="exampleInputName1" placeholder="Описание" required></textarea>
                                    @if($errors->has('description'))
                                        <div class="error">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Очередь</label>

                                            <select style="color: white !important;" name="order_by" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                            </select>

                                </div>



                                <div class="form-group">
                                    <div>
                                        <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="" alt="Не  обязательно выберать фотографию для слайдера" id="blahas">
                                        <br>
                                        <input   accept="image/*" style="display: none" name="photo" id="file-logos" class="btn btn-outline-success" type="file">
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
