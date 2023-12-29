@extends('layouts.sidebar')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/adminStyle.css') }}">
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
    <div class="container p-0 mt-1 justify-content-center  mb-5">
        <div class="container mt-5 mb-4">
            <h2 style="font-weight: bold;">Channel List</h2>
        </div>
        <table class="accounts">
            <thead>
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th>Deactivate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="imageProfileCommentConatiner d-flex align-items-center justify-content-center"
                                style="border-radius: 100px; width:40px; height:40px; overflow:hidden;">
                                <img src="{{ asset($user->profile_url) }}" height="100%"
                                    alt="">
                            </div>
                        </td>
                        <td>{{ $user->channel_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <div>
                                @if ($user->is_active)
                                    <a href="{{ route('admin.users.list.update', ['id' => $user->id, 'isValid' => '1']) }}"
                                        class="btn btn-danger">
                                        Deactivate
                                    </a>
                                @else
                                    <a href="{{ route('admin.users.list.update', ['id' => $user->id, 'isValid' => '0']) }}"
                                        class="btn btn-success">
                                        Activate
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script_2')
@endsection
