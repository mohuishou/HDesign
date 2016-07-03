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
            margin-top: 10px;
            margin-right: 20px;
            background: #EEEEEE;
            border: 1px solid #eCeCeC;
            padding: 5px;
        }

        .img-list .description a {
            color: #EEEEEE;
            text-decoration: none;
        }

        .img-list  img {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }





    </style>


@endsection
@section('admin-main')
    <div class="container admin-main" id="slider">
        <div class="card col-md-10 col-md-offset-1">
            <div class="card-main">
                <div class="card-inner">
                    <h2>{{$title}}</h2>
                    @for($i=0;$i<5;$i++)
                        @if(isset($sliders->get($i)->id))
                            <div class="box img-list">
                                <img class="img-thumbnail" src="{{asset(getPic($slider->albums->cover))}}"/>
                                <div class="over-layer">
                                    <h3 class="title">操作</h3>
                                    <p class="description">
                                        <a class="btn btn-flat btn-brand-accent"
                                           onclick="del()">点击更换</a>
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="box img-list">
                                    <img class="" src="{{asset('images/add_img.png')}}" />
                                    <div class="over-layer">
                                        <h3 class="title">操作</h3>
                                        <p class="description">
                                            <a data-toggle="modal" href="#" data-target="#slider-update"  class=""
                                               onclick="">点击添加</a>
                                        </p>
                                    </div>
                            </div>
                        @endif

                    @endfor




                </div>
            </div>
        </div>
    </div>

    <div aria-hidden="true" class="modal fade in" id="slider-update" role="dialog" tabindex="-1" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-heading">
                    <a class="modal-close" data-dismiss="modal">×</a>
                    <h2 class="modal-title">首页轮播</h2>
                </div>
                <div class="modal-inner">
                    <form onsubmit="return false;">
                        {{ csrf_field() }}
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="one">选择顶级目录</label>
                            <select class="form-control" id="one" required name="pid">
                                <option>请选择</option>
                                @foreach(App\Category::where('pid','0')->get() as $cate)
                                    <option value="{{$cate->id}}">{{$cate->cn_title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="two">选择二级目录</label>
                            <select class="form-control" id="two" required name="cid">
                                <option>请先选择顶级目录</option>
                            </select>
                        </div>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="album">选择图集</label>
                            <select class="form-control" id="album" required name="aid">
                                <option>请先选择二级目录</option>
                            </select>
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
        $('#one').change(function () {
            var pid=$(this).val();
            $.ajax({
                type: "GET",
                url:'/admin/category/getTwo?pid='+pid,
                error: function(request) {
                    swal('警告','服务器错误','warning');
                },
                success: function(data) {
                    if(data.status==200){
                        var options='<option>请选择</option>';
                        for (var i=0;i<data.categories.length;i++){
                            options +='<option value="'+data.categories[i].id+'">'+data.categories[i].cn_title+'</option>'
                        }
                        $('#two').html(options);
                    }else {
                        swal('警告','获取二级目录失败，请稍后重试','warning');
                    }
                    console.log(data);
                }
            });
        });

        $('#two').change(function () {
            var cid=$(this).val();
            $.ajax({
                type: "GET",
                url:'/admin/album/getAlbum?cid='+cid,
                error: function(request) {
                    swal('警告','服务器错误','warning');
                },
                success: function(data) {
                    if(data.status==200){
                        var options='<option>请选择</option>';
                        for (var i=0;i<data.albums.length;i++){
                            options +='<option value="'+data.albums[i].id+'">'+data.albums[i].cn_title+'</option>'
                        }
                        $('#album').html(options);
                    }else {
                        swal('警告','获取图集，请稍后重试','warning');
                    }
                    console.log(data);
                }
            });
        });
        
        
        function add() {
            
        }
    </script>

@endsection