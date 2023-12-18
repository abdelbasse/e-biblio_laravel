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

        /* |||||||||||||||||||||||||||||||||||| form book cover input END*/
    </style>
@endsection

@section('body')
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-12">
                <div class="profile-image" style="background-image: url('{{ asset('images/backgroundProfile.png') }}');">
                </div>
            </div>
            <div class="row col-12 mt-3 ">
                <div class="col-12 col-md-2  d-flex justify-content-center align-items-center">
                    <div class="part_1 d-flex justify-content-center align-items-center">
                        <div class="imageProfileCommentConatiner d-flex align-items-center justify-content-center"
                            style="border-radius: 100px; height:160px; overflow:hidden;">
                            <img src="{{ asset(auth()->user()->profile_url) }}" height="100%" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-10 row">
                    <div class="col-12">
                        <h1 style="font-weight: bold; font-family:'Times New Roman', Times, serif;">Learn with
                            Whiteboard</h1>
                        <div style="color:gray">
                            <p>@learnwithwhiteboard • 59.5K subscribers • 218
                                books</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <p style="white-space: nowrap; overflow:hidden;">A channel created by a serial entrepreneur,
                            Amarpreet Singh
                            covers weekly How To's, Insights & Motivation</p>
                        <p style="white-space: nowrap;  overflow:hidden;"><a href="https://brandlitic.com"
                                target="_blank">brandlitic.com</a></p>
                    </div>

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


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel">Full screen modal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="drag-area">
                                        <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                        <header>Drag & Drop to Upload File</header>
                                        <span>OR</span>
                                        <button>Browse File</button>
                                        <input type="file" hidden>
                                    </div>
                                </div>
                                <div class="col-6"></div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="container mb-5 p-0 m-0 mt-4">
            <div class="other-class-content the-content-part-1">
                <div class="container m-0 p-0 d-flex flex-wrap">
                    <a style="text-decoration: none; color:unset;" class="book-card-solo m-2 row "
                        href="@@">
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
                    <a href="$$" style="text-decoration: none; color:unset;" class="book-card-solo m-2 row ">
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
            <div style=" display:none;" class="other-class-content the-content-part-2 ">
                <div class="container m-0 p-0 d-flex flex-wrap">
                    <a style="text-decoration: none; color: unset;" class="book-card-solo m-2 row"
                        href="@@">
                        <div class="col-12" style="width: 100%;">
                            <div style="height: 0px;">
                                <img src="{{ asset('images/jioi.png') }}" class="product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: -2px; top: 40px; left: 40%; position: relative; filter: blur(3px);"
                                    alt="" width="70%">
                            </div>
                            <div style="height: 0px;">
                                <img src="{{ asset('images/jioi.png') }}" class="product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: -1px; top: 25px; left: 25%; position: relative; filter: blur(1px);"
                                    alt="" width="80%">
                            </div>
                            <div>
                                <img src="{{ asset('images/jioi.png') }}" class="product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: 0; top: -60%; position: relative;"
                                    alt="" width="100%">
                            </div>
                        </div>


                        <div class="col-12 mt-2">
                            <div class="">
                                <h5 class="title-limit">Title of this book ihdw widhwi wkdjw</h5>
                            </div>
                            <div class="d-flex align-items-center" style="color: gray;">
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

                    <a style="text-decoration: none; color: unset;" class="book-card-solo m-2 row"
                        href="@@">
                        <div class="col-12" style="width: 100%;">
                            <div style="height: 0px;">
                                <img src="{{ asset('images/jioi.png') }}" class="product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: -2px; top: 40px; left: 40%; position: relative; filter: blur(3px);"
                                    alt="" width="70%">
                            </div>
                            <div style="height: 0px;">
                                <img src="{{ asset('images/jioi.png') }}" class="product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: -1px; top: 25px; left: 25%; position: relative; filter: blur(1px);"
                                    alt="" width="80%">
                            </div>
                            <div>
                                <img src="{{ asset('images/jioi.png') }}" class="product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; z-index: 0; top: -60%; position: relative;"
                                    alt="" width="100%">
                            </div>
                        </div>


                        <div class="col-12 mt-2">
                            <div class="">
                                <h5 class="title-limit">Title of this book ihdw widhwi wkdjw</h5>
                            </div>
                            <div class="d-flex align-items-center" style="color: gray;">
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
    <script>
        //selecting all required elements
        const dropArea = document.querySelector(".drag-area"),
            dragText = dropArea.querySelector("header"),
            button = dropArea.querySelector("button"),
            input = dropArea.querySelector("input");
        let file; //this is a global variable and we'll use it inside multiple functions

        button.onclick = () => {
            input.click(); //if user click on the button then the input also clicked
        }

        input.addEventListener("change", function() {
            //getting user select file and [0] this means if user select multiple files then we'll select only the first one
            file = this.files[0];
            dropArea.classList.add("active");
            showFile(); //calling function
        });


        //If user Drag File Over DropArea
        dropArea.addEventListener("dragover", (event) => {
            event.preventDefault(); //preventing from default behaviour
            dropArea.classList.add("active");
            dragText.textContent = "Release to Upload File";
        });

        //If user leave dragged File from DropArea
        dropArea.addEventListener("dragleave", () => {
            dropArea.classList.remove("active");
            dragText.textContent = "Drag & Drop to Upload File";
        });

        //If user drop File on DropArea
        dropArea.addEventListener("drop", (event) => {
            event.preventDefault(); //preventing from default behaviour
            //getting user select file and [0] this means if user select multiple files then we'll select only the first one
            file = event.dataTransfer.files[0];
            showFile(); //calling function
        });

        function showFile() {
            let fileType = file.type; //getting selected file type
            let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array
            if (validExtensions.includes(fileType)) { //if user selected file is an image file
                let fileReader = new FileReader(); //creating new FileReader object
                fileReader.onload = () => {
                    let fileURL = fileReader.result; //passing user file source in fileURL variable
                    // UNCOMMENT THIS BELOW LINE. I GOT AN ERROR WHILE UPLOADING THIS POST SO I COMMENTED IT
                    // let imgTag = `<img src="${fileURL}" alt="image">`; //creating an img tag and passing user selected file source inside src attribute
                    dropArea.innerHTML = imgTag; //adding that created img tag inside dropArea container
                }
                fileReader.readAsDataURL(file);
            } else {
                alert("This is not an Image File!");
                dropArea.classList.remove("active");
                dragText.textContent = "Drag & Drop to Upload File";
            }
        }
    </script>
@endsection
