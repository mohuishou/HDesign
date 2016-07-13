@extends('index.base')

@section('head')

    @parent

    <link rel="stylesheet" href="{{asset('css/index/home.css')}}" />

@endsection

@section('index-main')

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

    <div id="home-cover">
        <img class="cover-1" src="{{asset('images/index/logo_splash_1.png')}}"/>
        <img class="cover-2" src="{{asset('images/index/logo_splash_2.png')}}"/>
    </div>

@endsection



@section('script')

    @parent

    <script src="{{asset('js/index/home.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Global variables
            homeImageCount = '{{count($sliders)}}'; // Max 5

            @foreach($sliders as $k=> $slider )
                homeImage{{$k+1}}File ='{{asset(getPic($slider->albums->cover))}}';
                homeImage{{$k+1}}Title ='{{$slider->albums->en_title}}/{{$slider->albums->cn_title}}';
                homeImage{{$k+1}}FileWidth = '1000';
                homeImage{{$k+1}}FileHeight = '667';
                homeImage{{$k+1}}Link = "./album/{{$slider->aid}}";
            @endforeach


            // Mouse events
            // Set-up
            // Mobile set-up
            if (touchScreen) {
            }
        });
    </script>

@endsection