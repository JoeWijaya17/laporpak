@extends('layouts.admin')

@section('title', 'Data Masyarakat')

@section('content')
    <a href="{{ route('admin.resident.create') }}" class="mb-3 btn btn-primary">Tambah Data</a>

    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Data Masyarakat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Avatar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($residents as $resident)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $resident->user->email }}</td>
                                <td>{{ $resident->user->name }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $resident->avatar) }}" alt="avatar" width="100">
                                </td>
                                <td>
                                    <a href="{{ route('admin.resident.edit', $resident->id) }}"
                                        class="btn btn-warning">Edit</a>

                                    <a href="{{ route('admin.resident.show', $resident->id) }}"
                                        class="btn btn-info">Show</a>

                                    <form action="" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('admin.resident.destroy', $resident->id) }}"
                                            class="btn btn-danger" data-confirm-delete="true">Delete</a>
                                        {{-- <button type="submit" class="btn btn-danger"
                                            data-confirm-delete="true">Delete</button> --}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
