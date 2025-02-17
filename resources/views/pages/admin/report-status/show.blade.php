@extends('layouts.admin')

@section('title', 'Detail Kategori')

@section('content')
    <!-- Page Heading -->
    <a href="{{ route('admin.report-category.index') }}" class="mb-3 btn btn-danger">Kembali</a>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Detail Kategori</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Nama</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>Foto ProfilF</td>
                    <td>
                        <img src="{{ asset('storage/' . $category->image) }}" alt="image" width="200">
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
