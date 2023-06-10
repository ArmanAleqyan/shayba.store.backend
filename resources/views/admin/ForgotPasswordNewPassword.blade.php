@extends('admin.layouts.default')
<link rel="shortcut icon" href="{{asset('Лого.png')}}"/>
@section('title')
    Забыли пароль
@endsection

<style>
    input{
        color: white !important;
    }
    .error{
        font-size: x-small;
        color: red;
    }

</style>


<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div style="background-image: url({{asset('default.jpg')}})" class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-left mb-3">Забыли пароль</h3>
                        <form method="post" action="{{route('FrogotPasswordAddNewPasswordRequest')}}" >
                            @csrf
                            <div class="form-group">
                                <label>Код подтверждения *</label>
                                <input  name="code" type="text" class="form-control p_input"  value="{{old('code')}}" required>
                                @if(session('wrongcode'))
                                    <span style="font-size: xx-small;color:red">Невёрный код подтверждения</span>
                                    @endif
                                @if($errors->has('code'))
                                    <div class="error">{{ $errors->first('code') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Новый пароль *</label>
                                <input name="password" type="password" class="form-control p_input" required>
                                @if($errors->has('password'))
                                    <div class="error">{{ $errors->first('password') }}</div>
                                @endif

                            </div>
                            <div class="form-group">
                                <label>Подтверждение пароля *</label>
                                <input name="password_confirmation" type="password" class="form-control p_input" required>
                                @if($errors->has('password_confirmation'))
                                    <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>


                            <div class="text-center">
                                <button type="submit" style="    background: #fa806b;" class="btn  btn-block enter-btn">Сохранить</button>
                                <a href="{{route('login')}}" style="    background: #fa806b;" class="btn  btn-block enter-btn">Страница входа</a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
