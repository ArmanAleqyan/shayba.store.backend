@extends('admin.layouts.default')
<link rel="shortcut icon" href="{{asset('Лого.png')}}"/>
@section('title')
    Логин
@endsection

<style>
    input{
        color: white !important;
    }

</style>


    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div style="background-image: url({{asset('default.jpg')}})" class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Вход</h3>
                            <form method="post" action="{{route('logined')}}" >
                                @csrf
                                <div class="form-group">
                                    <label>Эл.почта *</label>
                                    <input  name="email" type="text" class="form-control p_input"  value="{{old('login')}}" required>
                                    @if(session('login'))
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function () {

                                                setTimeout(function(){
                                                    document.getElementById('emailerror').style.display = 'none';
                                                }, 10000);
                                            });
                                        </script>
                                        <p id="emailerror" style=" color: #fe8765;">Неверная эл.почта</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Пароль *</label>
                                    <input name="password" type="password" class="form-control p_input" required>
                                    <div style="display: flex; justify-content: flex-end">
                                    <a  data-toggle="modal"  data-target="#exampleModal" style="cursor: pointer; font-size: x-small">Забыли пароль?</a>
                                    </div>
                                    @if(session('password'))
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function () {

                                                setTimeout(function(){
                                                    document.getElementById('passworderror').style.display = 'none';
                                                }, 10000);
                                            });
                                        </script>
                                        <p id="passworderror" style=" color: #fe8765;">Неверный пароль</p>
                                    @endif
                                </div>


                                <div class="text-center">
                                    <button type="submit" style="    background: #fa806b;" class="btn  btn-block enter-btn">Войти</button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Забыли пароль? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('send_email_code_from_admin')}}" method="post">
                @csrf
            <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Эл.почта:</label>
                        <input type="email"  name="email" class="form-control" id="recipient-name" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Получить код подтверждения</button>
            </div></form>

        </div>
    </div>
</div>
