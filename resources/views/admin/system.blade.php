@extends('admin.base')
@section('head')
    @parent
    <style>
        .card-action button{
            height: 47px;
        }
        .bar {
            height: 5px;
            background: green;
        }

        #web-logo-img{
            max-height:100px;
        }
    </style>
@endsection
@section('admin-main')
<div class="container-full page-brand">
    @include('admin.header')
    @include('admin.sidebar')
    <div class="container admin-main" id="system">

        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-main">

                    <div class="card-inner">
                        <h2>系统设置</h2>
                        {{--<form class="">--}}
                            <div class=" form-group form-group-label">
                                <label class="floating-label" for="web-name">站点名称</label>
                                <input class="form-control" name="web_name" id="web-name" value="{{sConfig('web_name')}}" type="text">
                            </div>
                            <div class="form-group form-group-label">
                                <label class="btn btn-brand btn-flat" for="web-logo">选择站点LOGO</label>
                                <input class="form-control" name="picture" id="web-logo" style="display: none;" type="file">
                                <img id="web-logo-img" src="{{sConfig('web_logo')}}">
                            </div>
                            <div id="progress">
                                <div class="bar" style="width: 0%;"></div>
                            </div>
                            <div class="form-group form-group-label">
                                <label class="floating-label" for="web-description"> 站点描述 </label>
                                <textarea class="form-control textarea-autosize"  name="web_description" id="web-description" rows="2">{{sConfig('web_description')}}</textarea>
                            </div>
                            <div class="form-group form-group-label">
                                <label class="floating-label" for="web-keywords">关键词</label>
                                <textarea class="form-control textarea-autosize"  name="web_keywords" id="web-keywords" rows="2">{{sConfig('web_keywords')}}</textarea>
                            </div>
                            <div class="form-group form-group-label">
                                <label class="floating-label" for="web_statistics">统计代码</label>
                                <textarea class="form-control textarea-autosize"  id="web_statistics" name="web_statistics" rows="2">{{sConfig('$web_statistics')}}</textarea>
                            </div>
                        {{--</form>--}}
                    </div>

                </div>
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
<script>
    $('input[type=text]').change(function () {
        var data={
            'value':$(this).val()
        }
        update($(this).attr('name'),data);
    });
    $('textarea').change(function () {
        var data={
            'value':$(this).val()
        }
        update($(this).attr('name'),data);
    });

    $(function () {
        $('#web-logo').fileupload({
            url:'/admin/system/logo',
            dataType: 'json',
            done: function (e, data) {
                $('#web-logo-img').attr('src',data.result.path);
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


    function update(action,d) {
        $.ajax({
            type: "POST",
            url:'/admin/system/?action='+action,
            data:d,
            error: function(request) {
                $('body').snackbar({
                    alive:5000,
                    content:"服务器错误"
                });
            },
            success:function (data) {
                if(data.status==200){
                    $('body').snackbar({
                        alive: 2000,
                        content:"修改成功"
                    });
                }else {
                    $('body').snackbar({
                        alive:5000,
                        content:data.msg
                    });
                }
            }
        });
    }
</script>
@endsection
