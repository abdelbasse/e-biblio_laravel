@extends('layouts.sidebar')

@section('style')
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
    <div class="container p-0 mt-1 justify-content-center mb-5">
        <div class="container mt-5 p-0 d-flex flex-wrap">
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
            @if (isset($books))
                @foreach ($books as $book)
                    @if ($book->is_valid)
                        <a style="text-decoration: none; color:unset;" class="book-card-solo m-2 row " style=""
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
                                        {{ formatLargeNumber(count($book->readBy)) }} views
                                    </div>
                                    <div class="m-1 p-0 mt-0 mb-0">
                                        {{ \Carbon\Carbon::parse($book->created_at)->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            @endif
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
                                {{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
@endsection



@section('script_2')
@endsection
