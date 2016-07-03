<nav  class="menu in" aria-hidden="true" id="ui_menu" tabindex="-1" style="display: none;">
    <div class="menu-scroll">
        <div class="menu-content">
            <ul class="nav">
                <a class="menu-logo" href="/admin">{{sConfig('web_name')}}</a>
                <li>
                    <a class="collapsed waves-attach waves-effect"  href="/admin/system">系统设置</a>

                </li>
                <li>
                    <a class="collapsed waves-attach waves-effect"  data-toggle="collapse"   href="#m-category">栏目导航</a>
                    <ul class="menu-collapse collapse in" id="m-category">
                        <li>
                            <a class="waves-attach waves-effect" href="/admin/category?pid=0&title=顶级目录">顶级目录</a>
                        </li>
                        @foreach(App\Category::where('pid','0')->get() as $cate)
                            <li>
                                <a class="waves-attach waves-effect" href="/admin/category?pid={{$cate->id}}&title={{$cate->cn_title}}">{{$cate->cn_title}}</a>
                            </li>
                        @endforeach
                    </ul>

                </li>
                <li>
                    <a class="collapsed waves-attach waves-effect" data-toggle="collapse" href="#ui_menu_samples">Sample Pages</a>
                    <ul class="menu-collapse collapse" id="ui_menu_samples">
                        <li>
                            <a class="waves-attach waves-effect" href="page-login.html">Login Page</a>
                        </li>
                        <li>
                            <a class="waves-attach waves-effect" href="page-picker.html">Picker Page</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>