@extends('admin.base')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <style>
        .fbtn-container{
            margin-bottom:50px;
        }
        .back-img{
            width:20px;
            height:20px;
        }
    </style>


@endsection
@section('admin-main')
    <div class="container admin-main" id="message">
        <div class="card col-md-11">
            <div class="card-main">
                <div class="card-inner">
                    <h2>{{$title}}</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>姓名</th>
                                <th>邮箱</th>
                                <th>手机号</th>
                                <th>留言</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($message as $msg)
                                <tr>
                                    <td>{{$msg->id}}</td>
                                    <td>{{$msg->name}}</td>
                                    <td>{{$msg->email}}</td>
                                    <td>{{$msg->tel}}</td>
                                    <td>{{$msg->comment}}</td>
                                    <td>
                                        <a class="btn btn-brand waves-attach waves-circle waves-light" onclick="update('{{$msg->id}}','{{$msg->name}}','{{$msg->email}}','{{$msg->tel}}','{{$msg->comment}}');">更新</a>
                                        <a class="btn btn-brand waves-attach waves-circle waves-light" onclick="del({{$msg->id}})">删除</a>
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
            <div class="fbtn-inner">
                <a class="fbtn fbtn-lg fbtn-brand waves-attach waves-circle waves-light waves-effect" data-toggle="dropdown">
                    <span class="fbtn-text fbtn-text-left">操作</span>
                    <span class="fbtn-ori icon">apps</span>
                    <span class="fbtn-sub icon">close</span>
                </a>
                <div class="fbtn-dropup">
                    <a class="fbtn waves-attach waves-circle waves-effect"data-toggle="modal" data-target="#message-add" >
                        <span class="fbtn-text fbtn-text-left">添加</span>
                        <span class="icon">add</span></a>
                    <a class="fbtn fbtn-brand waves-attach waves-circle waves-light waves-effect" href="#" onclick="goBack()">
                        <span class="fbtn-text fbtn-text-left">返回</span>
                        <img class="back-img" src="{{asset('images/back.png') }}" />
                    </a>

                </div>
            </div>
        </div>


    </div>


    <!-- add Modal -->
    <div aria-hidden="true" class="modal fade in" id="message-add" role="dialog" tabindex="-1" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-heading">
                    <a class="modal-close" data-dismiss="modal">×</a>
                    <h2 class="modal-title">添加留言</h2>
                </div>
                <div class="modal-inner">
                    <form onsubmit="return false;">
                        {{ csrf_field() }}
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="name">姓名</label>
                            <input class="form-control" required id="name" name="name" type="text">
                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="tel">手机</label>
                            <input class="form-control" required maxlength="11" id="tel" name="tel" type="text">
                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="email">邮箱</label>
                            <input class="form-control" required id="email" name="email" type="email">
                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="comment">留言</label>
                            <textarea class="form-control" id="comment" name="comment" rows="2"></textarea>
                        </div>
                        <div>
                            <button id="post" type="submit" class="btn btn-flat btn-block waves-attach waves-light" onclick="add()">提交</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



@endsection
@section('script')
    @parent
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
        });

        function goBack() {
            history.go(-1);
        }

        /**
         * 添加目录
         */
        function add() {
            $('#message-add').modal('hide');
            $.ajax({
                type: "POST",
                url:'/admin/message/add',
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
                        swal('警告','添加失败，请稍后重试','warning');
                    }
                    console.log(data);
                }
            });
            return false;
        }

        function update(id,name,email,tel,comment) {
            $('#message-add .modal-title').text('更新目录');
            $('#message-add #name').val(name);
            $('#message-add #email').val(email);
            $('#message-add #tel').val(tel);
            $('#message-add #comment').val(comment);
            $('#message-add form').append("<input type='hidden' name='id' value="+id+">");
            $('#message-add #post').attr('onclick','');
            $('#message-add #post').click(function () {
                $('#message-add').modal('hide');
                $.ajax({
                    type: "POST",
                    url:'/admin/message/update',
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
            });
            $('#message-add').modal('show');
        }

        /**
         * 删除目录
         * @param id
         */
        function del(id) {
            swal({
                title: 'Are you sure?',
                text: '你将要删除该留言',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it',
            }).then(function(isConfirm) {
                if (isConfirm === true) {
                    $.ajax({
                        type: "POST",
                        url:'/admin/message/del?id='+id,
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
                            '该留言未被删除)',
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