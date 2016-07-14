@extends('index.base')

@section('head')

    @parent

    <link rel="stylesheet" href="{{asset('css/index/about.css')}}"/>
    <style id="style-1-cropbar-clipper">/* Copyright 2014 Evernote Corporation. All rights reserved. */
        .en-markup-crop-options {
            top: 18px !important;
            left: 50% !important;
            margin-left: -100px !important;
            width: 200px !important;
            border: 2px rgba(255, 255, 255, .38) solid !important;
            border-radius: 4px !important;
        }

        .en-markup-crop-options div div:first-of-type {
            margin-left: 0px !important;
        }
    </style>
@endsection
@section('index-main')

    <div id="about-leadership-container" class="about-container" style="display: block;">
        <div class="about-text-container" style="width: 100%;">
            <h3 style="padding: 25px;">About HDESIGN</h3>
            <p style="padding: 0px 25px 25px;">About HDESIGN<br />
                ‘HDesign’和点设计, 由上海室内设计师合作创办。<br />
                在相近的价值观和追求生活美学的驱使下走到了一起。<br />
                志在将时尚与舒适的美学概念导入人们日常的生活和工作空间中，美，是一种态度，它应该成为习惯。如今人们注重穿衣搭配，关注“巴黎时装秀”，穿衣美学与舒适度已成为人们出行的基础，成为个人品位与身份的象征。<br />
                而“HDesign”则想要将美观、舒适与艺术融入人们的生活中，与人们的习惯与修养互相依托，引领健康又高品质的工作和生活文化。<br />
                我们坚信，每个空间都有它的故事。在和点设计成就的空间里，你可以体验到的不只是气质……<br />
                Hdesign能够为追求空间舒适感的您提供全方位的服务。<br />
                我们认为，前期沟通是构建完美空间的基石，人性化的设计如同量体裁衣，需要了解您对于空间使用功能的需求、生活工作习惯、个人爱好和对视觉风格的大致设想，然后根据空间的原始结构作出平面调整和立面或三维的设计。<br />
                到了设计后期，Hdesign将继续与您共同选择优质材料，最高程度保证您的空间品质。<br />
            </p>

        </div>
        <div class="about-image-container" style="display: none;">
            <img src="{{asset('images/about/1.png')}}" alt="" class="animate-fade-in-1"
                 style="display: inline; height: 1200px; width: 960px; top: -159px; left: 0px;">
        </div>
    </div>
    <div id="about-foundation-container" class="about-container animate-fade-out-1" style="display: none;">
        <div class="about-image-container" style="display: none;">
            <img src="http://www.yabupushelberg.com/content/img/08OR3.jpg" alt="" class="animate-fade-in-1"
                 style="display: inline; height: 1195.2px; width: 960px; top: -156px; left: 0px;">
        </div>
        <div class="about-text-container" style="width: 100%; left: 0px;">
            <h3 style="padding: 25px;">FOUNDATION</h3>
            <p style="padding: 0px 25px 25px;">YP is a collaborative practice that forges clearly articulated,
                meaningful ideas, with innovation, purpose, youth and experience.<br><br>Brought together
                serendipitously on the hunt for studio space over 30 years ago, founders George Yabu and Glenn
                Pushelberg found in each other an affinity for taking risks and presenting a strong point of view. The
                pair’s multidisciplinary approach was and is informed by an endless curiosity and driven by partnerships
                with thoughtful, creative like-minded people. Often taking them to faraway places before the concept of
                a global design firm really existed. <br><br>Evolving to encompass all aspects of design, each project
                reflects an edited approach that transcends trends. With studios in Toronto and New York, and current
                projects in over 16 countries, the same attention to detail and spirit of exploration remains a hallmark
                of the firm. Experimentation with materials, independent artists and artisans continues in a diversely
                talented collective under the guidance of founders George Yabu and Glenn Pushelberg and partners
                Johnathan Garrison and Shirlane Teh.<br><br>Over the years, Yabu Pushelberg has worked with some of the
                world’s leading innovators in the retail, hotel and hospitality industries. Increasingly, as Producers
                of visionary projects, George and Glenn continue to lead and inspire those around them, harnessing the
                creative potential of each new venture. The best projects, after all, are those that are ‘invented’.</p>

        </div>
    </div>
    <div id="sub-nav" class="animate-margin-top-05" style="margin-top: 0px;">
        <a href="javascript:showMobileSubNavAbout();" id="sub-nav-mobile"
           style="display: block; width: 100%; margin-left: 0px; margin-right: 0px; margin-top: 15px; padding-bottom: 15px; background-color: rgb(255, 255, 255);">
            <span>About HDESIGN</span>
        </a>
        <a href="javascript:swapAboutPage('leadership');" id="sub-nav-leadership" style="color: rgb(51, 51, 255); display: none; width: 100%; margin-left: 0px; margin-right: 0px; margin-top: 0px; padding-bottom: 15px; background-color: rgb(255, 255, 255);">
            About HDESIGN
        </a>
        {{--<a href="javascript:swapAboutPage('foundation');" id="sub-nav-foundation" style="display: none; width: 100%; margin-left: 0px; margin-right: 0px; margin-top: 0px; padding-bottom: 15px; background-color: rgb(255, 255, 255);">--}}
            {{--FOUNDATION--}}
        {{--</a>--}}
    </div>

@endsection

@section('script')
    @parent
    <script src="{{asset('js/index/about.js')}}"></script>
@endsection
