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
    <div class="container admin-main" id="category">
        <div class="card col-md-8 col-md-offset-2">
            <div class="card-main">
                <div class="card-inner">
                    <h2>{{$title}}</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>中文标题</th>
                                <th>英文标题</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $cate)
                                <tr>
                                    <td>{{$cate->id}}</td>
                                    <td>{{$cate->cn_title}}</td>
                                    <td>{{$cate->en_title}}</td>
                                    <td>
                                        @if($cate->pid==0)
                                            <a class="btn btn-brand waves-attach waves-effect" href="/admin/category?pid={{$cate->id}}&title={{$cate->cn_title}}">查看子目录</a>
                                        @else
                                            <a class="btn btn-brand waves-attach waves-effect" href="/admin/album?cid={{$cate->id}}&title={{$cate->cn_title}}">查看图集</a>
                                        @endif
                                        <a class="btn btn-brand waves-attach waves-circle waves-light" onclick="update('{{$cate->id}}','{{$cate->pid}}','{{$cate->cn_title}}','{{$cate->en_title}}');">更新</a>
                                        <a class="btn btn-brand waves-attach waves-circle waves-light" onclick="del({{$cate->id}})">删除</a>
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
                    <a class="fbtn waves-attach waves-circle waves-effect"data-toggle="modal" data-target="#category-add" >
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
    <div aria-hidden="true" class="modal fade in" id="category-add" role="dialog" tabindex="-1" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-heading">
                    <a class="modal-close" data-dismiss="modal">×</a>
                    <h2 class="modal-title">添加栏目</h2>
                </div>
                <div class="modal-inner">
                    <form onsubmit="return false;">
                        {{ csrf_field() }}
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="last">上级栏目 </label>
                            <select class="form-control" id="last" required name="pid">
                                <option value="0">顶级栏目</option>
                                @foreach(App\Category::where('pid','0')->get() as $cate)
                                        <option value="{{$cate->id}}">{{$cate->cn_title}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="cn-title">中文标题</label>
                            <input class="form-control" required id="cn-title" name="cn_title" type="text">
                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="en-title">英文标题</label>
                            <input class="form-control" required id="en-title" name="en_title" type="text">
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
            $('#last option[value={{$pid}}]').attr('selected','selected');
        });

        function goBack() {
            history.go(-1);
        }

        /**
         * 添加目录
         */
        function add() {
            $('#category-add').modal('hide');
            $.ajax({
                type: "POST",
                url:'/admin/category/add',
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

        function update(id,pid,cn_title,en_title) {
            $('#category-add .modal-title').text('更新目录');
            $('#category-add #cn-title').val(cn_title);
            $('#category-add #en-title').val(en_title);
            $('#category-add form').append("<input type='hidden' name='id' value="+id+">");
            $('#category-add #post').attr('onclick','');
            $('#category-add #post').click(function () {
                $('#category-add').modal('hide');
                $.ajax({
                    type: "POST",
                    url:'/admin/category/update',
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
            $('#category-add').modal('show');
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
                        url:'/admin/category/del?id='+id,
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
                            '该目录未被删除)',
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