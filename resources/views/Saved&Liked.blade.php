@extends('layouts.sidebar')

@section('style')
    <style>
        .profile-image {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: rgb(222, 222, 222);
            border-radius: 20px;
            height: 200px;
        }

        .fixed-navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #ffffff;
            z-index: 1000;
        }

        nav ul li {
            display: inline-block;
            list-style: none;
            padding: 0 10px;
            margin: 0 20px;
            font-weight: bold;
            color: rgb(153, 153, 153);
            cursor: pointer;
            position: relative;
        }

        nav ul .active-menu {
            color: #2f2f2f;
        }

        nav ul .active-menu::after {
            width: 100%;
        }

        nav ul li:after {
            content: '';
            width: 0;
            height: 3px;
            background: #2192ff;
            position: absolute;
            left: 0;
            bottom: -10px;
            transition: 0.5s;
        }

        nav ul li:hover::after {
            width: 100%;
        }

        /* |||||||||||||||||||| search  */
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

        /* |||||||||||||||||||| end search */


        .book-card-solo {
            width: 190px;
        }

        .title-limit {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* |||||||||||||||||||||||||||||||||||| form book cover input START*/
        .drag-area {
            border: 2px dashed #fff;
            height: 500px;
            width: 700px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .drag-area.active {
            border: 2px solid #fff;
        }

        .drag-area .icon {
            font-size: 100px;
            color: #fff;
        }

        .drag-area header {
            font-size: 30px;
            font-weight: 500;
            color: #fff;
        }

        .drag-area span {
            font-size: 25px;
            font-weight: 500;
            color: #fff;
            margin: 10px 0 15px 0;
        }

        .drag-area button {
            padding: 10px 25px;
            font-size: 20px;
            font-weight: 500;
            border: none;
            outline: none;
            background: #fff;
            color: #5256ad;
            border-radius: 5px;
            cursor: pointer;
        }

        .drag-area img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .categori {
            color: white;
            cursor: pointer;
            border-radius: 100px !important;
            background: #545454;
        }

        /* |||||||||||||||||||||||||||||||||||| form book cover input END*/
    </style>
    <style>
        .multiselect {
            width: 100%;
            position: relative;
            display: inline-block;
        }

        .select-box {
            padding: 8px;
            margin: 10px;
            border: 1px solid #ced4da;
            cursor: pointer;
        }

        .tag-list {
            list-style: none;
            padding: 0;
            margin: 0;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            z-index: 1;
            background-color: #fff;
            border: 1px solid #ced4da;
            overflow: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-height: 200px;
            overflow-y: auto;
        }

        .search-bar {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border-bottom: 1px solid #ced4da;
        }

        .tag-list li {
            padding: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .tag-list li:hover {
            background-color: #f0f0f0;
        }

        .selected-tags {
            display: flex;
            flex-wrap: wrap;
            margin-top: 8px;
        }


        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a,
        .pagination span {
            padding: 10px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
        }

        .pagination .active span {
            background-color: #007bff;
            color: #fff;
        }
    </style>
@endsection

@section('body')
    <div class="container mt-5">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-md-6">
                    @if ($liked==1)
                    <h2>Liked Book&Series </h2>
                    @else
                    <h2>Saved Book&Series </h2>
                    @endif
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row p-0 m-0">
                <div class="col-12 col-md-7">
                    <nav>
                        <ul class="container-nav p-0 m-0">
                            <li class="active-menu" data-id="the-content-part-1" onclick="toggleActive(this)">Books</li>
                            <li onclick="toggleActive(this)" data-id="the-content-part-2">Series</li>
                        </ul>
                    </nav>
                </div>
                <div class="col-12 col-md-5 mt-5 mt-md-0">
                    <div class="input-box d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class='bx bx-md bx-search'></i>
                            <input type="text" placeholder="Search here..." />
                        </div>
                        <div>
                            <button class="button btn btn-secondary">Search</button>
                        </div>
                    </div>
                    <hr class="p-0 m-0 mt-1" style="width: 100%;">
                </div>
            </div>
        </div>
        <div class="container mb-5 p-0 m-0 mt-4">
            <div class="other-class-content the-content-part-1">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                        </div>
                    </div>
                </div>
                <div class="container m-0 p-0 d-flex flex-wrap">
                    @foreach ($books as $book)
                        <a style="text-decoration: none; color:unset;" class="book-card-solo m-2 row "
                            href="{{ route('book.info', ['id' => $book->id]) }}">
                            <div class="col-12" style="width: 100%;">
                                <img src="{{ asset($book->url_cover) }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="" width="100%">
                            </div>
                            <div class="col-12 mt-2">
                                <div class="">
                                    <h5 class="title-limit">{{ $book->Title }}</h5>
                                </div>
                                <div class="align-items-center " style="color:gray !important;">
                                    <div class="m-1 p-0 mt-0 mb-0">
                                        25.3k views
                                    </div>
                                    <div class="m-1 p-0 mt-0 mb-0">
                                        {{ \Carbon\Carbon::parse($book->created_at)->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col col-12 d-felx justify-content-center">
                        {{ $books->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <div style=" display:none;" class="other-class-content the-content-part-2 ">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                        </div>
                    </div>
                </div>
                <div class="container m-0 p-0 d-flex flex-wrap">
                    @foreach ($lists as $list)
                        @php
                            $var = $list->books->count();
                            if ($var == 0) {
                                $image = 'images/default book.jpg';
                            } else {
                                $image = $list->books[0]->url_cover;
                            }
                        @endphp
                        <a style="text-decoration: none; color: unset;" class="book-card-solo m-2 row"
                            href="{{ route('list.info', ['id' => $list->id]) }}">
                            <div class="col-12" style="width: 100%;">
                                <div style="height: 0px;">
                                    <img src="{{ asset($image) }}" class="product-thumb"
                                        style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: -2px; top: 40px; left: 40%; position: relative; filter: blur(3px);"
                                        alt="" width="70%">
                                </div>
                                <div style="height: 0px;">
                                    <img src="{{ asset($image) }}" class="product-thumb"
                                        style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: -1px; top: 25px; left: 25%; position: relative; filter: blur(1px);"
                                        alt="" width="80%">
                                </div>
                                <div>
                                    <img src="{{ asset($image) }}" class="product-thumb"
                                        style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: 0; top: -60%; position: relative;"
                                        alt="" width="100%">
                                </div>
                            </div>


                            <div class="col-12 mt-2">
                                <div class="">
                                    <h5 class="title-limit">{{ $list->Title }}</h5>
                                </div>
                                <div class=" align-items-center" style="color: gray;">
                                    <div class="m-1 mt-0 mb-0">
                                        25.3k views
                                    </div>
                                    <div class="m-1 mt-0 mb-0 ">
                                        {{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col col-12 d-felx justify-content-center">
                        {{ $lists->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_2')
    <script>
        function toggleActive(clickedElement) {
            // Remove the active-menu class from all li elements
            var listItems = document.querySelectorAll('.container-nav li');
            listItems.forEach(function(item) {
                item.classList.remove('active-menu');
            });

            // Add the active-menu class to the clicked li element
            clickedElement.classList.add('active-menu');

            // Hide all elements with class "other-class-content"
            var contentElements = document.querySelectorAll('.other-class-content');
            contentElements.forEach(function(content) {
                content.style.display = 'none';
            });

            // Show the content element with the matching data-id
            var dataId = clickedElement.getAttribute('data-id');
            var targetContent = document.querySelectorAll('.' + dataId);
            targetContent.forEach(function(content) {
                content.style.display = 'block';
            });
        }
    </script>
@endsection
