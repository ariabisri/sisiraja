@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2>Edit Gallery</h2>

    <form action="/galeris/{{ $gallery->id }}" method="PUT" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit" class="btn-submit">Update</button>
    </form>
</div>
@endsection
