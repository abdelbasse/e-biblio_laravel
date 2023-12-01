@extends('layouts.sidebar')

@section('style')
    <style>
        .clamped-lines {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: all 0.6 ease-out;
        }

        .clamped-lines-2 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .book-card-solo:hover {
            background-color: #f3f3f36b;
        }

        .input-box {
            position: relative;
            border-radius: 8px;
        }

        .input-box i {
            left: 20px;
            font-size: 30px;
            color: #707070;
        }

        .input-box input {
            height: 100%;
            width: 70%;
            outline: none;
            font-size: 18px;
            font-weight: 400;
            border: none;
            background-color: transparent;
        }

        /*||||||||||||||||||||||||||||||||||||||||||||||||  */
        .scrollable-content {
            overflow-y: scroll;
            max-height: 500px;
            /* Adjust the max-height as needed */
            scrollbar-width: thin;
            /* Customize scrollbar appearance for Firefox */
            scrollbar-color: transparent transparent;
        }

        /* Customize scrollbar appearance for Webkit browsers (Chrome, Safari) */
        .scrollable-content::-webkit-scrollbar {
            width: 12px;
        }

        .scrollable-content::-webkit-scrollbar-thumb {
            background-color: transparent;
        }
    </style>
@endsection



@section('body')
    <div class="container p-0 mt-1 justify-content-center mb-5">
        <div class="container mt-3 mb-4 ">
            <h2 style="font-weight: bold;">Watch history</h2>
        </div>
        <div class="container ">
            <div class=" row ">
                <div class="col-12 col-md-8 pt-3 scrollable-content" style="overflow-y: auto; max-height: 500px;">
                    <h4 class="mb-3" style="font-weight: bold;">Today</h4>
                    <a style="text-decoration: none; color:unset; cursor: pointer;" class="col-12 mb-3 book-card-solo">
                        <div class="product-card pb-0 mb-0 d-flex">
                            <div class="product-image" style="height: 200px;">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="overflow: hidden; border-radius:10px; " height="90%" alt="">
                            </div>
                            <div class=" m-4 mt-0 mb-0">
                                <div class="col-12 ">
                                    <div class="col-12 " style="">
                                        <h2>Title of the series</h2>
                                    </div>
                                    <div class="col-12" style="">
                                        <p class="clamped-lines">Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit.
                                            Suspendisse potenti. Vestibulum non nisl vel elit volutpat aliquam eu eget
                                            elit.
                                            Integer
                                            cursus tellus ac odio cursus, vel dignissim metus tincidunt. Sed vestibulum
                                            ex
                                            vel
                                            efficitur consectetur. In id sollicitudin orci, in laoreet libero. Vivamus
                                            ultricies
                                            ligula quis est facilisis, at pharetra turpis tempor. Sed consectetur</p>
                                    </div>
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
                        </div>
                    </a>
                    <a style="text-decoration: none; color:unset; cursor: pointer;" class="col-12 mb-3 book-card-solo">
                        <div class="product-card pb-0 mb-0 d-flex">
                            <div class="product-image" style="height: 200px;">
                                <div style="height: 100%;">
                                    <div style="height: 0px;">
                                        <img src="{{ asset('images/jioi.png') }}" class="product-thumb"
                                            style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: -2px; top: 25px; left: 40%; position: relative; filter: blur(3px);"
                                            alt="" width="70%">
                                    </div>
                                    <div style="height: 0px;">
                                        <img src="{{ asset('images/jioi.png') }}" class="product-thumb"
                                            style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: -1px; top: 15px; left: 25%; position: relative; filter: blur(1px);"
                                            alt="" width="80%">
                                    </div>
                                    <div>
                                        <img src="{{ asset('images/jioi.png') }}" class="product-thumb"
                                            style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: 0; top: -60%; position: relative;"
                                            alt="" width="100%">
                                    </div>
                                </div>
                            </div>
                            <div class=" m-4 mt-0 mb-0">
                                <div class="col-12 ">
                                    <div class="col-12 " style="">
                                        <h2>Title of the series</h2>
                                    </div>
                                    <div class="col-12" style="">
                                        <p class="clamped-lines">Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit.
                                            Suspendisse potenti. Vestibulum non nisl vel elit volutpat aliquam eu eget
                                            elit.
                                            Integer
                                            cursus tellus ac odio cursus, vel dignissim metus tincidunt. Sed vestibulum
                                            ex
                                            vel
                                            efficitur consectetur. In id sollicitudin orci, in laoreet libero. Vivamus
                                            ultricies
                                            ligula quis est facilisis, at pharetra turpis tempor. Sed consectetur</p>
                                    </div>
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
                        </div>
                    </a>

                </div>
                <div class="col-12 col-md-4 p-5 pt-1" style="position: sticky; top: 0;">
                    <div class="search-container mt-5 pt-5">
                        <div class="input-box d-flex align-items-center justify-content-between">
                            <div class="d-flex  align-items-center">
                                <i class='bx bx-sm bx-search' style="margin-right: 10px;"></i>
                                <input type="text" placeholder="Search here..." />
                            </div>
                        </div>
                        <hr class="p-0 m-0 mt-1" style="width: 100%;">
                    </div>
                    <div class="container d-flex p-0">
                        <button class=" btnContainer p-3 pt-1 pb-1 d-flex align-items-center mt-3"
                            style=" border-radius: 100px; border: 1px solid gray;">
                            <i class='bx bx-sm bx-trash' style="margin-right: 10px;"></i>
                            <div>Clear all watch history</div>
                        </button>
                    </div>
                    <div class="container d-flex p-0">
                        <button class=" btnContainer p-3 pt-1 pb-1 d-flex align-items-center mt-3"
                            style=" border-radius: 100px; border: 1px solid gray;">
                            <i class='bx bx-sm bx-pause' style="margin-right: 10px;"></i>
                            <div>Pause watch history</div>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



@section('script_2')
@endsection
