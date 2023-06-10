@extends('admin.layouts.default')
@section('title')
     заказ
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
</style>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row ">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between">
                                <h4 class="card-title"> заказ</h4>
                                {{--                                <a href="" class="btn btn-inverse-warning btn-fw createButton">Добавить новую категорию</a>--}}
                            </div>
                            <div class="card text-white bg-dark mb-3" style="max-width: auto">
                                <div class="card-header">Детали заказа  &nbsp; &nbsp;   <span style="color: #2f5687 !important;">{{$get->order_id}}</span></div>
                                <div class="card-body">

                                    @if(auth()->user()->role_id == 1)
                                    <p class="card-text">Пользователь  ` <a href="{{route('app_user_single_page',$get->user->id)}}">{{$get->user->name}}</a> </p>
                                    @endif
                                    <p class="card-text">Имя` {{$get->name}}</p>
                                    <p class="card-text">Номер Телефона` {{$get->phone}}</p>
                                    <p class="card-text">Эл.почта` {{$get->email}}</p>
                                        @if($get->user_bonus > 0)
                                            <p class="card-text"> Есть скидка  на {{$get->user_bonus}}</p>
                                        @endif
                                        @if(auth()->user()->role_id == 1)
                                            <?php $all_summ =  $get->OrderProduct ?>
                                            @else
                                        <?php $all_summ =  $get->OrderProduct->where('shop_id', auth()->user()->id) ?>
                                        @endif
                                            <?php $sum = 0 ?>
                                        @foreach($all_summ  as $summs)
                                               <?php $sum  +=  $summs['product']['price'] * $summs['count'] ?>
                                            @endforeach
                                    <p class="card-text">Общая  сумма заказа ՝ {{$sum}} @if($get->user_bonus > 0), Цена со скидкой <span style="color: red">{{$sum - explode('.', $sum * $get->user_bonus / 100)[0]}} </span> @endif</p>
                                </div>
                            </div>

                            <h2 style="display: flex; justify-content: center;">Товары в заказе</h2>
                            <br><br>
                        <div style="display: flex; gap: 40px; flex-wrap: wrap;">

                            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
                            @foreach($get->OrderProduct as $product)


                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{asset('uploads/'.$product->product->photo[0]->photo)}}" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Тип товара ` {{$product->product->category->name}}</p>
                                    <p class="card-text">Название товара ` {{$product->product->name}}</p>
                                    <p class="card-text">Цена товара ` {{$product->product->price}}</p>
                                    <p class="card-text">Количество в заказе` {{$product->count}}</p>
                                    <p class="card-text">Магазин` {{$product->Shop->name}}</p>
                                </div>
                            </div>
                                @endforeach
                            @else

                                @foreach($get->OrderProduct->where('shop_id', auth()->user()->id) as $product)
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" src="{{asset('uploads/'.$product->product->photo[0]->photo)}}" alt="Card image cap">
                                        <div class="card-body">
                                            <p class="card-text">Название товара ` {{$product->product->name}}</p>
                                            <p class="card-text">Количество в заказе` {{$product->count}}</p>
                                            <p class="card-text">Магазин` {{$product->Shop->name}}</p>
                                        </div>
                                    </div>
                                @endforeach
                                    @endif
                        </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            @if($get->status == 1)
                            <a class="btn btn-inverse-success btn-fw" href="{{route('success_new_shop', $get->id)}}">Передать в магазины</a>
                            @endif
                            @if($get->status == 3)
                                <p class="btn btn-inverse-success btn-fw" >Передан </p>

                            @endif

                            @if(auth()->user()->role_id == 2)
                                @if($get->status == 2)
                                <a class="btn btn-inverse-success btn-fw" href="{{route('ShowNewShopDetailSuccess', $get->id)}}">Передан пользвателю</a>
                                @endif
                                @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
