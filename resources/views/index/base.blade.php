@extends('base')

@section('head')

    @parent

    <link rel="stylesheet" href="{{asset('css/index/styles.css')}}" />
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}" />

@endsection

@section('main')
    @include('addons.kefu')
    <nav>
        <div id="nav-wrapper">
            @foreach(getCate(0) as $cate)
                @if(!empty(\App\Category::where('pid',$cate->id)->first()->id))
                    <a href="/category/{{$cate->id}}" >
                        <p>{{$cate->en_title}}</p>
                        <p>{{$cate->cn_title}}</p>
                    </a>
                @endif
            @endforeach
            {{--<span></span>--}}
            <a href="/about" >
                <p>ABOUT</p>
                <p>关于</p>
            </a>

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

    {{--<div class="index-main">--}}
        @section('index-main')

        @show
    {{--</div>--}}

    @include('index.contact')

@endsection



@section('script')

    @parent

    <script src="{{asset('js/index/jquery.address-1.5.min.js')}}"></script>
    <script src="{{asset('js/index/modernizr.custom.33755.js')}}"></script>
    <script src="{{asset('js/index/gistfile1.js')}}"></script>
    <script src="{{asset('js/index/velocity.min.js')}}"></script>
    <script src="{{asset('js/index/common.js')}}"></script>
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>


@endsection