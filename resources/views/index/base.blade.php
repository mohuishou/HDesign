@extends('base')

@section('head')

    @parent

    <link rel="stylesheet" href="{{asset('css/index/styles.css')}}" />

@endsection

@section('main')
    <nav>
        <div id="nav-wrapper">
            <a href="showcase.html" >
                <p>SHOWCASE</p>
                <p>案例展示</p>

            </a>
            <span></span>
            <a href="about.html" >
                <p>ABOUT</p>
                <p>关于</p>
            </a>
            <span></span>
            <a href="culture.html">CULTURE</a>
        </div>
    </nav>
    <header>
        <a href="javascript:headerLogoClick();" id="header-logo">
            <img src="{{asset('images/index/logo_header.png')}}"/>
        </a>
        <a href="javascript:openNav();" id="header-menu">
			<span id="menu-icon">
				<span></span>
			</span>
            <span id="menu-text">MENU</span>
        </a>
        <a href="javascript:openContact();" id="header-contact">
            <img src="{{asset('images/index/icon_phone.png')}}"/>
            <span>CONTACT</span>
        </a>
    </header>
    <div id="header-border-top"></div>

    <div class="index-main">
        @section('index-main')

        @show
    </div>

    @include('index.contact')

@endsection



    @section('script')

    @parent
            <!--[if lt IE 9]>
        <!--<script src="../html5shiv.googlecode.com/svn/trunk/html5.js" ></script>-->
    <![endif]-->
    <script src="{{asset('js/index/jquery.address-1.5.min.js')}}"></script>
    <script src="{{asset('js/index/modernizr.custom.33755.js')}}"></script>
    <script src="{{asset('js/index/gistfile1.js')}}"></script>
    <script src="{{asset('js/index/velocity.min.js')}}"></script>
    <script src="{{asset('js/index/common.js')}}"></script>


@endsection