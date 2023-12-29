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
            <h2 style="font-weight: bold;">Request</h2>

        </div>
        <ul class="demand-list">
            @php
                if (!function_exists('formatLargeNumber')) {
                    function formatLargeNumber($number)
                    {
                        if ($number >= 1000000) {
                            return number_format($number / 1000000, 1) . 'M';
                        } elseif ($number >= 1000) {
                            return number_format($number / 1000, 1) . 'K';
                        } else {
                            return $number;
                        }
                    }
                }
            @endphp
            @foreach ($books as $book)
                <li class="demand-item ">
                    <div class="d-flex justify-content-center align-items-center" style="width: 100%;">

                        <a style="text-decoration: none; color:unset;" class="book-card-solo m-2 row " style=""
                            href="{{ route('book.info', ['id' => $book->id]) }}">
                            <div class="col-12" style="width: 100%;">
                                <img src="{{ asset($book->url_cover) }}" class=" product-thumb"
                                    style="box-shadow: 1px 1px 0px 2px rgba(49, 49, 49, 0.2); overflow: hidden; border-radius:10px; "
                                    alt="" width="100%">
                            </div>
                            <div class="col-12 mt-2" style="color: white;">
                                <div class="">
                                    <h5 class="title-limit">{{ $book->Title }}</h5>
                                </div>
                                <div class="align-items-center " style="color:gray !important;">
                                    <div class="m-1 p-0 mt-0 mb-0">
                                        {{ formatLargeNumber(count($book->readBy)) }} views
                                    </div>
                                    <div class="m-1 p-0 mt-0 mb-0">
                                        {{ \Carbon\Carbon::parse($book->created_at)->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="buttons">
                        <a href="{{ route('admin.book.valide.action', ['id' => $book->id, 'isValid' => '1']) }}"
                            class="button button-valid"><span>Valider</span></a>
                        <a href="{{ route('admin.book.valide.action', ['id' => $book->id, 'isValid' => '0']) }}"
                            class="button button-invalid"><span>Refuser</span></a>
                    </div>
                </li>
            @endforeach
        </ul>

        {{ $books->links('pagination::bootstrap-5') }}
    </div>
@endsection

@section('script_2')
@endsection
