{{--基础框架结构--}}
<!doctype html>
<html lang="en">
    <head>
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" name="viewport">
        <meta name="description" content="{{sConfig('web_description')}}" />
        <meta name="keywords" content="{{sConfig('web_keywords')}}" />
        <meta name="author" content="mohuishou" />
        <meta property="og:title" content="{{isset($title)?$title:""}}|{{sConfig('web_name')}}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="{{sConfig('web_name')}}" />
        <meta property="og:description" content="{{sConfig('web_description')}}" />
        <title>{{isset($title)?$title:""}}|{{sConfig('web_name')}}</title>
        {{--统计代码--}}

            {!! html_entity_decode(sConfig('web_statistics')) !!}
        
        @section('head')
        @show

    </head>
    <body>
        @section('main')
        @show

        <script src="{{asset('js/jquery.min.js')}}"></script>

        @section('script')
        @show

    </body>
</html>