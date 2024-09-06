@extends('layout.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah User</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                      <!-- general form elements -->
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Form Tambah User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                          <div class="form-group">
                              <label for="exampleInputUsername1">Username</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" name="username" placeholder="Enter name">
                              @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                              <option value="admin" {{ old('role', $data->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                              <option value="peneliti" {{ old('role', $data->role ?? '') == 'peneliti' ? 'selected' : '' }}>Peneliti</option>
                          </select>
                          @error('role')
                              <small class="text-danger">{{ $message }}</small>
                          @enderror
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                  </div>
            </form>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
  </div>

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    @if (session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '{{ session('error') }}',
        timer: 5000,
        showConfirmButton: true
    });
    @endif
  </script>
@endsection