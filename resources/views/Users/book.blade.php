@extends('layouts.sidebar')

@section('style')
    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
        }


        .comment__container {
            display: none;
            position: relative;
        }

        .comment__container.opened {
            display: block;
        }

        .comment__container::before {
            content: "";
            background-color: rgb(170, 170, 170);
            position: absolute;
            min-height: 100%;
            width: 1px;
            left: -10px;
        }

        .comment__container:not(:first-child) {
            margin-left: 3rem;
            margin-top: 1rem;
        }

        .comment__card {
            padding: 20px;
            background-color: white;
            /* border: 1px solid rgba(0, 0, 0, 0.3); */
            border-radius: 0.5rem;
            min-width: 100%;
        }

        .comment__card h3,
        .comment__card p {
            margin-bottom: 1rem;
        }

        .comment__card-footer {
            display: flex;
            font-size: 0.85rem;
            opacity: 0.6;
            gap: 30px;
            justify-content: flex-end;
            align-items: center;
        }

        .show-replies {
            cursor: pointer;
        }

        .btnSubmitClass {
            background-color: rgba(255, 255, 255, 0);
            border: unset;
            color: #2f2f2f;
        }


        @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600&display=swap");

        :root {
            --Moderate-blue: hsl(238, 40%, 52%);
            --Soft-Red: hsl(358, 79%, 66%);
            --Light-grayish-blue: hsl(239, 57%, 85%);
            --Pale-red: hsl(357, 100%, 86%);

            --Dark-blue: hsl(212, 24%, 26%);
            --Grayish-Blue: hsl(211, 10%, 45%);
            --Light-gray: hsl(223, 19%, 93%);
            --Very-light-gray: hsl(228, 33%, 97%);
            --White: hsl(0, 0%, 100%);
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Rubik", sans-serif;
            font-size: 16px;
        }

        p {
            line-height: 1.5;
        }

        a {
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }

        button {
            cursor: pointer;
        }

        button:hover {
            filter: saturate(80%);
        }

        .bu-primary {
            background-color: var(--Moderate-blue);
            color: var(--White);
            border: none;
            padding: .75rem 1.5rem;
            border-radius: 4px;
        }

        .comment-section {
            padding: 0 1rem;
        }

        .comments-wrp {
            display: flex;
            flex-direction: column;
        }

        .comment-section {
            max-width: 75ch;
            margin: auto;
            margin-top: 1rem;
        }

        .comment {
            margin-bottom: 1rem;
            display: grid;
            grid-template-areas:
                "score user controls"
                "score comment comment"
                "score comment comment"
            ;
            grid-template-columns: auto 1fr auto;
            gap: 1.5rem;
            row-gap: 1rem;
            color: var(--Grayish-Blue);
        }

        .c-score {
            color: var(--Moderate-blue);
            font-weight: 500;
            grid-area: score;
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 1rem;
            padding: .75rem;
            padding-top: .5rem;
            width: 1rem;
            box-sizing: content-box;
            background-color: var(--Very-light-gray);
            border-radius: 8px;
            align-self: flex-start;
        }

        .score-control {
            width: 100%;
            cursor: pointer;
            object-fit: scale-down;
        }

        .c-text {
            grid-area: comment;
            width: 100%;
        }

        .c-user {
            width: 100%;
            grid-area: user;
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .usr-name {
            color: var(--Dark-blue);
            font-weight: 700;
        }

        .usr-img {
            height: 2rem;
            width: 2rem;
        }

        .c-controls {
            display: flex;
            gap: 1rem;
            color: var(--Moderate-blue);
            grid-area: controls;
            align-self: center;
            justify-self: flex-end;
        }

        .c-controls a {
            align-items: center;
        }

        .edit,
        .reply {
            color: var(--Moderate-blue);
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
        }

        .edit {
            border-radius: 10px;
            display: none;
        }

        .delete {
            color: var(--Soft-Red);
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            display: none;
            text-decoration: none;
        }

        .control-icon {
            margin-right: .5rem;
        }

        .replies {
            display: flex;
            margin-left: 2.5rem;
            padding-left: 2.4rem;
            border-left: 1px solid var(--Light-grayish-blue);
        }

        .reply-to {
            color: var(--Moderate-blue);
            font-weight: 500;
        }

        .reply-input {
            display: grid;
            margin-bottom: 1rem;
            grid-template-areas: "avatar input button";
            grid-template-columns: min-content auto min-content;
            justify-items: center;
            gap: 1rem;
            min-height: 9rem;
        }

        .reply-input img {
            grid-area: avatar;
            height: 2.5rem;
            width: 2.5rem;
        }

        .reply-input button {
            grid-area: button;
            align-self: flex-start;
        }

        .reply-input textarea {
            grid-area: input;
            padding: 1rem;
            width: 100%;
            border: 1px solid var(--Light-gray);
            border-radius: 4px;
            resize: none;
        }

        .this-user .usr-name::after {
            font-weight: 400;
            content: "you";
            color: var(--White);
            background-color: var(--Moderate-blue);
            padding: 0 .4rem;
            padding-bottom: .2rem;
            font-size: .8rem;
            margin-left: .5rem;
            border-radius: 2px;
        }

        .this-user .reply {
            display: none;
        }

        .this-user .edit,
        .this-user .delete {
            display: flex;
        }

        .modal-wrp {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, .3);
        }


        .invisible {
            display: none;
        }


        /* ||||||||||||||||||||||||||||||||||| */


        /* PRODUCTS */
        .product {
            position: relative;
            overflow: hidden;
            /* padding: 20px; */
        }

        .product-category {
            padding: 0 10vw;
            font-size: 30px;
            font-weight: 500;
            margin-bottom: 40px;
            text-transform: capitalize;
        }

        .product-container {
            padding: 0 10vw;
            display: flex;
            overflow-x: auto;
            overflow-y: hidden;
            scroll-behavior: smooth;
        }

        .product-container::-webkit-scrollbar {
            display: none;
        }

        .product-card {
            flex: 0 0 auto;
            width: 150px;
            height: 250px;
            margin-right: 20px;
        }

        .product-image {
            position: relative;
            width: 100%;
            height: 80%;
            overflow: hidden;
        }

        .product-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            width: 100%;
            height: 100px;
            padding-top: 10px;
        }

        .product-brand {
            text-transform: uppercase;
        }

        .product-short-description {
            width: 100%;
            height: 20px;
            color: #2f2f2f;
            overflow: hidden;
            opacity: 0.5;
            text-transform: capitalize;
            margin: 5px 0;
        }

        .pre-btn,
        .nxt-btn {
            border: none;
            width: 10vw;
            height: 100%;
            position: absolute;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, #fff 100%);
            cursor: pointer;
            z-index: 8;
        }

        .pre-btn {
            left: 0;
            transform: rotate(180deg);
        }

        .nxt-btn {
            right: 0;
        }

        .pre-btn i,
        .nxt-btn i {
            opacity: 0.2;
        }

        .pre-btn:hover i,
        .nxt-btn:hover i {
            opacity: 1;
        }

        .returnBtn {
            width: 50px;
            height: 50px;
            border: 1px solid rgb(93, 93, 93);
            border-radius: 100px;
        }

        .image-book-container img {
            width: 260px;
        }

        .detail_part_2 {
            position: relative;
            bottom: 80px;
        }

        .categori {
            border-radius: 100px !important;
            background: #545454;
        }

        .series-overlay {
            border-radius: 10px;
            position: relative;
            width: 100%;
            background-repeat: no-repeat;
            background-image: url("{{ asset('images/jioi.png') }}");
            background-size: 100% auto;
            background-position: 0 30%;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .overlay-content {
            padding: 10px;
            border-radius: 10px;
            background: #000000c1;
            height: 100%;
            width: 100%;
            backdrop-filter: blur(10px);
        }

        .clamped-lines {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }


        @media screen and (max-width:767.20px) {

            .replies {
                padding-left: 1rem;
                margin-left: .5rem;
            }

            .detail_part_2 {
                margin-top: 30px;
                bottom: 0px;
            }

            .comment {
                grid-template-areas:
                    "user user user"
                    "comment comment comment"
                    "score ... controls"
                ;

                gap: .5rem;
            }

            .c-score {
                flex-direction: row;
                width: auto;
            }

            .reply-input {
                grid-template-areas:
                    "input input input"
                    "avatar ... button"
                ;
                grid-template-rows: auto min-content;
                align-items: center;
                gap: .5rem;
            }

            .reply-input img {
                height: 2rem;
                width: 2rem;
            }

            .reply-input textarea {
                height: 6rem;
                padding: .5rem;
                align-self: stretch;
            }
        }
    </style>
@endsection


@section('body')
    <div class="container d-flex mt-5 return">
        <button class="returnBtn d-flex justify-center align-items-center">
            <i class='bx m-2 mt-1 mb-1 bx-md bx-right-arrow-alt bx-rotate-180'></i>
        </button>
    </div>
    <div class="container ">
        <div class="container p-0 border-b mt-5 mb-2">
            <div class="detail_part_1 row">
                <div class="col-12 col-md-5 ">
                    <div class="image-book-container d-flex justify-content-center " style="">
                        <div style="position:relative; z-index:1;">
                            <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                style="box-shadow: -30px 30px 20px 0 rgba(0, 0, 0, 0.2); border-radius:10px; "
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7 mt-md-0 mt-3 row">
                    <div class="sub-book-info-part-1 col-12">
                        <h1
                            style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: bold;">
                            Here the tiitle of this book it ame is somthing
                        </h1>
                    </div>
                    <div class="sub-book-info-part-2 col-12">
                        <div class="sub-sub-book-info-part-1 d-flex align-items-center">
                            <div class="part_1 d-flex justify-content-center ">
                                <div class="imageProfileCommentConatiner d-flex align-items-center justify-content-center"
                                    style="border-radius: 100px; width:50px; height:50px; overflow:hidden;">
                                    <img src="{{ asset('images/Screenshot 2023-11-24 175541.png') }}" height="100%"
                                        alt="">
                                </div>
                            </div>
                            <div class="part_3 m-3 mt-0 mb-0">
                                <div style="font-weight: bold;">HassanBookShop</div>
                                <div style="color: rgb(146, 146, 146);">23.2k subcribers</div>
                            </div>
                            <div class="part_2 m-4 mt-0 mb-0">
                                <button class="btn btn-secondary p-4 pt-2 pb-2"
                                    style="border-radius:100px; background:#272935;">Subscribe</button>
                            </div>
                        </div>
                        <div class="sub-sub-book-info-part-2">
                            {{-- here put the totale rate of tis mother fucker --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail_part_2 row card justify-content-end" style="">
                <div class="row p-0 m-0 mt-3">
                    <div class="col-12 col-md-5">
                    </div>
                    <div class="col-12 col-md-7 " style="height: 80px;">
                        <div class=" container d-flex justify-content-between align-content-center">
                            <div class="">
                                <button class="btn btn-secondary d-flex align-items-center p-4 pt-2 pb-2"
                                    style="border-radius:100px; background:#272935;">Start reading <i
                                        class='bx bx-sm bx-up-arrow-alt bx-tada bx-flip-horizontal'></i></button>
                            </div>
                            <div class="d-flex align-items-center">
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
                        <hr style="width: 100%">
                    </div>
                </div>
                <div class="col-12 row pt-0 p-3">
                    <div class="col-12 col-md-6 row">
                        <div class="col-12 infor-part mt-1">
                            <h4 style="font-weight: bold;">Description</h4>
                            <div class="peragraphe-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Vestibulum
                                non nisl vel elit volutpat aliquam eu eget elit. Integer cursus tellus ac odio cursus,
                                vel dignissim metus tincidunt. Sed vestibulum ex vel efficitur consectetur. In id
                                sollicitudin orci, in laoreet libero. Vivamus ultricies ligula quis est facilisis, at
                                pharetra turpis tempor. Sed consectetur, odio in vulputate lacinia, tortor felis cursus
                                arcu, at facilisis est quam nec mauris. Curabitur a neque at sem placerat volutpat.
                                Fusce quis odio a felis tincidunt vulputate. Integer ultrices tincidunt mauris, non
                                malesuada sem fermentum in. Sed laoreet vestibulum luctus. Nulla facilisi. Integer
                                malesuada, risus at fermentum cursus, ligula erat efficitur elit, a volutpat eros nisl
                                ac metus. Quisque vel magna in lectus gravida dapibus. Suspendisse tincidunt orci vel
                                justo bibendum euismod.
                            </div>
                        </div>
                        <div class=" col-12infor-part mt-5">
                            <h4 style="font-weight: bold;">Categories</h4>
                            <div class="peragraphe-category">
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                                <span class="btn btn-secondary categori p-3 m-2 pt-1 pb-1">categori</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 row">
                        <div class=" col-12 infor-part mt-1">
                            <h4 style="font-weight: bold;">Editors</h4>
                            <div class="peragraphe-text">
                                J.K. Rowling (author), Christopher Reath, Alena

                                Gestabon, Steve Korg
                            </div>
                        </div>
                        <div class="col-12 infor-part mt-5">
                            <h4 style="font-weight: bold;">Language</h4>
                            <div class="peragraphe-text">
                                Standard English (USA & UK)

                            </div>
                        </div>
                        <div class="col-12 infor-part mt-5">
                            <h4 style="font-weight: bold;">Paperback</h4>
                            <div class="peragraphe-text">

                                paper textured, full colour, 345 pages

                                ISBN: 987 3 32564 455 B

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="series-overlay shadow">
            <div class="overlay-content row">
                <div class="col-12 col-md-3 d-flex align-items-center justify-content-center" style="height:250px;">
                    <div style="height:90%;">
                        <img src="{{ asset('images/jioi.png') }}"
                            style=" overflow: hidden; border-radius:10px; "
                            alt="" height="100%">
                    </div>
                </div>
                <div class="col-12 col-md-9 mt-3 row">
                    <div class="col-12 ">
                        <div class="col-12 " style="color: #f2f2f2;">
                            <h1>Title of the series</h1>
                        </div>
                        <div class="col-12" style="color: #b7b7b7;">
                            <p class="clamped-lines">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse potenti. Vestibulum non nisl vel elit volutpat aliquam eu eget elit. Integer cursus tellus ac odio cursus, vel dignissim metus tincidunt. Sed vestibulum ex vel efficitur consectetur. In id sollicitudin orci, in laoreet libero. Vivamus ultricies ligula quis est facilisis, at pharetra turpis tempor. Sed consectetur</p>
                        </div>

                    </div>
                    <div class="col-12 d-flex align-items-end pb-3">
                        <div class="btn-container-serices">
                            <a href="/negaaa" class="btn btn-secondary d-flex align-items-center p-4 pt-2 pb-2"
                                style="border-radius:100px; background:#f2f2f2; color:#2f2f2f; font-weight:bold; ">View series <i class='bx bx-sm bx-up-arrow-alt bx-tada bx-flip-horizontal'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="container p-0 m-0 card border-b mt-5 mb-5" style="">
            <div class="Commenter_header_header m-5 mt-4  mb-0">
                <h3 style="font-weight: bold;">Similar Books </h3>
            </div>
            <div class="Commenter_header_body mb-3 mt-2">
                <section class="product">
                    <button class="pre-btn"><i class='bx bx-md bxs-chevron-left bx-rotate-180'></i></button>
                    <button class="nxt-btn"><i class='bx bx-md bxs-chevron-right'></i></button>
                    <div class="product-container">
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>
                        <div class="product-card ">
                            <div class="product-image" style="">
                                <img src="{{ asset('images/jioi.png') }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="">
                            </div>
                            <div class="product-info">
                                <p class="product-short-description">this book ids iugy ugui</p>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>

        <div class="container card border-b mt-5 mb-5" style="min-height: 500px;">
            <div class="Commenter_header_header mt-4 m-3 mb-0">
                <h3 style="font-weight: bold;">Comment Section </h3>
            </div>
            <div class="commenterInput d-flex container mt-4" style="width:100%; ">
                <div class="part_1 d-flex justify-content-center ">
                    <div class="imageProfileCommentConatiner d-flex align-items-center justify-content-center"
                        style="border-radius: 100px; width:40px; height:40px; overflow:hidden;">
                        <img src="{{ asset('images/Screenshot 2023-11-24 175541.png') }}" height="100%" alt="">
                    </div>
                </div>
                <div class="part_2 m-4 mt-0 mb-0" style="width:90% ">
                    <div class="subPart_commenter_part_input">
                        <div class="container mt-3 m-0 p-0 d-flex justify-content-between align-content-center">
                            <div class="form-group">
                                <input type="text" class="" placeholder="Add a comment . . ."
                                    style="border: unset;" id="textInput" oninput="handleInput(this.value)">
                            </div>

                            <button id="submitButton" class="btn btnSubmitClass" disabled>Submit</button>
                        </div>
                        <hr class="mt-1" style="width:100%; ">
                    </div>
                </div>
            </div>
            <div class="part_3 p-0 container mt-3">
                {{-- Comment-wrp is the main bodu and have 2 classes one for the commant and the other for the repliers (class : replay) --}}
                <div class="comment-wrp">
                    <div class="comment m-0 p-0 container">
                        <div class="c-controls">
                            <a class="delete p-2"><i class='bx bx-sm bxs-trash'></i>Delete</a>
                            <a class="edit p-2"><i class='bx bx-sm bxs-message-square-edit'></i>Edit</a>
                            <a class="reply p-2" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModalReply"><i class='bx bx-sm bxs-share'></i>Reply</a>
                        </div>
                        <div class="c-user">
                            <div class="imageProfileCommentConatiner d-flex align-items-center justify-content-center"
                                style="border-radius: 100px; width:40px; height:40px; overflow:hidden;">
                                <img src="{{ asset('images/Screenshot 2023-11-24 175541.png') }}" height="100%"
                                    alt="">
                            </div>
                            <p class="usr-name">maxblagun</p>
                            <p class="cmnt-at">2 weeks ago</p>
                        </div>
                        <p class="c-text m-2 mt-0 mb-0">
                            <span class="reply-to"></span>
                            <span class="c-body">Woah, your project looks awesome! How long have you been coding
                                for? I'm still new, but think I want to dive into React as well soon. Perhaps you
                                can give me an insight on where I can learn React? Thanks!</span>
                        </p>
                    </div>
                    <div class="replies comments-wrp">
                        <div class="comment-wrp">
                            <div class="comment m-0 p-0 container this-user">

                                <div class="c-controls">
                                    <a class="delete p-2 "><i class='bx bx-sm bxs-trash'></i>Delete</a>
                                    <a class="edit p-2 "><i class='bx bx-sm bxs-message-square-edit'></i>Edit</a>
                                    <a class="reply p-2 "><i class='bx bx-sm bxs-share'></i>Reply</a>
                                </div>
                                <div class="c-user">
                                    <div class="imageProfileCommentConatiner d-flex align-items-center justify-content-center"
                                        style="border-radius: 100px; width:40px; height:40px; overflow:hidden;">
                                        <img src="{{ asset('images/Screenshot 2023-11-24 175541.png') }}" height="100%"
                                            alt="">
                                    </div>
                                    <p class="usr-name">juliusomo</p>
                                    <p class="cmnt-at">2 days ago</p>
                                </div>
                                <p class="c-text">
                                    <span class="reply-to">@ramsesmiron</span>
                                    <span class="c-body">I couldn't agree more with this. Everything moves so fast
                                        and it always seems like everyone knows the newest library/framework. But
                                        the fundamentals are what stay constant.</span>
                                </p>
                            </div><!--comment-->
                            <div class="replies comments-wrp">
                                <!-- HERE u Put the comment replie (sub cmmenter) -->
                            </div><!--replies-->
                        </div>
                    </div><!--replies-->
                </div>


            </div>
        </div>
    </div>

    {{-- Modale --}}
    <div class="modal fade" id="exampleModalReply" tabindex="-1" aria-labelledby="exampleModalReplyLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalReplyLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script_2')
    <script>
        const productContainers = [...document.querySelectorAll('.product-container')];
        const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
        const preBtn = [...document.querySelectorAll('.pre-btn')];

        productContainers.forEach((item, i) => {
            let containerDimensions = item.getBoundingClientRect();
            let containerWidth = containerDimensions.width;

            nxtBtn[i].addEventListener('click', () => {
                item.scrollLeft += containerWidth;
            })

            preBtn[i].addEventListener('click', () => {
                item.scrollLeft -= containerWidth;
            })
        })
    </script>

    <script>
        const showContainers = document.querySelectorAll(".show-replies");

        showContainers.forEach((btn) =>
            btn.addEventListener("click", (e) => {
                let parentContainer = e.target.closest(".comment__container");
                let _id = parentContainer.id;
                if (_id) {
                    let childrenContainer = parentContainer.querySelectorAll(
                        `[dataset=${_id}]`
                    );
                    childrenContainer.forEach((child) => child.classList.toggle("opened"));
                }
            })
        );
    </script>
    <script>
        function submitReply() {
            const replyTextarea = document.getElementById('replyTextarea');
            const replyText = replyTextarea.value;

            // Perform any actions you need with the reply text, e.g., send it to the server

            // Close the modal
            $('#replyModal').modal('hide');

            // Optionally, you can clear the textarea
            replyTextarea.value = '';
        }
    </script>

    <script>
        function handleInput(value) {
            const submitButton = document.getElementById('submitButton');
            submitButton.disabled = !value.trim(); // Disable the button if the input is empty or contains only whitespace
            submitButton.classList.toggle('btn-primary', value
                .trim()); // Add success class if input is not empty, otherwise use primary class
        }
    </script>
@endsection
