@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1 class="text-center my-3">Articles List</h1>
    {{-- <ol>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>
                <div class="alert alert-warning">
                    <strong>{{ $error }}</strong>
                </div>
            </li>
        @endforeach
    @endif
    </ol> --}}

    @if (session('create_success'))
        <div class="alert alert-success">
            <strong>{{ session('create_success') }}</strong>
        </div>
    @endif


    @if (session('delete_success'))
        <div class="alert alert-success">
            <strong>{{ session('delete_success') }}</strong>
        </div>
    @endif

    {{ $articles->links() }}

    @if (session("cmt_required"))
                        <b class="text-danger">{{session("cmt_required")}}</b>
    @endif
    @foreach ($articles as $article)
        <div class="card p-3 my-2">
            <div class="card-body">
                <div class="card-title">
                    <h3>{{ $article['title'] }}</h3>
                </div>
                <p>
                    {{ $article['body'] }}
                </p>
                <a href="{{ url("articles/details/$article->id") }}" class="text-decoration-none my-4">More Details -></a>
                <form action="{{ url("/comment/add") }}" method="POST" class="col-6 mt-3">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group">
                        <textarea name="comment" id="" cols="20"  rows="2" placeholder="Comment here" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary px-2">Send</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
