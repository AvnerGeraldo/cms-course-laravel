@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            <div class="float-left my-2">{{ isset($trashedPage) && $trashedPage ?  'Trashed Posts' : 'Posts' }}</div>
            @if (!isset($trashedPage))
                <div class="float-right">
                    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Posts</a>
                </div>
            @endif
        </div>
        <div class="card-body">
            @if ($posts->count() > 0)
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

                                        <button type="submit" onclick="return confirm('Do you wanna {{ $post->trashed() ?  'delete' : 'trash' }} the post \'{{ $post->title}}\' ?');" class="btn btn-danger btn-sm">
                                            {{ $post->trashed() ?  'Delete' : 'Trash' }}
                                        </button>
                                    </form>
                                    @if (!$post->trashed())
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm float-right">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No posts at this moment.</h3>
            @endif

        </div>
    </div>

@endsection
