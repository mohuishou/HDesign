@extends('base')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/base.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <style>
        .header{
            background: #3f51b5;
        }

        .admin-main{
            margin-top: 60px;
        }
        .admin-main h2{
            text-align: center;
        }
    </style>
@endsection
@section('main')
<div class="container-full page-brand">
    @include('admin.header')
    @include('admin.sidebar')

    @section('admin-main')
    @show

    @include('admin.footer')
</div>
@endsection

@section('script')

    @parent
    <script src="{{ asset('js/base.min.js') }}"></script>
@endsection

