@extends('layouts.app')
@section('title', 'Kontrak Karyawan')

@section('content')
    <h1 class="h3 mb-3"><strong>Halaman</strong> Kontrak Karyawan</h1>

    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    Kontrak Karyawan
                </div>
                {{-- <div class="col-md-6 text-end">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary">
                        <i class="me-1" data-feather="plus"></i>Tambah Kontrak Karyawan
                    </a>
                </div> --}}
            </div>
            <div class="card-body">
                <form id="form-filter">
                    <div class="row no-gutters mb-4 mt-3">
                        <div class="col-md-auto">
                            <div class="row no-gutters">
                                <div class="col-md-auto pe-0">
                                    <x-ordering class="form-select-sm" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="nowrap table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kontrak</th>
                                <th>Mulai Kontrak</th>
                                <th>Berakhir Kontrak</th>
                                <th>Sisa Kontrak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kontrak as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->jenis_kontrak }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->mulai_kontrak)->isoFormat('DD MMM Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->berakhir_kontrak)->isoFormat('DD MMM Y') }}</td>
                                    <td><span class="badge bg-primary">{{ $item->totalhari }}</span></td>
                                    <td>
                                        <a href="{{ route('user.kontrak.export', $item->id) }}" target="_blank" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" title="Klik Untuk Mendownload">Download</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">Tidak Ada Data</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
            <x-pagination :pagination="$kontrak" />
        </div>
    @endsection
