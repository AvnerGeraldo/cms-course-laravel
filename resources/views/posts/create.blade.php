@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">{{ isset($post) ? 'Edit Post' : 'Create Post' }}</div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (isset($post))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ isset($post) && empty(old('title')) ? $post->title : old('title') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea cols="5" rows="5" name="description" id="description" class="form-control">{{ isset($post) && empty(old('description')) ? $post->description : old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="hidden" name="content" id="content" value="{{ isset($post) && empty(old('content')) ? $post->content : old('content') }}"/>
                    <trix-editor input="content"></trix-editor>
                </div>
                @if (isset($post))
                    <div class="form-group">
                        <img src="{{ asset('storage/'.$post->image) }}" alt="" style="width: 100%;">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" name="published_at" id="published_at" value="{{ isset($post) && empty(old('published_at')) ? $post->published_at : old('published_at') }}" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit"  class="btn btn-success">{{ isset($post) ? 'Update Post' : 'Create Post' }}</button>
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
