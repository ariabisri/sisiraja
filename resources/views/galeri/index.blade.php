@extends('layout.app')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('LTE/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{asset('LTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('LTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('LTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Galeri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Galeri</li>
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
                    <!-- Card Galeri -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Galeri</h3>
                            <a href="{{ route('galeris.create') }}" class="btn btn-success float-right">Add New Gallery</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabel-galeri" class="table table-bordered table-striped">
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
<!-- DataTables  & Plugins -->
<script src="{{asset('LTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('LTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('LTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('LTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('LTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('LTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('LTE/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('LTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('LTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('LTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('LTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('LTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(function () {
        $('#tabel-galeri').DataTable({
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
@endsection
