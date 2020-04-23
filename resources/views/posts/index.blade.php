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
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td><img src="{{ asset('storage/'.$post->image) }}" width="60" height="60" alt="{{ $post->title }}" /></td>
                            <td>{{ $post->title }}</td>
                            <td class="text-right">
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="float-right ml-2">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Do you wanna delete the post \'{{ $post->title}}\' ?');" class="btn btn-danger btn-sm">Trash</button>
                                </form>
                                <a href="" class="btn btn-info btn-sm float-right">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
