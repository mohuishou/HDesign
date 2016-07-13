@extends('index.base')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('css/index/album/styles.css')}}">

@endsection

@section('index-main')

    <div id="left_col">
        <div class="portlet" id="yw0">
            <div class="portlet-decoration">
                <div class="portlet-title">{{$category->en_title}}<span>{{$category->cn_title}}</span></div>
            </div>
            <div class="portlet-content">
                <ul class="operations" id="left_menu">
                    @foreach($category_two as $cate_two)
                        <li>
                            <a href="/category/{{$cate_two->id}}">{{$cate_two->en_title}}:{{$cate_two->cn_title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="left_col_bg"></div>

    <div id="wrapper">
        <div id="project_list">
            <div id="slider_box">
                <div id="slider">
                    <ul>
                    </ul>
                </div>
            </div>
            <div id="project_items">
                @foreach($albums as $album)
                    <div class="project_item">
                        <a href="/album/{{$album->id}}">
                            <div class="projects-thumb">
                                <img class="dark" src="{{asset(getPic($album->cover))}}"/>
                                <img class="color" style="display: none;" src="{{asset(getPic($album->cover))}}"/>
                            </div>
                            <div style="text-align: center;" class="projects-info">
                                <p>{{$album->en_title}}/{{$album->cn_title}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>


    </div>

   @include('index.footer')

@endsection

@section('script')
    @parent
    <script src="{{asset('js/index/album/easySlider1.7.5.js')}}"></script>
    <script src="{{asset('js/index/album/grayscale.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            col = Math.floor($('#project_list').width() / 326);
            row = Math.floor(($(window).height() - 160) / 250);
            if (col < 2) {
                col = 2;
            } else if (col > 3) {
                col = 3;
            }
            if (row < 1) {
                row = 1;
            } else if (row > 3) {
                row = 3;
            }
            page_total = col * row;
            a = 0;
            b = 1;
            $('#project_items .project_item').each(function (index) {
                if (a == 0) {
                    $('#slider ul').append('<li><div id="box' + b + '"></div></li>');
                }
                $(this).clone().appendTo('div#box' + b);
                a++;
                if (a == page_total) {
                    $('div#box' + b).append('<div class="clear"></div>');
                    a = 0;
                    b++;
                } else if ($('#project_items .project_item').length == (index + 1)) {
                    $('div#box' + b).append('<div class="clear"></div>');
                }
            });
            $('#slider li, #slider, #slider_box').width(col * 326);
            $('#slider li, #slider, #slider_box').height(row * 250);
            $("#slider").easySlider({
                "controlsShow":false
            });
        });
        $(window).load(function () {
            grayscale($("#slider img.dark"));

            if ($('#slider li').length == 1) {
                $('#prevBtn').hide();
                $('#nextBtn').hide();
            }

            $('#slider .project_item').hover(
                    function () {
                        $(this).find('img.dark').hide();
                        $(this).find('img.color').show();
                    }, function () {
                        $(this).find('img.dark').show();
                        $(this).find('img.color').hide();
                    }
            );
        });
    </script>
@endsection
