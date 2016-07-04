@extends('admin.base')
@section('head')
    @parent
    <style>
        body{
            height: 200%;
        }
        .header{
            background: #3f51b5;
        }

        #main{
            margin-top: 60px;
        }
        #main h1{
            text-align: center;
        }
        .card-action button{
           height: 47px;
        }
    </style>
    @endsection
@section('admin-main')
    <div></div>
@endsection
