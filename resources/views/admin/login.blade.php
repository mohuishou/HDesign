@extends('admin.base')
@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
@endsection
@section('main')
    <header class="header header-brand ui-header">
        <span class="header-logo">HDesign</span>
    </header>
    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-lg-push-4 col-sm-6 col-sm-push-3">
                    <section class="content-inner">
                        <div class="card">
                            <div class="card-main">
                                <div class="card-header">
                                    <div class="card-inner">
                                        <h1 class="card-heading">Login</h1>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <p class="text-center">
                                            <span class="avatar avatar-inline avatar-lg">
                                                <img alt="Login" src="{{asset('images/users/avatar-001.jpg')}}">
                                            </span>
                                    </p>
                                    <form id="login" class="form" method="post" action="/admin/login">
                                        {{ csrf_field() }}

                                        <div class="form-group form-group-label">
                                            <div class="row">
                                                <div class="col-md-10 col-md-push-1">
                                                    <label class="floating-label" for="username">Username</label>
                                                    <input required maxlength="20" class="form-control" name="username" id="username" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-label">
                                            <div class="row">
                                                <div class="col-md-10 col-md-push-1">
                                                    <label class="floating-label" for="password">Password</label>
                                                    <input name="password" required maxlength="20" class="form-control" id="password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-10 col-md-push-1">
                                                    <button class="btn btn-block btn-brand waves-attach waves-light" >Sign In</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <br />
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </main>

@endsection

@section('script')
    @parent
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            
        });
        $("#login").submit(function () {
            login();
            return false;
        });
        function login() {
            $.ajax({
                type: "POST",
                url:'/admin/login',
                data:$('#login').serialize(),// 你的formid
                error: function(request) {
                    swal('Oops...', '服务器错误', 'error');
                },
                success: function(data) {
                    if(data.status==200){
                        swal({
                            title: 'Success',
                            text: '恭喜你登陆成功',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: '确认，进入后台'
                        });
                        location.href=data.backUrl;
                    }else {
                        swal('Oops...', data.msg, 'error');
                    }
                    console.log(data);
                }
            });
            return false;
        }
    </script>
@endsection
