<header class="header header-transparent header-waterfall ui-header affix">
    <ul class="nav nav-list pull-left">
        <li>
            <a data-toggle="menu" href="#ui_menu">
                <span class="icon icon-lg">menu</span>
            </a>
        </li>
    </ul>
    <a class="header-logo header-affix-hide margin-left-no margin-right-no affix" data-offset-top="213" data-spy="affix" href="/">{{sConfig('web_name')}}</a>
    <span class="header-logo header-affix margin-left-no margin-right-no affix" data-offset-top="213" data-spy="affix">{{isset($title)?$title:""}}|{{sConfig('web_name')}}</span>
    <ul class="nav nav-list pull-right">
        <li class="dropdown margin-right">
            <a class="dropdown-toggle padding-left-no padding-right-no" data-toggle="dropdown">
                <span class="access-hide">John Smith</span>
                <span class="avatar avatar-sm"><img alt="alt text for John Smith avatar" src="{{ asset('images/users/avatar-001.jpg') }}"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">

                <li>
                    <a class="padding-right-lg waves-attach waves-effect" href="/admin/logout"><span class="icon icon-lg margin-right">exit_to_app</span>Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</header>