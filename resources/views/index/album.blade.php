@extends('index.base')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('css/index/album/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/index/album/slideshow.css')}}">

@endsection

@section('index-main')
    <div class="container" id="page">
        <div id="content">

            <div id="project_image">
                <div id="btn-back">
			<span class="inner">
				<a href="/">Back to Projects</a>
			</span>
                </div>
                <div class="image_load"><img src="{{asset('images/loader.gif')}}"></div>
                <div id="slider">
                    <ul>
                        @foreach($pictures as $picture)
                            <li class="main">
                                <a href="#"></a>
                                <img src="{{asset(getPic($picture->id))}}" data-content="">
                            </li>
                        @endforeach

                    </ul>
                    <div class="buttons"></div>
                </div>
                <div class="info">
                    <div class="inner">
                        <div class="left_col">
                            <div class="title">{{$album->en_title}}<span>{{$album->cn_title}}</span></div>
                            <div class="year">{{$album->description}}</div>
                        </div>
                        <div class="right_col">
                            <p></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('index.footer')

@endsection

@section('script')
    @parent
    <script src="{{asset('js/index/album/slideshow.js')}}"></script>
    <script src="{{asset('js/index/album/common.js')}}"></script>
    <script src="{{asset('js/index/album/easySlider1.7.5.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            sliderImage = $(window).height() - 120 - 160;
            $('#slider img').height(sliderImage);
            $('#slider ul').height(sliderImage);
            $('#slider li').height(sliderImage);
            $('#content').css({'margin': '0'});
            $('li.hv_video a').click(function (event) {
                event.preventDefault();
                $p = $(this).parent('li.hv_video');
                $p.find('div.ivideo').show();
            });

            /*var imagesLoaded = 0;
             $('#slider img').load(function() {
             imagesLoaded++;
             if (imagesLoaded == $('#slider img').length) {
             $('#slider img').show();
             }
             });*/
        });


        $(window).load(function () {
            $('#slider li').each(function (index) {
                iwidth = $(this).find('img').width();
                iheight = $(this).find('img').height();
                $(this).find('iframe').attr('height', iheight);
                $(this).find('iframe').attr('width', iwidth);
                $(this).find('embed').attr('height', iheight);
                $(this).find('embed').attr('width', iwidth);
                $(this).find('object').attr('height', iheight);
                $(this).find('object').attr('width', iwidth);
                $(this).find('param').attr('height', iheight);
                $(this).find('param').attr('width', iwidth);
            });
            $('#slider img').show();
            $('.image_load').hide();
            $('#slider ul').height('auto');
            $("#slider").easySlider({
                continuous: true,
                prevText: '',
                nextText: '',
                allControls: true
            });
        });
    </script>
@endsection