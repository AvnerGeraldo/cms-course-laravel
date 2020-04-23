@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">Create Post</div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea cols="5" rows="5" name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="hidden" name="content" id="content" value="{{ old('content') }}"/>
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" name="published_at" id="published_at" value="{{ old('published_at') }}" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit"  class="btn btn-success">Create Post</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('load-javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script type="text/javascript">
        flatpickr('#published_at', {
            dateFormat: 'd/m/Y H:i:ss',
            enableTime: true,
            locale: "pt"
        });
    </script>
@endsection

@section('load-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" />
@endsection
