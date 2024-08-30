<!DOCTYPE html>
<html>
<head>
    <title>Daftar Artikel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0">Daftar Artikel</h1>
            </div>
            <div class="card-body">
                <a href="{{ route('artikels.create') }}" class="btn btn-custom mb-3">Tambah Artikel Baru</a>
                @if($artikels->isEmpty())
                    <p>Belum ada artikel.</p>
                @else
                    <ul class="list-group">
                        @foreach ($artikels as $artikel)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('artikels.show', $artikel->id) }}">{{ $artikel->title }}</a>
                                <div>
                                    <a href="{{ route('artikels.edit', $artikel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('artikels.destroy', $artikel->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
