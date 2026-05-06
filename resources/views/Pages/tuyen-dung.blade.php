@extends('Layouts.app')

@section('title', 'Thực tập - Tuyển dụng')

@section('content')

<div class="container mt-4">

    <h2 class="text-fit-blue mb-4">
        💼 Thực tập - Tuyển dụng
    </h2>

    <div class="row">

        @foreach($posts as $item)

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow-sm">

                <img
                    src="{{ $item->thumbnail
                        ? asset('storage/' . $item->thumbnail)
                        : asset('assets/images/thuctaptuyendung.png') }}"
                    class="card-img-top">

                <div class="card-body">

                    <h6>
                        <a href="{{ route('news.show', $item->slug) }}">
                            {{ $item->title }}
                        </a>
                    </h6>

                    <small class="text-muted">
                        {{ $item->created_at->format('d/m/Y') }}
                    </small>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>

</div>

@endsection
