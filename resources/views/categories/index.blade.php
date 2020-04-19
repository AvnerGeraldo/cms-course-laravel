@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            <div class="float-left my-2">Categories</div>
            <div class="float-right">
                <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Name</th>
                </thead>
                <tbody>
                    @foreach ($listCategories as $category)
                        <tr>
                            <td>{{  $category->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
