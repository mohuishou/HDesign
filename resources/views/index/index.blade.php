@extends('base')

@section('head')

    @parent

    <link rel="stylesheet" href="{{asset('css/index/styles.css')}}" />
    <link rel="stylesheet" href="{{asset('css/index/home.css')}}" />

@endsection

@section('main')

    <div id="home-bgs-container">
        <div class="home-bg-container" id="home-bg-container-static">
            <img src="" alt="" />
            <h3></h3>
        </div>
        <div class="home-bg-container" id="home-bg-container-animated">
            <img src="" alt="" />
            <h3></h3>
        </div>
        <div id="home-bgs-timers">
            <div class="home-bg-timer" id="home-bg-timer-1">
                <div class="home-bg-timer-wrapper"></div>
            </div>
            <div class="home-bg-timer" id="home-bg-timer-2">
                <div class="home-bg-timer-wrapper"></div>
            </div>
            <div class="home-bg-timer" id="home-bg-timer-3">
                <div class="home-bg-timer-wrapper"></div>
            </div>
            <div class="home-bg-timer" id="home-bg-timer-4">
                <div class="home-bg-timer-wrapper"></div>
            </div>
            <div class="home-bg-timer" id="home-bg-timer-5">
                <div class="home-bg-timer-wrapper"></div>
            </div>
        </div>
    </div>
    <nav>
        <div id="nav-wrapper">
            <a href="showcase.html" >SHOWCASE</a>
            <span></span>
            <a href="about.html" >ABOUT</a>
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
    <div id="home-cover">
        <img src="{{asset('images/index/logo_splash.png')}}"/>

    </div>
    <div id="header-border-top"></div>

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
    <script src="{{asset('js/index/home.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Global variables
            homeImageCount = '{{count($sliders)}}'; // Max 5

            @foreach($sliders as $k=> $slider )
                homeImage{{$k+1}}File ='{{asset(getPic($slider->albums->cover))}}';
                homeImage{{$k+1}}Title ='{{$slider->albums->en_name}}';
                homeImage{{$k+1}}FileWidth = '1000';
                homeImage{{$k+1}}FileHeight = '667';
                homeImage{{$k+1}}Link = 'case_study.html-id=117.htm';
            @endforeach


            // Mouse events
            // Set-up
            // Mobile set-up
            if (touchScreen) {
            }
        });
    </script>

@endsection