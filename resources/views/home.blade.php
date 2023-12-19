@extends('layouts.sidebar')

@section('style')
    <style>
        .book-card-solo {
            width: 190px;
        }

        .title-limit {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection



@section('body')
    <div class="container p-0 mt-1 justify-content-center mb-5">
        <div class="container mt-5 p-0 d-flex flex-wrap">

            <a style="text-decoration: none; color:unset;" class="book-card-solo m-2 row " href="@@">
                <div class="col-12" style="width: 100%;">
                    <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                        style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                        alt="" width="100%">
                </div>
                <div class="col-12 mt-2">
                    <div class="">
                        <h5 class="title-limit">Title of this book ihdw widhwi wkdjw</h5>
                    </div>
                    <div class="d-flex align-items-center " style="color:gray !important;">
                        <div class="m-1 mt-0 mb-0">
                            25.3k views
                        </div>
                        .
                        <div class="m-1 mt-0 mb-0">
                            2h ago
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>
@endsection



@section('script_2')
@endsection
