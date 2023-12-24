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

        .returnBtn {
            width: 50px;
            height: 50px;
            border: 1px solid rgb(93, 93, 93);
            border-radius: 100px;
        }
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

        .categori {
            color: white;
            cursor: pointer;
            border-radius: 100px !important;
            background: #545454;
        }
    </style>
@endsection



@section('body')
    <div class="container d-flex mt-5 return">
        <a href="{{route('back')}}" style="text-decoration: none;" class="returnBtn d-flex justify-center align-items-center">
            <i class='bx m-2 mt-1 mb-1 bx-md bx-right-arrow-alt bx-rotate-180'></i>
        </a>
    </div>
    @php
        $var = $list->books->count();
        if ($var == 0) {
            $image = 'images/default book.jpg';
        } else {
            $image = $list->books[0]->url_cover;
        }
    @endphp

    <!-- Modal  book-->
    <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="yourFormId">
                    @csrf
                    <div class="modal-body">
                        <!-- Two-column layout (5,7) -->
                        <div class="row">
                            <!-- Left Column (5) -->
                            <div class="col-md-5">
                                <label for="bookCoverInput">Book Cover</label>
                                <input type="file" class="form-control" id="bookCoverInput"
                                    onchange="previewImage(this)">
                                <div>
                                    <div class="image-book-container d-flex mt-3 justify-content-center ">
                                        <div id="imagePreview" style=" max-width: 200px;">
                                            <img src="{{ asset('images/default book.jpg') }}" class=" product-thumb"
                                                style="box-shadow: -30px 30px 20px 0 rgba(0, 0, 0, 0.2); border-radius:10px; "
                                                width="100%" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column (7) -->
                            <div class="col-md-7">
                                <label for="pdfInput">PDF File</label>
                                <input type="file" class="form-control" id="pdfInput" onchange="showFileDesign(this)">
                                <div id="fileDesign" style="display: none;">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong id="selectedFileName"></strong>
                                        <button type="button" class="btn-close" onclick="removeFileDesign()"
                                            aria-label="Close"></button>
                                    </div>
                                </div>

                                <label for="textInput" class="mt-2">Title</label>
                                <input type="text" class="form-control" id="textInput">
                                <input type="text" class="form-control" id="idList" value="{{ $list->id }}"
                                    hidden>

                                <label for="descriptionInput" class="mt-2">Description</label>
                                <textarea type="text" class="form-control" id="descriptionInput"></textarea>

                                <label for="languageSelect" class="mt-2">Language</label>
                                <!-- Add other language options as needed -->
                                <select class="form-control" id="languageSelect">
                                    @foreach ($langes as $lange)
                                        <option value="{{ $lange->id }}">{{ $lange->language }}
                                            <b>({{ $lange->short }})</b>
                                        </option>
                                    @endforeach
                                </select>

                                <div class="row">
                                    <div class="col-3 mt-2 d-flex align-items-center">
                                        <label>Categories</label>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <div class="multiselect" style="width: 100%:">
                                            <div class="select-box" onclick="toggleTagList()">Select Tags</div>
                                            <ul class="tag-list" id="tagList">
                                                <li class="search-bar-container">
                                                    <input type="text" id="searchBar" class="search-bar form-control"
                                                        placeholder="Search...">
                                                </li>
                                                @foreach ($tags as $tag)
                                                    <li onclick="toggleTag('{{ $tag->libelle }}',{{ $tag->id }})">
                                                        {{ $tag->libelle }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 selected-tags" id="selectedTags"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button " class="btn btn-primary" id="submiteBookForm">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container p-0 mt-1 justify-content-center mb-5">
        <div class="container m-3 mb-4 row">
            <div class="col-6">
                <h3 style="font-weight: bold;">{{ $list->Title }}</h3>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModalFullscreen">
                    Add Book
                </button>
            </div>
        </div>
        <div class="container ">
            <div class=" row ">
                <div class="col-12  col-md-4 p-5 pt-1">
                    <div class="d-flex justify-content-center" style="height:350px; width:100%;">
                        <div style="height:90%;" class=" shadow">
                            <img src="{{ asset($image) }}" style=" overflow: hidden; border-radius:10px; " alt=""
                                height="100%">
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="col-12" style="">
                            <p class="clamped-lines-2">{{ $list->desc }}</p>
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
                    @if (auth()->user()->id !== $list->account->id)
                        <div class="sub-sub-book-info-part-1 d-flex align-items-center">
                            <div class="part_1 d-flex justify-content-center ">
                                <div class="imageProfileCommentConatiner d-flex align-items-center justify-content-center"
                                    style="border-radius: 100px; width:50px; height:50px; overflow:hidden;">
                                    <img src="{{ asset($list->account->profile_url) }}" height="100%" alt="">
                                </div>
                            </div>
                            <div class="part_3 m-3 mt-0 mb-0">
                                <a href="{{ route('user.accoun.view', ['id' => $list->account->id]) }}"
                                    style="all:unset; cursor: pointer;">
                                    <div style="font-weight: bold;">{{ $list->account->channel_name }}</div>
                                    <div style="color: rgb(146, 146, 146);">23.2k subcribers</div>
                                </a>
                            </div>

                            <div class="part_2 m-4 mt-0 mb-0">
                                <button class="btn btn-secondary p-4 pt-2 pb-2"
                                    style="border-radius:100px; background:#272935;">Subscribe</button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12 row col-md-8 pt-3" style="background:rgba(225, 225, 225, 0.556);">
                    @foreach ($books as $book)
                        <a style="text-decoration: none; color:unset; cursor: pointer;" href="{{route('book.info', ['id' => $book->id]) }}"
                            class="col-12 mb-3 book-card-solo">
                            <div class="product-card pb-0 mb-0 d-flex">
                                <div class="product-image" style="height: 200px;">
                                    <img src="{{ asset($book->url_cover) }}" class=" product-thumb"
                                        style="overflow: hidden; border-radius:10px; " height="90%" alt="">
                                </div>
                                <div class=" m-4 mt-0 mb-0">
                                    <div class="col-12 ">
                                        <div class="col-12 " style="">
                                            <h2>{{ $book->Title }}</h2>
                                        </div>
                                        <div class="col-12" style="">
                                            <p class="clamped-lines">{{ $book->desc }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center " style="color:gray !important;">
                                        <div class="m-1 mt-0 mb-0">
                                            25.3k views
                                        </div>
                                        .
                                        <div class="m-1 mt-0 mb-0">
                                            {{ \Carbon\Carbon::parse($book->created_at)->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr width="90%" class="m-0 p-0 mt-1">
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection



@section('script_2')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#submiteBookForm', function(event) {
                submitForm();
            });

            function submitForm() {
                // Get form data
                var formData = new FormData(document.getElementById('yourFormId'));

                // Additional data
                formData.append('type', 'list');
                formData.append('_token', '{{ csrf_token() }}');

                // Your further modifications
                formData.append('book_cover', $('#bookCoverInput')[0].files[0]);
                formData.append('pdf_file', $('#pdfInput')[0].files[0]);
                formData.append('language_id', $('#languageSelect').val());
                formData.append('title', $('#textInput').val());
                formData.append('list_id', $('#idList').val());
                formData.append('description', $('#descriptionInput').val());

                // Tags (assuming you have an array of tag IDs)
                var tagIds = [];
                $('.selected-tags [data-tag-id]').each(function() {
                    tagIds.push($(this).data('tag-id'));
                });
                formData.append('tag_ids', JSON.stringify(tagIds));

                // AJAX request
                $.ajax({
                    url: '{{ route('list.info.uplaod') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        showAlertS(response.message);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        showAlertD(xhr.error);
                    }
                });
            }

        });
    </script>



    <script>
        function showFileDesign(input) {
            var fileName = input.files[0].name;
            $('#selectedFileName').html('Selected PDF: ' + fileName);
            $('#fileDesign').show();
            $('#pdfInput').hide();
        }

        function removeFileDesign() {
            $('#fileDesign').hide();
            $('#pdfInput').show();
            $('#pdfInput').val('');
        }
    </script>
    <script>
        function toggleTagList() {
            var tagList = document.getElementById('tagList');
            tagList.style.display = tagList.style.display === 'none' ? 'block' : 'none';
        }

        function toggleTag(tag, tagId) {
            var selectedTagsContainer = document.getElementById('selectedTags');
            var existingTags = Array.from(selectedTagsContainer.children).map(tagElement => tagElement.dataset.tag);

            if (!existingTags.includes(tag)) {
                var tagElement = document.createElement('div');
                tagElement.textContent = tag;
                tagElement.dataset.tag = tag;
                tagElement.dataset.tagId = tagId; // Store the tag ID
                tagElement.className = 'categori p-3 m-2 pt-1 pb-1';
                tagElement.onclick = function() {
                    this.remove();
                };

                selectedTagsContainer.appendChild(tagElement);
            }

            toggleTagList();
        }

        document.addEventListener('click', function(event) {
            var tagList = document.getElementById('tagList');
            var selectBox = document.querySelector('.select-box');

            if (!selectBox.contains(event.target) && !tagList.contains(event.target)) {
                tagList.style.display = 'none';
            }
        });

        // Search bar functionality
        $('#searchBar').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            $('#tagList li:not(.search-bar-container)').each(function() {
                var text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(searchTerm));
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tagList').select2();

            $('#tagList').on('select2:select', function(e) {
                var selectedTagsContainer = document.getElementById('selectedTags');
                var tag = e.params.data.text;

                var tagElement = document.createElement('div');
                tagElement.textContent = tag;
                tagElement.className = 'selected-tag';
                tagElement.onclick = function() {
                    $(this).remove();
                    $('#tagList').val(null).trigger('change'); // Clear the selection in the dropdown
                };

                selectedTagsContainer.appendChild(tagElement);
            });
        });
    </script>


    <script>
        function previewImage(input) {
            var previewContainer = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                //<img src="{{ asset('images/jioi.png') }}" class=" product-thumb" style="box-shadow: -30px 30px 20px 0 rgba(0, 0, 0, 0.2); border-radius:10px; " width="100%" alt="">
                previewContainer.innerHTML = '<img src="' + e.target.result +
                    '" class=" product-thumb" style="box-shadow: -3px 3px 10px 0 rgba(0, 0, 0, 0.2); border-radius:10px; " width="100%" alt="">';
            };

            reader.readAsDataURL(file);
        }
    </script>

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
