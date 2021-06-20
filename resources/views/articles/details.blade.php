@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 col-lg-6 mx-auto">
                <div class="card mb-2">
                    <div class="card-body">
                        @if (session('unauth'))
                        <div class="alert alert-success">
                            <strong>{{ session('unauth') }}</strong>
                        </div>
                     @endif
                    <h3 class="card-title">{{ $article->title }}</h3>
                    {{-- <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                    </div> --}}
                    <p class="card-text">{{ $article->body }}</p>
                    <a class="btn btn-warning"
                    href="{{ url("/articles/delete/$article->id") }}">
                    Delete
                    </a>

                    <ul class="list-group my-4">
                        @foreach ($article->comments as $comment)
                        <li class="list-group-item d-flex justify-content-between">
                            <p>
                                {{ $comment->comment }}
                            </p>
                            <div>
                                <small>{{ $comment->user->name }}</small>
                                @auth
                                <a href="{{ url("/comment/delete/$comment->id") }}" class="m-3 btn btn-danger">Delete</a>
                                @endauth
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
