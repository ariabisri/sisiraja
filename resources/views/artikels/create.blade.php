<!DOCTYPE html>
<html>
<head>
    <title>Tambah Artikel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 5px;
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
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="card-title mb-4">Tambah Artikel Baru</h1>
            <form action="{{ route('artikels.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Judul:</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Konten:</label>
                    <textarea id="content" name="content" class="form-control" rows="5">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-custom">Simpan</button>
            </form>
            <a href="{{ route('artikels.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Artikel</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
