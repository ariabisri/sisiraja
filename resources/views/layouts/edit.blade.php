@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Edit Gallery</h1>

    <form action="/galeris/{{ $gallery->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $gallery->title) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ old('description', $gallery->description) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
