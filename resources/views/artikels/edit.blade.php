@extends('layout.app')

@section('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }

        .text-danger {
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Edit Artikel</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('artikels.update', $artikel->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Judul -->
                            <div class="form-group">
                                <label for="title">Judul:</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="{{ old('title', $artikel->title) }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Konten -->
                            <div class="form-group">
                                <label for="content">Konten:</label>
                                <textarea id="content" name="content" class="form-control" rows="5">{{ old('content', $artikel->content) }}</textarea>
                                @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Penulis -->
                            <div class="form-group">
                                <label for="author">Penulis:</label>
                                <input type="text" id="author" name="author" class="form-control"
                                    value="{{ old('author', $artikel->author) }}">
                                @error('author')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Uploader -->
                            <div class="form-group">
                                <label for="uploader">Uploader:</label>
                                <input type="text" id="uploader" name="uploader" class="form-control"
                                    value="{{ old('uploader', $artikel->uploader) }}">
                                @error('uploader')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal Terbit -->
                            <div class="form-group">
                                <label for="published_at">Tanggal Terbit:</label>
                                <input type="date" id="published_at" name="published_at" class="form-control"
                                    value="{{ old('published_at', $artikel->published_at) }}">
                                @error('published_at')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="draft"
                                        {{ old('status', $artikel->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published"
                                        {{ old('status', $artikel->status) == 'published' ? 'selected' : '' }}>Published
                                    </option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Upload Banner -->
                            <div class="form-group">
                                <label for="banner">Ganti Banner:</label>
                                <input type="file" id="banner" name="banner" class="form-control-file">
                                @if ($artikel->banner)
                                    <p>Banner saat ini: <img src="{{ asset($artikel->banner) }}" alt="Banner Artikel"
                                            width="150"></p>
                                @endif
                                @error('banner')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('artikels.index') }}" class="btn btn-secondary">Kembali ke Daftar Artikel</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
