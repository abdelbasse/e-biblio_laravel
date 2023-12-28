{{-- search --}}
@extends('layouts.sidebar')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endsection


@section('body')
    <style>
        .profile-tab-nav {
            min-width: 250px;
        }

        .tab-content {
            flex: 1;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .nav-pills a.nav-link {
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            border-radius: 0;
            color: #333;
        }

        .nav-pills a.nav-link i {
            width: 20px;
        }

        .profile-image {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: rgb(222, 222, 222);
            border-radius: 20px;
            height: 200px;
        }
    </style>
    <div class="container-xl container-sm  container-md p-0 pt-5 pb-3">
        <div class="row">

            <div class="col-12 col-md-6">
                <h2>Profile </h2>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <div>
                    @if (auth()->user()->parent_account)
                        <a href="{{ route('user.accoun.home') }}" class="btn btn-secondary">Vue Account</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class=" container-xl container-sm container-md p-0 mt-3 mb-5 bg-white shadow rounded-lg">
        @if (auth()->user()->parent_account)
            <div class="col-12 mt-3">
                <div class="col-12 p-5 pb-2">
                    <div class="profile-image"
                        style="background-image: url('{{ asset(auth()->user()->background_account) }}');">
                    </div>
                </div>
            </div>
        @endif
        <div class=" p-0 mt-0 mb-5  d-block d-sm-flex">
            <div class="profile-tab-nav border-right">
                <div class="p-4">
                    <h4 class="text-center">{{ auth()->user()->name }} {{ auth()->user()->last_name }}</h4>
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center mb-4">
                            <div class="shadow rounded">
                                <img id="previewImage" src="{{ asset(auth()->user()->profile_url) }}"
                                    class="border rounded img-fluid" width="200px" alt="">
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex flex-column">
                            <div class="mt-auto">
                                <label for="imageInput" class="btn btn-primary btn-block rounded-3">
                                    Change Profile
                                    <input type="file" name="image" id="imageInput" class="d-none"
                                        onchange="displaySelectedImage(event)">
                                </label>
                            </div>
                            <!-- Add similar input for background profile image -->
                            @if (auth()->user()->parent_account)
                                <div class="mt-3">
                                    <label for="backgroundImageInput" class="btn btn-primary btn-block rounded-3">
                                        Change Background Profile
                                        <input type="file" name="backgroundImage" id="backgroundImageInput"
                                            class="d-none" onchange="displaySelectedBackgroundImage(event)">
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <h3 class="mb-4">User Info</h3>

                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->name }}"
                                        name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="mail" class="form-control" value="{{ auth()->user()->email }}"
                                        name="email" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tell</label>
                                    <input type="text" class="form-control" name="tell"
                                        value="{{ auth()->user()->tell }}">
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->parent_account)
                            <h3 class="mb-4">Acount Info</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Account Name</label>
                                        <input type="text" class="form-control"
                                            value="{{ auth()->user()->channel_name }}" name="Chanelname">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" name="chanelDesc"> {{ auth()->user()->channel_desc }} </textarea>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (!auth()->user()->parent_account)
        <div
            class=" container-xl container-sm container-md p-0 mt-3 mb-5 d-flex justify-content-center bg-white shadow rounded-lg d-block d-sm-flex">
            <div class=" row container pt-4">
                <div class="col-6">
                    <h4 style="font-weight: bold">
                        Account list
                    </h4>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create New Account
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <input type="text" class="form-control" name="type" value="account"
                                            hidden>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Name:</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Password:</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Create">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-dark">
                                <td class="col-2">Name</td>
                                <td class="col-5">Email</td>
                                <td class="col-3"></td>
                                <td class="col-2">Option</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $account)
                                <tr>
                                    <th>{{ $account->name }}</th>
                                    <td>{{ $account->email }}</td>
                                    <td>
                                        <a href="/###">
                                            forget password resent ,via email
                                        </a>
                                    </td>
                                    <td>delete</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    <div id="class_have_errue_message" hidden>
        @error('Ereur')
            {!! $message !!}
        @enderror
    </div>
@endsection

@section('script_2')
    <script>
        var errorMessage = document.getElementById('class_have_errue_message').innerHTML;
        if (errorMessage && errorMessage.trim() !== "") {
            showAlertD(errorMessage);
        }
    </script>
    <script>
        function displaySelectedImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('previewImage');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        function displaySelectedBackgroundImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('previewBackgroundImage');
                output.style.backgroundImage = 'url(' + reader.result + ')';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#imageInput', function(event) {
                displaySelectedImage(event);
                updateProfile('ko');
            });

            $(document).on('change', '#backgroundImageInput', function(event) {
                displaySelectedBackgroundImage(event);
                updateProfile('ok');
            });

            function updateProfile(isUpdateImage) {
                var file;
                var formData;
                var type;
                if (isUpdateImage === 'ko') {
                    file = $('#imageInput')[0].files[0];
                    formData = new FormData();
                    formData.append('file', file);
                    type = "p";
                } else if (isUpdateImage === 'ok') {
                    file = $('#backgroundImageInput')[0].files[0];
                    formData = new FormData();
                    formData.append('backgroundFile', file);
                    type = "bg";
                }

                formData.append('type', type);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('profile.update') }}',
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
@endsection
