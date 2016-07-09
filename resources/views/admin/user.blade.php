@extends('admin.base')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <style>
        .fbtn-container{
            margin-bottom:50px;
        }



        .bar {
            height: 5px;
            background: green;
        }
    </style>


@endsection
@section('admin-main')
    <div class="container admin-main" id="user">
        <div class="card col-md-8 col-md-offset-2">
            <div class="card-main">
                <div class="card-inner">
                    <h2>{{$title}}</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>邮箱</th>
                                <th>头像</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td id="avatar" ><span  class="avatar"><img src="{{asset(getPic($user->avatar))}}" alt="{{$user->name}}的头像"  title="{{$user->name}}的头像"></span></td>
                                    <td>

                                        <a class="btn btn-brand waves-attach waves-circle waves-light" onclick="update('{{$user->id}}','{{$user->name}}','{{$user->email}}','{{$user->avatar}}','{{asset(getPic($user->avatar))}}');">更新</a>
                                        <a class="btn btn-brand waves-attach waves-circle waves-light" onclick="del({{$user->id}})">删除</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-action">

                </div>
            </div>
        </div>
        <div class="col-md-3 fbtn-container">
            <a data-toggle="modal" data-target="#user-add" class="fbtn waves-attach waves-circle waves-light fbtn-lg fbtn-brand"><i class="icon icon-lg">add</i> </a>
        </div>
    </div>


    <!-- add Modal -->
    <div aria-hidden="true" class="modal fade in" id="user-add" role="dialog" tabindex="-1" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-heading">
                    <a class="modal-close" data-dismiss="modal">×</a>
                    <h2 class="modal-title">添加用户</h2>
                </div>
                <div class="modal-inner">
                    <form id="form-add">
                        {{ csrf_field() }}
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="name">用户名 </label>
                            <input class="form-control" id="name" required name="username">

                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="email">邮箱</label>
                            <input class="form-control" required id="email" name="email" type="email">
                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="password">密码</label>
                            <input class="form-control" required id="password" name="password" type="password">
                        </div>
                        <div class="form-group form-group-label">
                            <span style="display: none;margin-bottom: 10px;" class="avatar"><img id="avatar-img" src=""></span>
                            <label class="btn btn-brand" id="avatar-label" for="avatar-input">头像</label>
                            <input  style="display: none;" class="avatar-input" id="avatar-input" name="picture" type="file">
                        </div>
                        <input name="avatar" type="hidden">
                        <div id="progress">
                            <div class="bar" style="width: 0%;"></div>
                        </div>
                        <div>
                            <button id="post" type="submit" class="btn btn-flat btn-block waves-attach waves-light" onclick="add()">提交</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- update Modal -->
    <div aria-hidden="true" class="modal fade in" id="user-update" role="dialog" tabindex="-1" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-heading">
                    <a class="modal-close" data-dismiss="modal">×</a>
                    <h2 class="modal-title">添加用户</h2>
                </div>
                <div class="modal-inner">
                    <form id="form-update">
                        {{ csrf_field() }}
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="name">用户名 </label>
                            <input class="form-control" id="name" required name="username">

                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="email">邮箱</label>
                            <input class="form-control" required id="email" name="email" type="email">
                        </div>

                        <div class="form-group form-group-label">
                            <span style="display: none;margin-bottom: 10px;" class="avatar"><img id="avatar-img" src=""></span>
                            <label class="btn btn-brand" id="avatar-label" for="avatar-input">头像</label>
                            <input  style="display: none;" class="avatar-input" id="avatar-input" name="picture" type="file">
                        </div>
                        <input name="avatar" type="hidden">
                        <div id="progress">
                            <div class="bar" style="width: 0%;"></div>
                        </div>
                        <div>
                            <button id="post" type="submit" class="btn btn-flat btn-block waves-attach waves-light" onclick="">提交</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    @parent
    <script src="{{asset('js/jquery.ui.widget.js')}}"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{{asset('js/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('js/jquery.fileupload.js')}}"></script>
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script>

        $("#form-add").submit(function () {
                    add();
                    return false;
        });

        $("#form-update").submit(function () {
            updateGo();
            return false;
        });

        $(function () {
             $('.avatar-input').fileupload({
                 url:'/admin/user/avatar',
                 dataType: 'json',
                 done: function (e, data) {
                     if(data.result.status==200){
                        $('.avatar').css('display','');
                        $('.avatar img').attr('src',data.result.path);
                        $('input[name="avatar"]').val(data.result.pid);
                     }else {
                         swal('警告','上传失败，请稍后重试<br />'+data.msg,'warning');
                     }
                     $('#progress .bar').css('display','none');
                 },
                 progressall: function (e, data) {
                     var progress = parseInt(data.loaded / data.total * 100, 10);
                     $('#progress .bar').css(
                             'width',
                             progress + '%'
                     );
                 }
             });
         });

        /**
         * 添加目录
         */
        function add() {
            $('#user-add').modal('hide');
            $.ajax({
                type: "POST",
                url:'/admin/user/add',
                data:$('form').serialize(),
                error: function(request) {
                    swal('警告','服务器错误','warning');
                },
                success: function(data) {
                    if(data.status==200){
                        swal({
                            title: '添加成功',
                            text: '添加成功',
                            type: 'success'
                        }).then(function(isConfirm) {
                            location.reload();
                        });
                    }else {
                        swal('警告','添加失败，请稍后重试<br />'+data.msg,'warning');
                    }
                    console.log(data);
                }
            });
            return false;
        }


        function update(id,name,email,avatar,avatar_path,password) {
            $('#user-update .modal-title').text('更新用户');
            $('#user-update #name').val(name);
            $('#user-update #email').val(email);
            $('#user-update #password').val(password);
            $('#user-update #avatar-img').attr('src',avatar_path);
            $('.avatar').css('display','');
            $('input[name="avatar"]').val(avatar);
            $('#user-update form').append("<input type='hidden' name='id' value="+id+">");
            $('#user-update').modal('show');
        }
        
        
        function updateGo() {
            $('#user-update').modal('hide');
            $.ajax({
                type: "POST",
                url:'/admin/user/update',
                data:$('form').serialize(),
                error: function(request) {
                    swal('警告','服务器错误','warning');
                },
                success: function(data) {
                    if(data.status==200){
                        swal({
                            title: '更新成功',
                            text: '更新成功',
                            type: 'success'
                        }).then(function(isConfirm) {
                            location.reload();
                        });
                    }else {
                        swal('警告','更新失败，请稍后重试','warning');
                    }
                    console.log(data);
                }
            });
        }

        /**
         * 删除目录
         * @param id
         */
        function del(id) {
            swal({
                title: 'Are you sure?',
                text: '你将要删除该目录',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it',
            }).then(function(isConfirm) {
                if (isConfirm === true) {
                    $.ajax({
                        type: "POST",
                        url:'/admin/user/del?id='+id,
                        error: function(request) {
                            swal('Oops...', '服务器错误', 'error');
                        },
                        success: function(data) {
                            if(data.status==200){
                                swal({
                                    title: 'Success',
                                    text: '删除成功',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: '更新页面'
                                }).then(function(isConfirm) {
                                    if (isConfirm === true) {
                                        location.reload();
                                    }
                                });
                            }else {
                                swal(
                                        'Deleted!',
                                        '删除失败！<br />'+data.msg,
                                        'error'
                                );
                            }
                            console.log(data);
                        }
                    });
                } else if (isConfirm === false) {
                    swal(
                            'Cancelled',
                            '该用户未被删除)',
                            'error'
                    );

                } else {
                    // Esc, close button or outside click
                    // isConfirm is undefined
                }
            });
        }
    </script>

@endsection