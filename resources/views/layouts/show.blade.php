@extends('layouts.app')

@section('content')
    <h1>{{ $galeri->name }}</h1>

    <img src="{{ asset('storage/' . $galeri->image_path) }}" alt="{{ $galeri->name }}" style="max-width: 100%; height: auto;">
    
    <p>Deskripsi galeri: {{ $galeri->description }}</p>

    <!-- Menampilkan tanggal update -->
    <p>Tanggal terakhir diubah: {{ $galeri->updated_at->format('d M Y, H:i') }}</p>

    <!-- Tombol kembali ke halaman utama -->
    <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
@endsection