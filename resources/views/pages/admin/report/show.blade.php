@extends('layouts.admin')

@section('title', 'Detail Laporan')

@section('content')
    <!-- Page Heading -->
    <a href="{{ route('admin.report.index') }}" class="mb-3 btn btn-danger">Kembali</a>

    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Detail Laporan</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Kode Laporan</td>
                    <td>{{ $report->code }}</td>
                </tr>
                <tr>
                    <td>Pelapor</td>
                    <td>{{ $report->resident->user->email }} - {{ $report->resident->user->name }}</td>
                </tr>
                <tr>
                    <td>Kategori Laporan</td>
                    <td>{{ $report->reportCategory->name }}</td>
                </tr>
                <tr>
                    <td>Judul Laporan</td>
                    <td>{{ $report->judul }}</td>
                </tr>
                <tr>
                    <td>Deskripsi Laporan</td>
                    <td>{{ $report->description }}</td>
                </tr>
                <tr>
                    <td>Bukti Laporan</td>
                    <td>
                        <img src="{{ asset('storage/' . $report->image) }}" alt="image" width="200">
                    </td>
                </tr>
                <tr>
                    <td>Latitude</td>
                    <td>{{ $report->latitude }}</td>
                </tr>
                <tr>
                    <td>LongitudeLo</td>
                    <td>{{ $report->longitude }}</td>
                </tr>
                <tr>
                    <td>Map View</td>
                    <td>
                        <div id="map" style="height: 300px"></div>
                    </td>
                </tr>
                <tr>
                    <td>Alamat Laporan</td>
                    <td>{{ $report->address }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mb-5 shadow card">
        <div class="mb-5 shadow card">
            <div class="py-3 card-header">
                <h6 class="m-0 font-weight-bold text-primary">Progress Laporan</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.report-status.create', $report->id) }}" class="mb-3 btn btn-primary">Tambah
                    Progress</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report->reportStatuses as $status)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($status->image)
                                            <img src="{{ asset('storage/' . $report->image) }}" alt="image"
                                                width="100">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        {{ $status->status }}
                                    </td>
                                    <td>
                                        {{ $status->description }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.report-status.edit', $report->id) }}"
                                            class="btn btn-warning">Edit</a>

                                        <a href="{{ route('admin.report-status.show', $report->id) }}"
                                            class="btn btn-info">Show</a>

                                        <form action="" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.report-status.destroy', $report->id) }}"
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
    </div>
@endsection

@section('scripts')
    <script>
        var mymap = L.map('map').setView([{{ $report->latitude }}, {{ $report->longitude }}], 13);

        var marker = L.marker([{{ $report->latitude }}, {{ $report->longitude }}]).addTo(mymap);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(mymap);

        marker.bindPopup("<b>Lokasi Laporan</b><br />beradadi {{ $report->address }}").openPopup();
    </script>
@endsection
