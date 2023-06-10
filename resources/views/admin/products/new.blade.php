@extends('admin.layouts.default')
@section('title')
   Новый продукт
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
                                <h4 class="card-title"> Новый продукт</h4>
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}" style="display: flex;      height: fit-content;" type="button" class="btn btn-outline-warning btn-icon-text">
                                    <i class="mdi mdi-reload btn-icon-prepend"></i> Назад </a>
                            </div>
                            <form class="forms-sample" enctype="multipart/form-data" id="uploadForm" method="post">
                                @csrf
                                <br>
                                <div class="form-group">
                                    <label for="">Тип Продукта</label>
                                    <select id="mySelect" class="form-control" name="category_id"  style="    color: white;">
                                        <option value="1" >Другой</option>
                                        @foreach($get_category as $cat)
                                        <option value="{{$cat->id}}" >{{$cat->name}}</option>
                                            @endforeach
                                    </select>

                                    <br>
                                </div>
                                <div class="form-group made_in deleted" style="display: none;">
                                    <label for="">Производитель</label>
                                    <select  class="form-control" name="made_in_id" style="    color: white;">
                                        <option value="1" >Другой</option>
                                        @foreach($get_made_id as $cat)
                                        <option value="{{$cat->id}}" >{{$cat->name}}</option>
                                            @endforeach
                                    </select>

                                    <br>
                                </div>
                                <div class="form-group taste deleted" style="display: none">
                                    <label for="">Вкус</label>
                                    <div class="searchable-select">
                                        <input type="text" class=" form-control search " placeholder="Поиск Вкуса">
                                        <select multiple class="form-control" name="taste_id" style="color: white; height: 155px;">
                                            @foreach($get_taste as $caat)

                                                <option value="{{$caat->id}}">{{$caat->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
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
                                    <input name="name" value="{{old('name')}}" type="text" class="form-control" id="exampleInputName1" placeholder="Название" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Цена</label>
                                    <input name="price" value="{{old('price')}}" type="number" class="form-control" id="exampleInputName1" placeholder="1000" required>
                                    @if($errors->has('price'))
                                        <div class="error">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Артикул</label>
                                    <input name="art" value="{{old('art')}}" type="text" class="form-control" id="exampleInputName1" placeholder="Артикул" required>
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('art') }}</div>
                                    @endif
                                </div>
                                <div class="form-group volume deleted" style="display: none">
                                    <label for="exampleInputName1">Объем ml</label>
                                    <input  name="volume" value="{{old('volume')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="ml" >
                                    @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('volume') }}</div>
                                    @endif
                                </div>
                                <div class="form-group strength deleted" style="display: none;">
                                    <label for="exampleInputName1">Крепкость(%) </label>
                                    <input name="strength" value="{{old('strength')}}" type="number" class="form-control deletedInput" id="exampleInputName1" placeholder="2">
                                    @if($errors->has('strength'))
                                        <div class="error">{{ $errors->first('strength') }}</div>
                                    @endif
                                </div>
                                <div class="form-group puffs_count deleted" style="display: none">
                                    <label for="exampleInputName1">Количество затяжек</label>
                                    <input name="puffs_count" value="{{old('puffs_count')}}" type="number" class="form-control deletedInput" id="exampleInputName1" placeholder="1200">
                                    @if($errors->has('puffs_count'))
                                        <div class="error">{{ $errors->first('puffs_count') }}</div>
                                    @endif
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputName1">Количество в наличии</label>
                                    <input name="count" value="{{old('count')}}" type="number" class="form-control" id="exampleInputName1" placeholder="1200" >
                                    @if($errors->has('count'))
                                        <div class="error">{{ $errors->first('count') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Код в магазине</label>
                                    <input name="shop_id" value="{{old('shop_id')}}" type="text" class="form-control" id="exampleInputName1" placeholder="1200">
                                    @if($errors->has('shop_id'))
                                        <div class="error">{{ $errors->first('shop_id') }}</div>
                                    @endif
                                </div>
                                <div class="form-group output_power deleted" style="display: none">
                                    <label for="exampleInputName1">Выходная мощность</label>
                                    <input name="output_power" value="{{old('output_power')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Выходная мощность">
                                    @if($errors->has('output_power'))
                                        <div class="error">{{ $errors->first('output_power') }}</div>
                                    @endif
                                </div>
                                <div class="form-group evaporator_resistance deleted" style="display: none">
                                    <label for="exampleInputName1">Сопротивление испарителей</label>
                                    <input name="evaporator_resistance" value="{{old('evaporator_resistance')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Сопротивление испарителей">
                                    @if($errors->has('evaporator_resistance'))
                                        <div class="error">{{ $errors->first('evaporator_resistance') }}</div>
                                    @endif
                                </div>
                                <div class="form-group cartridge_volume deleted" style="display: none">
                                    <label for="exampleInputName1">Объем картриджа</label>
                                    <input name="cartridge_volume" value="{{old('cartridge_volume')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Объем картриджа">
                                    @if($errors->has('cartridge_volume'))
                                        <div class="error">{{ $errors->first('cartridge_volume') }}</div>
                                    @endif
                                </div>


                                <div class="form-group battery_capacity deleted" style="display: none">
                                    <label for="exampleInputName1">Емкость аккумулятора</label>
                                    <input name="battery_capacity" value="{{old('battery_capacity')}}" type="text" class="form-control deletedInput"  id="exampleInputName1" placeholder="Емкость аккумулятора">
                                    @if($errors->has('battery_capacity'))
                                        <div class="error">{{ $errors->first('battery_capacity') }}</div>
                                    @endif
                                </div>

                                <div class="form-group equipment deleted" style="display: none">
                                    <label for="exampleInputName1">Комплектация</label>
                                    <input name="equipment" value="{{old('equipment')}}" type="text" class="form-control deletedInput" id="exampleInputName1 " placeholder="Комплектация">
                                    @if($errors->has('equipment'))
                                        <div class="error">{{ $errors->first('equipment') }}</div>
                                    @endif
                                </div>
                                <div class="form-group screen deleted" style="display: none">
                                    <label for="exampleInputName1">Экран</label>
                                    <input name="screen" value="{{old('screen')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Экран">
                                    @if($errors->has('screen'))
                                        <div class="error">{{ $errors->first('screen') }}</div>
                                    @endif
                                </div>

                                <div class="form-group size deleted" style="display: none">
                                    <label for="exampleInputName1">Размер</label>
                                    <input name="size" value="{{old('size')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Размер">
                                    @if($errors->has('size'))
                                        <div class="error">{{ $errors->first('size') }}</div>
                                    @endif
                                </div>


                                <div class="form-group capacity deleted" style="display: none">
                                    <label for="exampleInputName1">Емкость</label>
                                    <input name="capacity" value="{{old('capacity')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Емкость">
                                    @if($errors->has('capacity'))
                                        <div class="error">{{ $errors->first('capacity') }}</div>
                                    @endif
                                </div>

                                <div class="form-group marking deleted" style="display: none">
                                    <label for="exampleInputName1">Маркировка</label>
                                    <input name="marking" value="{{old('marking')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Маркировка">
                                    @if($errors->has('marking'))
                                        <div class="error">{{ $errors->first('marking') }}</div>
                                    @endif
                                </div>


                                <div class="form-group replacement_coils deleted" style="display: none">
                                    <label for="exampleInputName1">Сменные испарители</label>
                                    <input name="replacement_coils" value="{{old('replacement_coils')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Сменные испарители">
                                    @if($errors->has('replacement_coils'))
                                        <div class="error">{{ $errors->first('replacement_coils') }}</div>
                                    @endif
                                </div>
                                <div class="form-group maximum_power deleted" style="display: none">
                                    <label for="exampleInputName1">Максимальная мощность</label>
                                    <input name="maximum_power" value="{{old('maximum_power')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Максимальная мощность">
                                    @if($errors->has('maximum_power'))
                                        <div class="error">{{ $errors->first('maximum_power') }}</div>
                                    @endif
                                </div>

                                <div class="form-group battery_type deleted" style="display: none">
                                    <label for="exampleInputName1">Тип аккумулятора</label>
                                    <input name="battery_type" value="{{old('battery_type')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Тип аккумулятора">
                                    @if($errors->has('battery_type'))
                                        <div class="error">{{ $errors->first('battery_type') }}</div>
                                    @endif
                                </div>



                                <div class="form-group resistance deleted" style="display: none;">
                                    <label for="exampleInputName1">Сопротивление</label>
                                    <input name="resistance" value="{{old('resistance')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Сопротивление">
                                    @if($errors->has('resistance'))
                                        <div class="error">{{ $errors->first('resistance') }}</div>
                                    @endif
                                </div>
                                <div class="form-group manufacturers_recommended_power deleted" style="display: none;">
                                    <label for="exampleInputName1">Рекомендуемая производителем мощность</label>
                                    <input name="manufacturers_recommended_power" value="{{old('manufacturers_recommended_power')}}" type="text" class="form-control deletedInput" id="exampleInputName1" placeholder="Рекомендуемая производителем мощность">
                                    @if($errors->has('manufacturers_recommended_power'))
                                        <div class="error">{{ $errors->first('manufacturers_recommended_power') }}</div>
                                    @endif
                                </div>
                                <div class="form-group which_device_is_suitable_for_this_vaporizer deleted" style="display: none;">
                                    <label for="exampleInputName1">На какое устройство подойдет данный испаритель </label>
                                    <input name="which_device_is_suitable_for_this_vaporizer" value="{{old('which_device_is_suitable_for_this_vaporizer')}}" type="text" class="deletedInput form-control" id="exampleInputName1" placeholder="На какое устройство подойдет данный испаритель">
                                    @if($errors->has('which_device_is_suitable_for_this_vaporizer'))
                                        <div class="error">{{ $errors->first('which_device_is_suitable_for_this_vaporizer') }}</div>
                                    @endif
                                </div>

                                <div class="form-group rechargeable deleted" style="display: none">
                                    <label for="">Перезаряжаемая или нет</label>
                                    <select  class="form-control" name="rechargeable"  style="    color: white;">
                                        <option value="Нет" >Нет</option>
                                        <option value="Да" >Да</option>
                                    </select>

                                    <br>
                                </div>

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
                                                    $("#newDivqwe").append(`
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
                                    <div id="newDivqwe"></div>
                                </div>
                                <div class="form-group">
                                <label class="btn btn-outline-warning" for="file">Выберете фотографии</label>
                                <input style="display: none" type="file"  id="file" accept="image/*" multiple >
                                </div>




                                <script>
                                    $(document).ready(function () {
                                        $("#uploadForm").submit(function (event) {

                                            event.preventDefault();
                                            let name = $('[name="name"]').val();
                                            let category_id = $('[name="category_id"]').val();
                                            let made_in_id = $('[name="made_in_id"]').val();
                                            let taste_id = $('[name="taste_id"]').val();
                                            let art = $('[name="art"]').val();
                                            let strength = $('[name="strength"]').val();
                                            let puffs_count = $('[name="puffs_count"]').val();
                                            let count = $('[name="count"]').val();
                                            let shop_id = $('[name="shop_id"]').val();
                                            let price = $('[name="price"]').val();

                                            let volume = $('[name="volume"]').val();
                                            let rechargeable = $('[name="rechargeable"]').val();
                                            let resistance = $('[name="resistance"]').val();
                                            let which_device_is_suitable_for_this_vaporizer = $('[name="manufacturers_recommended_power"]').val();
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

                                            let formData = new FormData();
                                            let DataArrayLenght = DataArray.length;
                                            if(DataArrayLenght  < 1){
                                                alert('Обязательно выберите фотографию для товара')
                                            }else{
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

                                                url: "{{route('create_product')}}",
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
                                                         alert('Товар Успешно добавлен')
                                                        setTimeout(function() {
                                                            window.location.replace('https://admin.shayba.store/admin/add_product');
                                                        }, 1000);
                                                    }
                                                },
                                                // error: function (xhr, textStatus, errorThrown) {
                                                //     console.log('Error:', errorThrown);
                                                // }
                                            });
                                            }
                                        });
                                    });
                                </script>




                                <button type="submit" class="btn btn-inverse-success btn-fw">Добавить</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
