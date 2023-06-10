@extends('admin.layouts.default')
@section('title')
    Редактировать продукт
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


            @if(session('closed'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Товар снят  с продажы</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

                @if(session('opened'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Поздравляю </strong> Товар вернулся в продаж
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
                                <h4 class="card-title"> Редактирование продукта</h4>
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="display: flex;      height: fit-content;" type="button" class="btn btn-outline-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i> Назад </a>
                            </div>
                            <form class="forms-sample" enctype="multipart/form-data" id="uploadForm" method="post">
                                @csrf
                                <br>
                                <div class="form-group">
                                    <label for="">Тип Продукта</label>
                                    <select disabled  class="form-control" name="category_id" required style="    color: black;">
                                        @foreach($get_category as $cat)
                                            @if($get->category_id == $cat->id)
                                                <option selected value="{{$cat->id}}" >{{$cat->name}}</option>
                                            @else
                                                <option value="{{$cat->id}}" >{{$cat->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    <br>
                                </div>
                                @if(isset($get->made_in_id))
                                <div class="form-group">
                                    <label for="">Производитель</label>
                                    <select class="form-control" name="made_in_id" style="    color: white;" required>
                                        @foreach($get_made_id as $cat)
                                            @if($get->made_in_id == $cat->id)
                                                <option selected value="{{$cat->id}}" >{{$cat->name}}</option>
                                            @else
                                                <option value="{{$cat->id}}" >{{$cat->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    <br>
                                </div>
                                @endif
                                @if(isset($get->taste_id) )
                                <div class="form-group">
                                    <label for="">Вкус</label>
                                    <select  class="form-control" name="taste_idert" style="color: white" required>
                                        @foreach($get_taste as $caat)
                                            @if($get->taste_id == $caat->id)
                                                <option selected value="{{$caat->id}}">{{$caat->name}}</option>
                                            @else

                                                <option value="{{$caat->id}}">{{$caat->name}}</option>

                                            @endif
                                        @endforeach
                                    </select>

                                    <br>
                                </div>
                                @endif
                                <script>
                                    $(document).ready(function() {
                                        // Listen for keyup event on the search input
                                        $('.searchable-select .search').on('keyup', function() {
                                            var searchText = $(this).val().toLowerCase();

                                            // Loop through each option in the select element
                                            $('.searchable-select select option').each(function() {
                                                var optionText = $(this).text().toLowerCase();

                                                if (optionText.indexOf(searchText) >= 0) {
                                                    $(this).show();
                                                } else {
                                                    $(this).hide();
                                                }
                                            });
                                        });
                                    });

                                </script>

                                <div class="form-group">
                                    <label for="exampleInputName1">Название</label>
                                    <input name="name" value="{{$get->name}}" type="text" class="form-control" id="exampleInputName1" placeholder="Название" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Цена</label>
                                    <input name="price" value="{{(int)$get->price}}" type="number" class="form-control" id="exampleInputName1" placeholder="1000" required>
                                    @if($errors->has('price'))
                                        <div class="error">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Артикул</label>
                                    <input name="art" value="{{$get->art}}" type="text" class="form-control" id="exampleInputName1" placeholder="Артикул">
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('art') }}</div>
                                    @endif
                                </div>
                                @if(isset($get->strength))
                                <div class="form-group">
                                    <label for="exampleInputName1">Крепкость(%)</label>
                                    <input name="strength" value="{{(int)$get->strength}}" type="number" class="form-control" id="exampleInputName1" placeholder="2">
                                    @if($errors->has('strength'))
                                        <div class="error">{{ $errors->first('strength') }}</div>
                                    @endif
                                </div>
                                @endif

                                @if(isset($get->puffs_count))
                                <div class="form-group">
                                    <label for="exampleInputName1">Количество затяжек</label>
                                    <input name="puffs_count" value="{{$get->puffs_count}}" type="number" class="form-control" id="exampleInputName1" placeholder="1200" >
                                    @if($errors->has('puffs_count'))
                                        <div class="error">{{ $errors->first('puffs_count') }}</div>
                                    @endif
                                </div>
                                @endif
                                <input type="hidden" value="{{$get->id}}" name="product_id">
                                <div class="form-group">
                                    <label for="exampleInputName1">Количество в наличии</label>
                                    <input name="count" value="{{(int)$get->count}}" type="number" class="form-control" id="exampleInputName1" placeholder="1200" required>
                                    @if($errors->has('count'))
                                        <div class="error">{{ $errors->first('count') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Код в магазине</label>
                                    <input name="shop_id" value="{{$get->shop_id}}" type="text" class="form-control" id="exampleInputName1" placeholder="1200" >
                                    @if($errors->has('shop_id'))
                                        <div class="error">{{ $errors->first('shop_id') }}</div>
                                    @endif
                                </div>

                                @if($get->volume != null)
                                    <div class="form-group volume deleted" >
                                        <label for="exampleInputName1">Объем ml</label>
                                        <input  name="volume" value="{{$get->volume}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="ml" >
                                        @if($errors->has('name'))
                                            <div class="error">{{ $errors->first('volume') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                @if($get->strength != null)

                                    <div class="form-group strength deleted" >
                                        <label for="exampleInputName1">Крепкость(%)</label>
                                        <input  name="strength" value="{{$get->strength}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="ml" >
                                        @if($errors->has('strength'))
                                            <div class="error">{{ $errors->first('strength') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                @if($get->puffs_count != null)

                                    <div class="form-group puffs_count deleted" >
                                        <label for="exampleInputName1">Количество затяжек</label>
                                        <input  name="puffs_count" value="{{$get->puffs_count}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Количество затяжек" >
                                        @if($errors->has('puffs_count'))
                                            <div class="error">{{ $errors->first('puffs_count') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                @if($get->output_power != null)

                                    <div class="form-group output_power deleted" >
                                        <label for="exampleInputName1">Выходная мощность</label>
                                        <input  name="output_power" value="{{$get->output_power}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Выходная мощность" >
                                        @if($errors->has('output_power'))
                                            <div class="error">{{ $errors->first('output_power') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                @if($get->evaporator_resistance != null)
                                    <div class="form-group evaporator_resistance deleted" >
                                        <label for="exampleInputName1">Сопротивление испарителей</label>
                                        <input  name="evaporator_resistance" value="{{$get->evaporator_resistance}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Сопротивление испарителей" >
                                        @if($errors->has('evaporator_resistance'))
                                            <div class="error">{{ $errors->first('evaporator_resistance') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->cartridge_volume != null)
                                    <div class="form-group cartridge_volume deleted" >
                                        <label for="exampleInputName1">Объем картриджа</label>
                                        <input  name="cartridge_volume" value="{{$get->cartridge_volume}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Объем картриджа" >
                                        @if($errors->has('cartridge_volume'))
                                            <div class="error">{{ $errors->first('cartridge_volume') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->battery_capacity != null)
                                    <div class="form-group battery_capacity deleted" >
                                        <label for="exampleInputName1">Емкость аккумулятора</label>
                                        <input  name="battery_capacity" value="{{$get->battery_capacity}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Емкость аккумулятора" >
                                        @if($errors->has('battery_capacity'))
                                            <div class="error">{{ $errors->first('battery_capacity') }}</div>
                                        @endif
                                    </div>
                                    @endif

                                     @if($get->equipment != null)
                                    <div class="form-group equipment deleted" >
                                        <label for="exampleInputName1">Комплектация</label>
                                        <input  name="equipment" value="{{$get->equipment}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Комплектация" >
                                        @if($errors->has('equipment'))
                                            <div class="error">{{ $errors->first('equipment') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->screen != null)
                                    <div class="form-group screen deleted" >
                                        <label for="exampleInputName1">Экран</label>
                                        <input  name="screen" value="{{$get->screen}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Экран" >
                                        @if($errors->has('screen'))
                                            <div class="error">{{ $errors->first('screen') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->size != null)
                                    <div class="form-group size deleted" >
                                        <label for="exampleInputName1">Размер</label>
                                        <input  name="size" value="{{$get->size}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Размер" >
                                        @if($errors->has('size'))
                                            <div class="error">{{ $errors->first('size') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->capacity != null)
                                    <div class="form-group capacity deleted" >
                                        <label for="exampleInputName1">Емкость</label>
                                        <input  name="capacity" value="{{$get->capacity}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Емкость" >
                                        @if($errors->has('capacity'))
                                            <div class="error">{{ $errors->capacity('capacity') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->marking != null)
                                    <div class="form-group marking deleted" >
                                        <label for="exampleInputName1">Маркировка</label>
                                        <input  name="marking" value="{{$get->marking}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Маркировка" >
                                        @if($errors->has('marking'))
                                            <div class="error">{{ $errors->capacity('marking') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->replacement_coils != null)
                                    <div class="form-group replacement_coils deleted" >
                                        <label for="exampleInputName1">Сменные испарители</label>
                                        <input  name="replacement_coils" value="{{$get->replacement_coils}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Сменные испарители" >
                                        @if($errors->has('replacement_coils'))
                                            <div class="error">{{ $errors->capacity('replacement_coils') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->maximum_power != null)
                                    <div class="form-group maximum_power deleted" >
                                        <label for="exampleInputName1">Максимальная мощность</label>
                                        <input  name="maximum_power" value="{{$get->maximum_power}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Максимальная мощность" >
                                        @if($errors->has('maximum_power'))
                                            <div class="error">{{ $errors->capacity('maximum_power') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->battery_type != null)
                                    <div class="form-group battery_type deleted" >
                                        <label for="exampleInputName1">Тип аккумулятора</label>
                                        <input  name="battery_type" value="{{$get->battery_type}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Тип аккумулятора" >
                                        @if($errors->has('battery_type'))
                                            <div class="error">{{ $errors->capacity('battery_type') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                     @if($get->resistance != null)
                                    <div class="form-group resistance deleted" >
                                        <label for="exampleInputName1">Сопротивление</label>
                                        <input  name="resistance" value="{{$get->resistance}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Сопротивление" >
                                        @if($errors->has('resistance'))
                                            <div class="error">{{ $errors->capacity('resistance') }}</div>
                                        @endif
                                    </div>
                                    @endif

                                     @if($get->manufacturers_recommended_power != null)
                                    <div class="form-group manufacturers_recommended_power deleted" >
                                        <label for="exampleInputName1">Рекомендуемая производителем мощность</label>
                                        <input  name="manufacturers_recommended_power" value="{{$get->manufacturers_recommended_power}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Рекомендуемая производителем мощность" >
                                        @if($errors->has('manufacturers_recommended_power'))
                                            <div class="error">{{ $errors->capacity('manufacturers_recommended_power') }}</div>
                                        @endif
                                    </div>
                                    @endif

                                     @if($get->which_device_is_suitable_for_this_vaporizer != null)
                                    <div class="form-group which_device_is_suitable_for_this_vaporizer deleted" >
                                        <label for="exampleInputName1">На какое устройство подойдет данный испаритель </label>
                                        <input  name="which_device_is_suitable_for_this_vaporizer" value="{{$get->which_device_is_suitable_for_this_vaporizer}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="На какое устройство подойдет данный испаритель " >
                                        @if($errors->has('which_device_is_suitable_for_this_vaporizer'))
                                            <div class="error">{{ $errors->capacity('which_device_is_suitable_for_this_vaporizer') }}</div>
                                        @endif
                                    </div>
                                    @endif

                                     @if($get->rechargeable != null)
                                    <div class="form-group rechargeable deleted" >
                                        <label for="">Перезаряжаемая или нет</label>
                                        <select  class="form-control" name="rechargeable"  style="    color: white;">
                                            @if($get->rechargeable == 'Нет')
                                                <option value="Нет" >Нет</option>
                                                <option value="Да" >Да</option>
                                                @else
                                                <option value="Да" >Да</option>
                                                <option value="Нет" >Нет</option>
                                            @endif
                                        </select>

                                        <br>
                                    </div>

                                @endif

                                <br>
                                <style>
                                    .ixsButton::before {
                                        content: '\2715';
                                        position: absolute;
                                        top: -6px;
                                        right: -140px;
                                        color: #f30c0c;
                                        font-size: large;
                                        color: red;
                                        font-weight: bold;
                                    }
                                    .ixsButton2::before {
                                        content: '\2715';
                                        position: absolute;
                                        top: -6px;
                                        right: -151px;
                                        color: #f30c0c;
                                        font-size: large;
                                        color: red;
                                        font-weight: bold;
                                    }
                                    .PhotoDiv{
                                        padding: 10px;
                                    }
                                    #newDivqwe{
                                        display: flex;
                                        justify-content: center;
                                        margin: 20px 0;
                                        gap: 20px;
                                        flex-wrap: wrap;

                                    }
                                </style>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
                                <script>
                                    let DataArray = [];
                                    $(document).ready(function () {
                                        $("#file").on('change keyup paste', function () {

                                            var numFiles = $('input[type="file"]')[0].files.length;
                                            let allUndefined = DataArray;
                                            let myArray = DataArray;
                                            let filteredArray = myArray.filter(item => item !== undefined);
                                            let allLenght = numFiles + filteredArray.length;

                                            $("#comment").attr("disabled", 'disabled');
                                            $("#comment").css("display", 'none');
                                            var file = $('input[type="file"]')[0].files.length;
                                            let time =  $.now();
                                            for (var i = 0; i < file; i++) {
                                                let type = $("input[type='file']")[0].files[i].type.split('/')[0]
                                                DataArray.push($("input[type='file']")[0].files[i]);

                                                if (type == 'image') {
                                                    var fileUrl = URL.createObjectURL($("input[type='file']")[0].files[i]);
                                                    $("#newDivqwe").prepend(`
                        <div class="PhotoDiv" style='overflow: visible;position: relative; width: 150px; height: 150px'>
                        <button  class="ixsButton" data-id="${DataArray.length-1}" style='
                                    outline: none;
                                    border: none;
                                position: relative;
                                background-color: transparent;
                                '></button>
                        <img class='sendPhoto' style='width: 150px; height: 150px' src='${fileUrl}'/>
                        </div>`);
                                                } else {
                                                    $("#newDivqwe").append("  " +
                                                        "" +
                                                        "  <div class='PhotoDiv' style='overflow: visible;position: relative; width: 150px; height: 150px'>\n   " +
                                                        "                     <button class=\"ixsButton\" data-id="+`${DataArray.length-1}`+" style='\n                                position: relative;\n                                    outline: none;\n                                    border: none;\n                                position: relative;\n                                '></button>" +
                                                        "<i class=\"fileType fa fa-file fa-3x\" aria-hidden=\"true\"> </i></div>")
                                                }

                                            }




                                            $(".ixsButton").click(function (event) {
                                                event.preventDefault()
                                                let data_id = $(this).attr('data-id')
                                                $(this).parent('.PhotoDiv').hide()
                                                DataArray.splice(data_id,1,undefined)
                                                let data = DataArray;


                                                let allUndefined = true;
                                                $.each(data, function(index, item) {
                                                    if (typeof item !== "undefined") {
                                                        allUndefined = false;
                                                        return false;
                                                    }
                                                });
                                                if (allUndefined) {
                                                    $("#comment").removeAttr("disabled", 'disabled');
                                                    $("#comment").css("display", 'block');
                                                }
                                            })

                                        });
                                    });
                                </script>

                                <div id="imagePreview">
                                    <div id="newDivqwe">
                                        @foreach($get->photo as $photo)
                                            <div class="PhotoDiv" style='overflow: visible;position: relative; width: 150px; height: 150px'>
                                                @if($get->photo->count() >1)
                                                <a href="{{route('delete_photo_product', $photo)}}" type="button"  class="ixsButton2"  style='
                                    outline: none;
                                    border: none;
                                position: relative;
                                background-color: transparent;
                                '></a>
                                                @endif
                                                <img class='sendPhoto' style='width: 150px; height: 150px' src="{{asset('uploads/'.$photo->photo)}}" />
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="btn btn-outline-warning" for="file">Добавить новые фотографии</label>
                                    <input style="display: none" type="file"  id="file" accept="image/*" multiple >
                                </div>



                                <script>
                                    $(document).ready(function() {
                                        $('.ixsButton2').on('click', function(e) {
                                            e.preventDefault(); // prevent default link behavior

                                            var result = confirm('Вы действительно хотите удалить фотографию ?');

                                            if (result) {
                                                window.location = $(this).attr('href'); // follow link
                                            }
                                        });
                                    });
                                    $(document).ready(function () {
                                        $("#uploadForm").submit(function (event) {

                                            event.preventDefault();
                                            let name = $('[name="name"]').val();
                                            let category_id = $('[name="category_id"]').val();
                                            let made_in_id = $('[name="made_in_id"]').val();
                                            let taste_id = $('[name="taste_idert"]').val();
                                            let art = $('[name="art"]').val();
                                            let strength = $('[name="strength"]').val();
                                            let puffs_count = $('[name="puffs_count"]').val();
                                            let count = $('[name="count"]').val();
                                            let shop_id = $('[name="shop_id"]').val();
                                            let price = $('[name="price"]').val();
                                            let product_id = $('[name="product_id"]').val();

                                            let volume = $('[name="volume"]').val();
                                            let rechargeable = $('[name="rechargeable"]').val();
                                            let resistance = $('[name="resistance"]').val();
                                            let manufacturers_recommended_power = $('[name="manufacturers_recommended_power"]').val();
                                            let output_power = $('[name="output_power"]').val();
                                            let evaporator_resistance = $('[name="evaporator_resistance"]').val();
                                            let cartridge_volume = $('[name="cartridge_volume"]').val();
                                            let battery_capacity = $('[name="battery_capacity"]').val();
                                            let equipment = $('[name="equipment"]').val();
                                            let screen = $('[name="screen"]').val();
                                            let replacement_coils = $('[name="replacement_coils"]').val();
                                            let maximum_power = $('[name="maximum_power"]').val();
                                            let battery_type = $('[name="battery_type"]').val();
                                            let size = $('[name="size"]').val();
                                            let capacity = $('[name="capacity"]').val();
                                            let marking = $('[name="marking"]').val();
                                            let which_device_is_suitable_for_this_vaporizer = $('[name="which_device_is_suitable_for_this_vaporizer"]').val();


                                            let formData = new FormData();
                                            let DataArrayLenght = DataArray.length;

                                                for (var i = 0; i < DataArrayLenght; i++) {
                                                    formData.append('file[]', DataArray[i]);
                                                }

                                                formData.append('name', name);
                                                formData.append('category_id', category_id);
                                                formData.append('made_in_id', made_in_id);
                                                formData.append('taste_id', taste_id);
                                                formData.append('art', art);
                                                formData.append('strength', strength);
                                                formData.append('puffs_count', puffs_count);
                                                formData.append('count', count);
                                                formData.append('shop_id', shop_id);
                                                formData.append('price', price);
                                                formData.append('product_id', product_id);
                                                formData.append('volume', volume);
                                                formData.append('rechargeable', rechargeable);
                                                formData.append('resistance', resistance);
                                                formData.append('manufacturers_recommended_power', manufacturers_recommended_power);
                                                formData.append('which_device_is_suitable_for_this_vaporizer', which_device_is_suitable_for_this_vaporizer);
                                                formData.append('output_power', output_power);
                                                formData.append('evaporator_resistance', evaporator_resistance);
                                                formData.append('cartridge_volume', cartridge_volume);
                                                formData.append('battery_capacity', battery_capacity);
                                                formData.append('equipment', equipment);
                                                formData.append('screen', screen);
                                                formData.append('replacement_coils', replacement_coils);
                                                formData.append('maximum_power', maximum_power);
                                                formData.append('battery_type', battery_type);
                                                formData.append('size', size);
                                                formData.append('capacity', capacity);
                                                formData.append('marking', marking);
                                            let timerInterval
                                                Swal.fire({
                                                    // title: 'Auto close alert!',
                                                    // html: 'I will close in <b></b> milliseconds.',
                                                    // timer: 2000,
                                                    timerProgressBar: true,
                                                    didOpen: () => {
                                                        Swal.showLoading()
                                                        const b = Swal.getHtmlContainer().querySelector('b')
                                                        timerInterval = setInterval(() => {
                                                            // b.textContent = Swal.getTimerLeft()
                                                        }, 100)
                                                    },
                                                    willClose: () => {
                                                        clearInterval(timerInterval)
                                                    }
                                                }).then((result) => {
                                                    /* Read more about handling dismissals below */
                                                    if (result.dismiss === Swal.DismissReason.timer) {
                                                        console.log('I was closed by the timer')
                                                    }
                                                })

                                                $.ajax({
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                    },

                                                    url: "{{route('update_product')}}",
                                                    type: 'POST',
                                                    data: formData,
                                                    dataType: "json",
                                                    processData: false,
                                                    contentType: false,
                                                    cache: false,
                                                    encode: true,

                                                    success: function (data) {

                                                        $('.swal2-container').css('display','none')
                                                        if(data.status == true){
                                                            alert('Товар Успешно Редактирован')
                                                            setTimeout(function() {
                                                                window.location.replace('https://admin.shayba.store/admin/product_page/product_id='+data.product_id);
                                                            }, 1000);
                                                        }
                                                    },

                                                });

                                        });
                                    });
                                </script>




                                <div style="display: flex; justify-content: space-between;">
                                    <button type="submit" class="btn btn-inverse-success btn-fw">Редактировать</button>
                            @if($get->status == 1)
                                    <a href="{{route('close_shop', $get->id)}}" class="btn btn-outline-danger btn-fw">Снять с продажи</a>
                                    @else
                                        <a href="{{route('open_shop', $get->id)}}" class="btn btn-outline-success btn-fw">Вернуть в продажу</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
