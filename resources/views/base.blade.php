{{--基础框架结构--}}
<!doctype html>
<html lang="en">
    <head>
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" name="viewport">
        <title>{{isset($title)?$title:""}}|{{sConfig('web_name')}}</title>
        <link rel="stylesheet" href="{{ asset('css/base.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.css') }}">
        @section('head')
        @show

    </head>
    <body>
        @section('main')
        @show

        <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/base.min.js') }}"></script>
        @section('script')
        @show

    </body>
</html>