@extends('layouts.app')
@section('title', 'Pengajuan Cuti')

@section('content')

    <h1 class="h3 mb-3"><strong>Halaman</strong> Pengajuan Cuti</h1>

    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    Pengajuan Cuti
                </div>
                {{-- <div class="col-md-6 text-end">
                    <a href="{{ route('user.cuti.create') }}" class="btn btn-sm btn-primary">
                        <i class="bx bx-plus me-1"></i>Ajukan Cuti
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
                                <a href="{{ route('admin.cuti.exportlist', ['tanggal' => @$_GET['tanggal'], 'show' => @$_GET['show']]) }}" target="_blank" class="btn btn-outline-success btn-sm">
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
                                <th>Karyawan</th>
                                <th>Tanggal</th>
                                <th>Mulai Cuti</th>
                                <th>Berakhir Cuti</th>
                                <th>Jenis Cuti</th>
                                <th>Keterangan</th>
                                <th>Hari</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cuti as $item)
                                <tr>
                                    <td>
                                        @if ($item->is_approved == 0)
                                            <button type="button" class="btn btn-outline-success btn-sm" onclick="approveConfirmation('{{ route('admin.cuti.approve', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Mengapprove Data">
                                                Approve</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-url="{{ route('admin.cuti.reject', $item->id) }}" data-bs-toggle="modal" data-bs-target=".modalOpen" data-title="Masukkan Alasan Reject">
                                                <i data-feather="minus-circle"></i></button>
                                        @elseif($item->is_approved == 1)
                                            <a href="{{ route('admin.cuti.export', $item->id) }}" target="_blank" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Klik Untuk Mendownload Data">
                                                Download
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteConfirmation('{{ route('admin.cuti.destroy', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Menghapus Data">
                                                <i data-feather="trash" class="btn-icon-wrapper d-inline"></i></button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-url="{{ route('admin.cuti.alasan-reject', $item->id) }}" data-bs-toggle="modal" data-bs-target=".modalOpen" data-title="Alasan Reject">
                                                    <small>Alasan Reject</small></button>
                                        @endif
                                    </td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMM Y') }}</td>
                                    <td>{{ $item->mulai_cuti }}</td>
                                    <td>{{ $item->berakhir_cuti }}</td>
                                    <td>{{ $item->jenis_cuti }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->mulai_cuti)->diffInDays($item->berakhir_cuti) + 1 }} Hari
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

                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">Tidak Ada Data</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
            <x-pagination :pagination="$cuti" />
        </div>
        <x-modal class="modal-lg" />
    @endsection
