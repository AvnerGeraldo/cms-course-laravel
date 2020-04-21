@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            <div class="float-left my-2">Posts</div>
            <div class="float-right">
                <a href="{{ route('posts.create') }}" class="btn btn-success">Add Posts</a>
            </div>
        </div>
        <div class="card-body">

        </div>
    </div>

@endsection
