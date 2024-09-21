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

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
            color: white;
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
                        <h2 class="mb-0">{{ $artikel->title }}</h2>
                    </div>
                    <div class="card-body">
                        {{-- Uncomment the following line if you want to show the published date --}}
                        <p><strong>Penulis:</strong> {{ $artikel->author }}</p>
                        <p><strong>Tanggal Terbit:</strong> {{ $artikel->created_at->format('d M Y') }}</p>
                        <p>{{ $artikel->content }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($artikel->status) }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('artikels.edit', $artikel->id) }}" class="btn btn-custom">Edit</a>
                        <a href="{{ route('artikels.index') }}" class="btn btn-secondary">Kembali ke Daftar Artikel</a>
                        <form action="{{ route('artikels.destroy', $artikel->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah benar ingin menghapus artikel?')">Hapus</button>
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
