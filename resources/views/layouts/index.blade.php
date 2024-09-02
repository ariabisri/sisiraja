@extends('layouts.app')

@section('content')
<h1>Gallery</h1>
<a href="{{ route('galeris.create') }}" class="btn btn-success">Add New Gallery</a>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th> <!-- Tambahkan header untuk deskripsi -->
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($galeris as $gallery)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $gallery->title }}</td>
            <td>{{ $gallery->description }}</td> <!-- Menampilkan deskripsi -->
            <td><img src="{{ asset('storage/' . $gallery->image_path) }}" width="250" alt="{{ $gallery->title }}"></td>
            <td>
                <a href="{{ route('galeris.edit', $gallery->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('galeris.destroy', $gallery->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
