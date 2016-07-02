@extends('base')
@section('head')
    <style>
        .header{
            background: #3f51b5;
        }

        .admin-main{
            margin-top: 60px;
        }
        .admin-main h1{
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

