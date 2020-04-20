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
                    <th colspan="4">Name</th>
                </thead>
                <tbody>
                    @foreach ($listCategories as $category)
                        <tr>
                            <td colspan="3">{{  $category->name }}</td>
                            <td class="text-right">
                                <a href="{{ route('categories.edit', [ 'category' => $category->id ]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
