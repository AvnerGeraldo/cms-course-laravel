@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">Edit Category</div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
            <form method="POST" action="{{ route('categories.update', [ 'category' => $category->id ]) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ $category->name }}" class="form-control">
                </div>

                <div class="form-group">
                    <button class="btn btn-success">Edit Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
