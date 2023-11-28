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

        .book-card-solo:hover{
            background-color: #f3f3f36b;
        }
    </style>
@endsection



@section('body')
    <div class="container m-0 p-0 mt-5 justify-content-center mb-5">
        <div class="container m-3 mb-4 ">
            <h3 style="font-weight: bold;">Title</h3>
        </div>
        <div class="row p-0 m-0">
            <div class="col-12  col-md-4 p-5 pt-1">
                <div class="d-flex justify-content-center" style="height:350px; width:100%;">
                    <div style="height:90%;" class=" shadow">
                        <img src="{{ asset('images/jioi.png') }}" style=" overflow: hidden; border-radius:10px; "
                            alt="" height="100%">
                    </div>
                </div>
                <div class="p-2">
                    <div class="col-12" style="">
                        <p class="clamped-lines-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Suspendisse potenti. Vestibulum non nisl vel elit volutpat aliquam eu eget elit.
                            Integer
                            cursus tellus ac odio cursus, vel dignissim metus tincidunt. Sed vestibulum ex vel
                            efficitur consectetur. In id sollicitudin orci, in laoreet libero. Vivamus ultricies
                            ligula quis est facilisis, at pharetra turpis tempor. Sed consectetur</p>
                    </div>
                </div>
                <div class=" d-flex " style="width: 100%;">
                    <div class="d-flex mt-3 mb-4">
                        <!-- Install button -->
                        <button class="btn d-flex justify-content-center align-items-center m-1"
                            style="border-radius: 100px; border:1px solid rgb(151, 151, 151); width:40px; height:40px;">
                            <i class='bx bx-sm bx-bookmark bx-flip-horizontal'></i>
                        </button>
                        <!-- Share button -->
                        <button class="btn d-flex justify-content-center align-items-center m-1"
                            style="border-radius: 100px; border:1px solid rgb(151, 151, 151); width:40px; height:40px;">
                            <i class='bx bx-share bx-sm'></i>
                        </button>
                        <!-- Save button -->
                        <button class="btn d-flex justify-content-center align-items-center m-1"
                            style="border-radius: 100px; border:1px solid rgb(151, 151, 151); width:40px; height:40px;">
                            <i class='bx bx-heart bx-sm'></i>
                        </button>
                        <!-- Like button -->
                        <button class="btn d-flex justify-content-center align-items-center m-1"
                            style="border-radius: 100px; border:1px solid rgb(151, 151, 151); width:40px; height:40px;">
                            <i class='bx  bx-sm bx-download bx-flip-horizontal'></i>
                        </button>
                    </div>
                </div>
                <div class="sub-sub-book-info-part-1 d-flex align-items-center">
                    <div class="part_1 d-flex justify-content-center ">
                        <div class="imageProfileCommentConatiner d-flex align-items-center justify-content-center"
                            style="border-radius: 100px; width:50px; height:50px; overflow:hidden;">
                            <img src="{{ asset('images/Screenshot 2023-11-24 175541.png') }}" height="100%" alt="">
                        </div>
                    </div>
                    <div class="part_3 m-2 mt-0 mb-0">
                        <div style="font-weight: bold;">HassanBookShop</div>
                        <div style="color: rgb(146, 146, 146);">23.2k subcribers</div>
                    </div>
                    <div class="part_2 m-4 mt-0 mb-0" style="margin-right: 0px !important;">
                        <button class="btn btn-secondary p-4 pt-2 pb-2"
                            style="border-radius:100px; background:#272935;">Subscribe</button>
                    </div>
                </div>
            </div>
            <div class="col-12 row col-md-8 pt-3" style="background:rgba(225, 225, 225, 0.556);">
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
                                    <p class="clamped-lines">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Suspendisse potenti. Vestibulum non nisl vel elit volutpat aliquam eu eget elit.
                                        Integer
                                        cursus tellus ac odio cursus, vel dignissim metus tincidunt. Sed vestibulum ex vel
                                        efficitur consectetur. In id sollicitudin orci, in laoreet libero. Vivamus ultricies
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
                    <hr width="90%" class="m-0 p-0 mt-1">
                </a><a style="text-decoration: none; color:unset; cursor: pointer;" class="col-12 mb-3 book-card-solo">
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
                                    <p class="clamped-lines">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Suspendisse potenti. Vestibulum non nisl vel elit volutpat aliquam eu eget elit.
                                        Integer
                                        cursus tellus ac odio cursus, vel dignissim metus tincidunt. Sed vestibulum ex vel
                                        efficitur consectetur. In id sollicitudin orci, in laoreet libero. Vivamus ultricies
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
                    <hr width="90%" class="m-0 p-0 mt-1">
                </a><a style="text-decoration: none; color:unset; cursor: pointer;" class="col-12 mb-3 book-card-solo">
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
                                    <p class="clamped-lines">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Suspendisse potenti. Vestibulum non nisl vel elit volutpat aliquam eu eget elit.
                                        Integer
                                        cursus tellus ac odio cursus, vel dignissim metus tincidunt. Sed vestibulum ex vel
                                        efficitur consectetur. In id sollicitudin orci, in laoreet libero. Vivamus ultricies
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
                    <hr width="90%" class="m-0 p-0 mt-1">
                </a>
            </div>
        </div>
    </div>
@endsection



@section('script_2')
@endsection
