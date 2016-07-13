@extends('admin.base')

@section('head')
    @parent
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/hover.css')}}">
    <style>

        .bar {
            height: 5px;
            background: green;
        }

        .img-list {
            display: inline-block;
            width: 330px;
            max-width: 100%;
            margin-top: 10px;
            margin-right: 20px;
            background: #EEEEEE;
            border: 1px solid #eCeCeC;
            padding: 5px;
        }

        .img-list a {

        }

        .img-list img {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        #cover{
            position: absolute;
            right:0;
            top:0px;
            width:40px;
            height:40px;

        }

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
    <div class="container admin-main" id="picture">
        <div class="card col-md-10 col-md-offset-1">
            <div class="card-main">
                <div class="card-inner">
                    <h2>{{$title}}</h2>
                    <div class="form-group form-group-label">
                        <label class="btn btn-brand " for="pictures">上传图片</label>
                        <input class="form-control" multiple name="pictures[]" id="pictures" style="display: none;"
                               type="file">
                    </div>
                    <div id="progress">
                        <div class="bar" style="width: 0%;"></div>
                    </div>


                    @foreach($pictures as $picture)
                        <div class="box img-list">
                            <img class="img-thumbnail" src="{{asset(getPic($picture->id))}}"/>
                            @if($cover==$picture->id)
                                <img src="{{asset('images/cover.png')}}" id="cover">
                            @endif
                            <div class="over-layer">
                                <h3 class="title">操作</h3>
                                <p class="description">
                                    <a class="btn btn-flat btn-brand-accent"
                                       onclick="del('{{$aid}}','{{$picture->id}}')">点击删除</a>
                                    <a class="btn btn-flat btn-brand-accent"
                                       onclick="setCover('{{$aid}}','{{$picture->id}}')">设为封面</a>
                                    <a class="btn btn-flat btn-brand-accent"
                                       onclick="sortPic('{{$picture->pivot->id}}','{{$picture->pivot->sort}}')">排序</a>
                                </p>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
        <div class="col-md-3 fbtn-container">
            <a class="fbtn fbtn-brand waves-attach waves-circle waves-light waves-effect" href="#" onclick="goBack()">
                <span class="fbtn-text fbtn-text-left">返回</span>
                <img class="back-img" src="{{asset('images/back.png') }}" />
            </a>
        </div>
    </div>



    <div aria-hidden="true" class="modal modal-va-middle fade" id="sort-modal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-heading">设置图片顺序</div>
                <div class="modal-inner">
                    <form onsubmit="return false;" id="form-sort">
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="sort">数字越大越靠前</label>
                            <input class="form-control" id="sort" name="sort" type="number">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-flat btn-brand" onclick="sortPicGo()">提交</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.widget.js')}}"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{{asset('js/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('js/jquery.fileupload.js')}}"></script>

    <script>

        function goBack() {
            history.go(-1);
        }

        /**
         * 图片批量上传
         **/
        $(function () {
            $('#pictures').fileupload({
                url: '/admin/picture/add?aid={{$aid}}',
                dataType: 'json',
                done: function (e, data) {
                    console.log(data.result);
                    $('#progress .bar').css('display', 'none');
                    if(data.result.status==200){
                        swal({
                            title: '添加成功',
                            text: '添加成功',
                            type: 'success'
                        }).then(function(isConfirm) {
                            location.reload();
                        });
                    }else {
                        swal('警告','添加失败<br>'+data.result.msg,'warning');
                    }
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


        function sortPic(id,sort) {
            $('#form-sort').append("<input name='id' type='hidden' value='"+id+"'/>");
            $('#sort').val(sort);
            $('#sort-modal').modal('show');
        }

        function sortPicGo() {
            $('#sort-modal').modal('hide');
            $.ajax({
                type: "POST",
                url:'/admin/picture/sort',
                data:$('#form-sort').serialize(),
                error: function(request) {
                    swal('Oops...', '服务器错误', 'error');
                },
                success: function(data) {
                    if(data.status==200){
                        swal({
                            title: 'Success',
                            text: '设置成功',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: '更新页面'
                        }).then(function(isConfirm) {
                            if (isConfirm === true) {
                                location.reload();
                            }
                        });
                    }else {
                        swal('Deleted!', '设置失败！<br />'+data.msg, 'error');
                    }
                    console.log(data);
                }
            });
        }

        /**
         * 设置封面
         * @param aid
         * @param pid
         */
        function setCover(aid,pid){
            $.ajax({
                type: "POST",
                url:'/admin/album/cover?aid='+aid+'&pid='+pid,
                error: function(request) {
                    swal('Oops...', '服务器错误', 'error');
                },
                success: function(data) {
                    if(data.status==200){
                        swal({
                            title: 'Success',
                            text: '设置成功',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: '更新页面'
                        }).then(function(isConfirm) {
                            if (isConfirm === true) {
                                location.reload();
                            }
                        });
                    }else {
                        swal('Deleted!', '设置失败！<br />'+data.msg, 'error');
                    }
                    console.log(data);
                }
            });
        }

        function del(aid, pid) {
            swal({
                title: 'Are you sure?',
                text: '你将要删除该图片',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it',
            }).then(function(isConfirm) {
                if (isConfirm === true) {
                    $.ajax({
                        type: "POST",
                        url:'/admin/picture/del?aid='+aid+'&pid='+pid,
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
                            '该图片未被删除)',
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