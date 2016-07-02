@extends('admin.base')

@section('head')
    @parent
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
                    <h1>{{$title}}</h1>
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
                                        <a class="btn btn-flat">更新</a>
                                        <a class="btn btn-flat">删除</a>
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
            <a data-toggle="modal" data-target="#category-add" class="fbtn waves-attach waves-circle waves-light fbtn-lg fbtn-brand"><i class="icon icon-lg">add</i> </a>
        </div>
    </div>


    <!-- Modal -->
    <div aria-hidden="true" class="modal fade in" id="category-add" role="dialog" tabindex="-1" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-heading">
                    <a class="modal-close" data-dismiss="modal">×</a>
                    <h2 class="modal-title">添加栏目</h2>
                </div>
                <div class="modal-inner">
                    <form>
                        <div class="form-group form-group-label">
                            <label class="floating-label" for="last">上级栏目 </label>
                            <select class="form-control" id="last" required name="pid">
                                <option value="0">顶级栏目</option>
                                @foreach(App\Category::where('pid','0')->get() as $category)
                                    <option value="{{$category->id}}">{{$category->cn_title}}</option>
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
                            <button type="submit" class="btn btn-flat btn-block waves-attach waves-light">提交</button>
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

        $("form").submit(function () {
            add();
            return false;
        });
        function add() {
            $.ajax({
                type: "POST",
                url:'/admin/category/add',
                data:$('form').serialize(),
                error: function(request) {

                },
                success: function(data) {
                    if(data.status==200){

//                        location.href=data.backUrl;
                    }else {

                    }
                    console.log(data);
                }
            });
            return false;
        }
    </script>

@endsection