@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{ isset($category) ? 'Edit Category' : 'Create Category' }}
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <span>{{ $errors->first() }}</span>
                    {{--
                        <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item">{{ $error }}</li>
                        @endforeach
                    </ul>
                    --}}
                </div>
            @endif
            <form method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}">
                @csrf

                @if (isset($category))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ isset($category) ? $category->name : '' }}" class="form-control">
                </div>

                <div class="form-group">
                    <button class="btn btn-success">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
