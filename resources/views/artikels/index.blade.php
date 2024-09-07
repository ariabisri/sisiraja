@extends('layout.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('LTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('LTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('LTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('LTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* body {
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
                    } */
        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Artikel</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Artikel</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="mb-0">Daftar Artikel</h1>
                                <a href="{{ route('artikels.create') }}" class="btn btn-custom mb-3">Tambah Artikel Baru</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="text" id="search" class="form-control"
                                            placeholder="Cari artikel...">
                                    </div>
                                </div>

                                @if ($artikels->isEmpty())
                                    <p>Belum ada artikel.</p>
                                @else
                                    <table id="tabel-artikel" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'title', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                        Judul @if (request('sort') === 'title')
                                                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                                        @endif
                                                    </a>
                                                </th>
                                                <th>
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'author', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                        Penulis @if (request('sort') === 'author')
                                                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                                        @endif
                                                    </a>
                                                </th>
                                                <th>
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'published_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                        Tanggal Terbit @if (request('sort') === 'published_at')
                                                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                                        @endif
                                                    </a>
                                                </th>
                                                <th>
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                        Status @if (request('sort') === 'status')
                                                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                                        @endif
                                                    </a>
                                                </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($artikels as $artikel)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('artikels.show', $artikel->id) }}">{{ $artikel->title }}</a>
                                                    </td>
                                                    <td>{{ $artikel->author }}</td>
                                                    <td>{{ $artikel->published_at ? $artikel->published_at->format('Y') : '-' }}
                                                    </td>
                                                    <td>{{ ucfirst($artikel->status) }}</td>
                                                    <td>
                                                        <a href="{{ route('artikels.edit', $artikel->id) }}"
                                                            class="btn btn-warning btn-sm">Edit</a>
                                                        <form action="{{ route('artikels.destroy', $artikel->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script src="{{ asset('LTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('LTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $('#tabel-artikel').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#tabel-artikel tbody tr');

            rows.forEach(row => {
                const title = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                const author = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                const publishedAt = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
                const status = row.querySelector('td:nth-child(4)').innerText.toLowerCase();

                if (title.includes(filter) || author.includes(filter) || publishedAt.includes(filter) ||
                    status.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
