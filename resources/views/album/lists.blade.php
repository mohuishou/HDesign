@extends('admin.base')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <style>
        .fbtn-container{
            margin-bottom:50px;
        }
    </style>


@endsection
@section('admin-main')
    <div class="container admin-main" id="category">
        <div class="card col-md-8 col-md-offset-2">
            <div class="card-main">
                <div class="card-inner">
                    <h2>{{$title}}</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>中文标题</th>
                            <th>英文标题</th>
                            <th>描述</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($albums as $album)
                            <tr>
                                <td>{{$album->id}}</td>
                                <td>{{$album->cn_title}}</td>
                                <td>{{$album->en_title}}</td>
                                <td>{{$album->description}}</td>
                                <td>
                                    <a class="btn btn-brand waves-attach waves-effect" href="/admin/picture?aid={{$album->id}}&title={{$album->cn_title}}">查看图片</a>
                                    <a class="btn btn-brand waves-attach waves-circle waves-light" onclick="update('{{$album->id}}','{{$album->cn_title}}','{{$album->en_title}}','{{$album->description}}');">更新</a>
                                    <a class="btn btn-brand waves-attach waves-circle waves-light" onclick="del({{$album->id}})">删除</a>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-action">

                </div>
            </div>
        </div>
        <div class="col-md-3 fbtn-container">
            <a data-toggle="modal" data-target="#album-add" class="fbtn waves-attach waves-circle waves-light fbtn-lg fbtn-brand"><i class="icon icon-lg">add</i> </a>
        </div>
    </div>


    <!-- add Modal -->
    <div aria-hidden="true" class="modal fade in" id="album-add" role="dialog" tabindex="-1" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-heading">
                    <a class="modal-close" data-dismiss="modal">×</a>
                    <h2 class="modal-title">添加图集</h2>
                </div>
                <div class="modal-inner">
                    <form onsubmit="return false;">
                        {{ csrf_field() }}
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="last">上级栏目 </label>
                            <select class="form-control" id="last" required name="cid">
                                @foreach(App\Category::where('pid','>','0')->get() as $cate)
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
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="description">图集描述 </label>
                            <textarea class="form-control textarea-autosize"  name="description" id="description" required maxlength="255" rows="2"></textarea>
                        </div>
                        <div>
                            <button id="post" type="submit" class="btn btn-flat btn-block waves-attach waves-light" onsubmit="add()">提交</button>
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
            $('#last option[value={{$cid}}]').attr('selected','selected');
        });
        //        $("form").submit(function () {
        //            add();
        //            return false;
        //        });

        /**
         * 添加目录
         */
        function add() {
            $('#album-add').modal('hide');
            $.ajax({
                type: "POST",
                url:'/admin/album/add',
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

        function update(id,cn_title,en_title,description) {
            $('#album-add .modal-title').text('更新图集');
            $('#album-add #cn-title').val(cn_title);
            $('#album-add #en-title').val(en_title);
            $('#album-add #description').val(description);
            $('#album-add form').append("<input type='hidden' name='id' value="+id+">");
            $('#album-add #post').attr('onclick','');
            $('#album-add #post').click(function () {
                $('#album-add').modal('hide');
                $.ajax({
                    type: "POST",
                    url:'/admin/album/update',
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
            $('#album-add').modal('show');
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
                        url:'/admin/album/del?id='+id,
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
                            '该图集未被删除)',
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