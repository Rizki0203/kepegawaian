@extends('layouts.app')
@section('title', 'Pengajuan Dinas')

@section('content')
    <h1 class="h3 mb-3"><strong>Halaman</strong> Pengajuan Dinas</h1>

    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    Pengajuan Dinas
                </div>
                {{-- <div class="col-md-6 text-end">
                    <a href="{{ route('admin.kontrak.create') }}" class="btn btn-sm btn-primary">
                        <i class="me-1" data-feather="plus"></i>Tambah Kontrak Karyawan
                    </a>
                </div> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-auto">
                        <form>
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
                    </div>
                    <div class="col-md-auto">
                        <form id="form-filter">
                            <div class="row no-gutters mb-4 mt-3">

                                <div class="col-md-auto pe-0">
                                    <div class="form-group">
                                        <input type="text" name="tanggal" id="tanggal" value="{{ old('tanggal', @$_GET['tanggal']) }}" class="custom-select custom-select-sm form-control form-control-sm" data-toggle="daterangepicker" autocomplete="off">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-auto">
                        <div class="row no-gutters mb-4 mt-3">
                            <div class="col-md-auto">
                                <a href="{{ route('admin.dinas.exportlist', ['tanggal' => @$_GET['tanggal']]) }}" target="_blank" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-file-export mr-1"></i>Export
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 mt-3 d-flex justify-content-end">
                        <form>
                            <div class="input-group">
                                <div class="input-group-prepend input-group-sm">
                                    <span class="input-group-text border-0 bg-transparent">Search :</span>
                                </div>
                                <input placeholder="Search" id="search" type="search" name="search" onchange="this.form.submit();" value="{{ @$_GET['search'] }}" class="form-control form-control-sm rounded-3 fa-placeholder bg-transparent">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="nowrap table">
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>Status</th>
                                <th>Nama</th>
                                <th>Kepada Yth.</th>
                                <th>Perihal</th>
                                <th>Keperluan Dinas</th>
                                <th>Jmlh Lampiran</th>
                                <th>Alasan</th>
                                <th>Tgl Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dinas as $item)
                                <tr>
                                    <td>
                                        @if ($item->is_approved == 0)
                                            <button type="button" class="btn btn-outline-success btn-sm" onclick="approveConfirmation('{{ route('admin.dinas.approve', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Mengapprove Data">
                                                Approve</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="rejectConfirmation('{{ route('admin.dinas.reject', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Mereject Data">
                                                <i data-feather="minus-circle"></i></button>
                                        @elseif($item->is_approved == 1)
                                            <a href="{{ route('admin.dinas.export', $item->id) }}" target="_blank" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Klik Untuk Mendownload Data">
                                                Download
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteConfirmation('{{ route('admin.dinas.destroy', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Menghapus Data">
                                                <i data-feather="trash" class="btn-icon-wrapper d-inline"></i></button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->is_approved == 0)
                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                        @elseif($item->is_approved == 1)
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->tujuan }}</td>
                                    <td>{{ $item->perihal }}</td>
                                    <td>{{ $item->jenis_surat_dinas }}</td>
                                    <td>{{ $item->dinas_lampiran_count }} Lampiran</td>
                                    <td>{{ $item->alasan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMM Y') }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="9">Tidak Ada Data</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
            <x-pagination :pagination="$dinas" />
        </div>
    @endsection