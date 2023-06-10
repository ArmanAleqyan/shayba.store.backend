<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{csrf_token()}}">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet"
          href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('admin/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/dist/image-uploader.min.css')}} ">

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
          rel="stylesheet">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->

    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('Лого.png')}}"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>


</head>
<body>


@if(auth()->user())

    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 4)

        <div class="container-scroller">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">

                    <a class=" sidebar-brand brand-logo" style="color: white; text-decoration: none;" href="{{route('HomePage')}}">
                        <h3 style="color: #2f5687 !important">Shayba</h3>
                    </a>

                </div>
                <ul class="nav">
                    <li class="nav-item profile">
                        <div class="profile-desc">
                            <div class="profile-pic">
                                <div class="count-indicator">

                                </div>
                                <div class="profile-name">
                                    <h5 class="mb-0 font-weight-normal">{{auth()->user()->name}}</h5>
                                    @if(auth()->user()->role_id == 1)
                                        <span>Администратор </span>
                                    @else
                                        @if(auth()->user()->role_id == 2)
                                            <span>Владелец магазина </span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            {{--                    <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>--}}

                        </div>
                    </li>
                    <li class="nav-item nav-category">
                        <span class="nav-link">Навигация</span>
                    </li>





                            @if(auth()->user()->role_id == 1 )

                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('all_moderators')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                                <span class="menu-title">Модераторы</span>
                            </a>
                        </li>
                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('the_shops')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                                <span class="menu-title">Магазины</span>
                            </a>
                        </li>

                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('all_users')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                                <span class="menu-title">Пользователи</span>
                            </a>
                        </li>




                        <li class="nav-item menu-items">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-account-multiple-plus"></i>
              </span>
                                <span class="menu-title">Категории</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic" style="">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a href="{{route('category')}}" class="nav-link" >Тип продуктов</a></li>
                                    <li class="nav-item"> <a href="{{route('all_sub_category')}}" class="nav-link" >Производители</a></li>
                                    <li class="nav-item"> <a href="{{route('all_taste')}}" class="nav-link" >Вкусы</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('all_slider')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                                <span class="menu-title">Слайдер</span>
                            </a>
                        </li>
                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('ShopDescription')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                                <span class="menu-title">Инфо о нас</span>
                            </a>
                        </li>

                        <li class="nav-item menu-items">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
{{--              <span class="menu-icon">--}}
{{--                <i class="mdi mdi-account-multiple-plus"></i>--}}
{{--              </span>--}}
                                <span class="menu-title">Покупка из магазина &nbsp; <span style="color: #ff5751">{{\App\Models\Order::where('status', 1)->where('order_type', 'Shops')->count()}}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic3" style="">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a href="{{route('new_shops')}}" class="nav-link" >Новые  &nbsp; <span style="color: #ff5751">{{\App\Models\Order::where('status', 1)->where('order_type', 'Shops')->count()}}</span></a></li>
                                    <li class="nav-item"> <a href="{{route('old_shops')}}" class="nav-link" >Все</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item menu-items">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
              <span class="menu-icon">
                <i class="mdi mdi-account-multiple-plus"></i>
              </span>
                                <span class="menu-title">Доставка &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 1)->where('order_type', 'Drugoi')->count() + \App\Models\Order::where('status', 2)->where('order_type', 'Drugoi')->count() + \App\Models\Order::where('status', 3)->where('order_type', 'Drugoi')->count()}}</span></span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic4" style="">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a href="{{route('new_delivery')}}" class="nav-link" >Новые &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 1)->where('order_type', 'Drugoi')->count()}}</span></a></li>
                                    <li class="nav-item"> <a href="{{route('delivery_delivery')}}" class="nav-link" >Ожидает  Доставки &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 2)->where('order_type', 'Drugoi')->count()}}</a></li>
                                    <li class="nav-item"> <a href="{{route('delivers_delivery')}}" class="nav-link" >В пути   &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 3)->where('order_type', 'Drugoi')->count()}}</a></li>
                                    <li class="nav-item"> <a href="{{route('confirmed_delivery')}}" class="nav-link" >Завершенные</a></li>
                                </ul>
                            </div>
                        </li>

                    @endif
{{--                    @dd(auth()->user())--}}
                    @if(auth()->user()->role_id == 1)
                        <li class="nav-item menu-items">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
              <span class="menu-icon">
                <i class="mdi mdi-account-multiple-plus"></i>
              </span>
                                <span class="menu-title">Товары</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic2" style="">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a href="{{route('products')}}" class="nav-link" >На продаже</a></li>
                                    <li class="nav-item"> <a href="{{route('close_product')}}" class="nav-link" >Снятые с продажи </a></li>
                                </ul>
                            </div>
                        </li>
                        @endif
                    @if(auth()->user()->role_id == 2 )
                    <li class="nav-item menu-items">
                        <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
              <span class="menu-icon">
                <i class="mdi mdi-account-multiple-plus"></i>
              </span>
                            <span class="menu-title">Товары</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic2" style="">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a href="{{route('products')}}" class="nav-link" >На продаже</a></li>
                                <li class="nav-item"> <a href="{{route('close_product')}}" class="nav-link" >Снятые с продажы</a></li>
                            </ul>
                        </div>
                    </li>


                        <li class="nav-item menu-items">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
                                {{--              <span class="menu-icon">--}}
                                {{--                <i class="mdi mdi-account-multiple-plus"></i>--}}
                                {{--              </span>--}}
                                <span class="menu-title">Покупка из магазина &nbsp; <span style="color: #ff5751">{{\App\Models\Order::whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('order_type', 'Shops')->where('status',2)->count()}}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic3" style="">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a href="{{route('ShowNewShop')}}" class="nav-link" >Новые  &nbsp; <span style="color: #ff5751">{{\App\Models\Order::whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('order_type', 'Shops')->where('status',2)->count()}}</span></a></li>
                                    <li class="nav-item"> <a href="{{route('ShowOldShop')}}" class="nav-link" >Все</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item menu-items">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
              <span class="menu-icon">
                <i class="mdi mdi-account-multiple-plus"></i>
              </span>
                                <span class="menu-title">Доставка &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 2)->where('order_type', 'Drugoi')->whereRelation('OrderProduct','shop_id', auth()->user()->id)->count() + \App\Models\Order::where('status', 3)->whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('order_type', 'Drugoi')->count()}}</span></span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic4" style="">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a href="{{route('NewDelivery')}}" class="nav-link" >Новые&nbsp;  <span style="color: #ff5751">{{\App\Models\Order::whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('status', 2)->where('order_type', 'Drugoi')->count()}}</a></li>
                                    <li class="nav-item"> <a href="{{route('DeliveryDelivery')}}" class="nav-link" >В пути   &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 3)->whereRelation('OrderProduct','shop_id', auth()->user()->id)->where('order_type', 'Drugoi')->count()}}</a></li>
                                    <li class="nav-item"> <a href="{{route('ConfirmedDeliveryDelivery')}}" class="nav-link" >Завершенные</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif
                    @if(auth()->user()->role_id == 4)
                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('all_users')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                                <span class="menu-title">Пользователи</span>
                            </a>
                        </li>



                        <li class="nav-item menu-items">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
                                {{--              <span class="menu-icon">--}}
                                {{--                <i class="mdi mdi-account-multiple-plus"></i>--}}
                                {{--              </span>--}}
                                <span class="menu-title">Покупка из магазина &nbsp; <span style="color: #ff5751">{{\App\Models\Order::where('status', 1)->where('order_type', 'Shops')->count()}}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic3" style="">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a href="{{route('new_shops')}}" class="nav-link" >Новые  &nbsp; <span style="color: #ff5751">{{\App\Models\Order::where('status', 1)->where('order_type', 'Shops')->count()}}</span></a></li>
                                    <li class="nav-item"> <a href="{{route('old_shops')}}" class="nav-link" >Все</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item menu-items">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
              <span class="menu-icon">
                <i class="mdi mdi-account-multiple-plus"></i>
              </span>
                                <span class="menu-title">Доставка &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 1)->where('order_type', 'Drugoi')->count() + \App\Models\Order::where('status', 2)->where('order_type', 'Drugoi')->count() + \App\Models\Order::where('status', 3)->where('order_type', 'Drugoi')->count()}}</span></span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic4" style="">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a href="{{route('new_delivery')}}" class="nav-link" >Новые &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 1)->where('order_type', 'Drugoi')->count()}}</span></a></li>
                                    <li class="nav-item"> <a href="{{route('delivery_delivery')}}" class="nav-link" >Ожидает  Доставки &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 2)->where('order_type', 'Drugoi')->count()}}</a></li>
                                    <li class="nav-item"> <a href="{{route('delivers_delivery')}}" class="nav-link" >В пути   &nbsp;  <span style="color: #ff5751">{{\App\Models\Order::where('status', 3)->where('order_type', 'Drugoi')->count()}}</a></li>
                                    <li class="nav-item"> <a href="{{route('confirmed_delivery')}}" class="nav-link" >Завершенные</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif
                </ul>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar p-0 fixed-top d-flex flex-row">
                
                    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="mdi mdi-menu"></span>
                        </button>

                        <ul class="navbar-nav navbar-nav-right">



{{--                    --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                    <div class="navbar-profile">
                                        {{--                                <img class="img-xs rounded-circle" src="{{asset('images/faces/face15.jpg')}}" alt="">--}}
                                        <p class="mb-0 d-none d-sm-block navbar-profile-name" style="display: block !important;">&nbsp;&nbsp;&nbsp;&nbsp;{{auth()->user()->name}}</p>
                                        <i style="display: block !important;" class="mdi mdi-menu-down d-none d-sm-block"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                     aria-labelledby="profileDropdown">
                                    <h6 class="p-3 mb-0">Профиль</h6>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{route('settingView')}}" class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle">
                                                <i class="mdi mdi-settings text-success"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject mb-1">Настройки</p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{route('logoutAdmin')}}" class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle">
                                                <i class="mdi mdi-logout text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject mb-1">  Выход </p>
                                        </div>

                                    </a>
                                    <div class="dropdown-divider"></div>

                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                                data-toggle="offcanvas">
                            <span class="mdi mdi-format-line-spacing"></span>
                        </button>
                    </div>
                </nav>
            @else

            @endif
            @else

            @endif

            <!-- partial -->
            @yield('content')
            <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>


        <!-- container-scroller -->
        <!-- plugins:js -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


        <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{asset('admin/vendors/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('admin/vendors/progressbar.js/progressbar.min.js')}}"></script>
        <script src="{{asset('admin/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
        <script src="{{asset('admin/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{asset('admin/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{asset('admin/js/off-canvas.js')}}"></script>
        <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
        <script src="{{asset('admin/js/misc.js')}}"></script>
        <script src="{{asset('admin/js/settings.js')}}"></script>
        <script src="{{asset('admin/js/todolist.js')}}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{asset('admin/js/dashboard.js')}}"></script>
        <script src="{{asset('admin/js/message.js')}}"></script>
        <script src="{{asset('admin/js/my_main.js')}}"></script>
        <script src="{{asset('admin/js/product.js')}}"></script>



        <!-- End custom js for this page -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{asset('admin/dist/image-uploader.min.js')}} "></script>

</body>
</html>
