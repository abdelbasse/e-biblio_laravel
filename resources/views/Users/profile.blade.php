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
    </style>
    <div class="container-xl container-sm container-md p-0 pt-5 pb-3">
        <h2>Account </h2>
    </div>
    <div class=" container-xl container-sm container-md p-0 mt-3 mb-5 bg-white shadow rounded-lg d-block d-sm-flex">
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
                                change profiel
                                <input type="file" name="image" id="imageInput" class="d-none"
                                    onchange="displaySelectedImage(event)">
                            </label>
                        </div>
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
                    <div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  --}}
    <div id="alertsContainer"></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@endsection

@section('script_2')
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
        $(document).ready(function() {
            $(document).on('change', '#imageInput', function(event) {
                displaySelectedImage(event);

                var file = event.target.files[0];
                var formData = new FormData();
                formData.append('file', file);
                formData.append('isUpdateImage', 'ko');
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
            });
        });
    </script>
@endsection
