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
                <div class="col-md-6 text-end">
                    <a href="{{ route('user.cuti.create') }}" class="btn btn-sm btn-primary">
                        <i class="bx bx-plus me-1"></i>Ajukan Cuti
                    </a>
                </div>
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
                                <th>Tanggal</th>
                                <th>Mulai Cuti</th>
                                <th>Berakhir Cuti</th>
                                <th>Jenis Cuti</th>
                                <th>Keterangan</th>
                                <th>Status Hari</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cuti as $item)
                                <tr>
                                    <td width="50px">{{ $loop->iteration }}.</td>
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
                                    @if ($item->is_approved == 0)
                                        <td>
                                            <a href="{{ route('user.cuti.edit', $item->id) }}" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Klik Untuk Mengedit Data">
                                                <i class="btn-icon-wrapper d-inline" data-feather="edit"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteConfirmation('{{ route('user.cuti.destroy', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Menghapus Data">
                                                <i class="btn-icon-wrapper d-inline" data-feather="trash"></i></button>
                                        </td>
                                    @elseif($item->is_approved == 1)
                                        <td>
                                            <a href="{{ route('admin.cuti.export', $item->id) }}" target="_blank" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Klik Untuk Mendownload Data">
                                                Download
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteConfirmation('{{ route('user.cuti.destroy', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Menghapus Data">
                                                <i data-feather="trash" class="btn-icon-wrapper d-inline"></i></button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-url="{{ route('admin.cuti.alasan-reject', $item->id) }}" data-bs-toggle="modal" data-bs-target=".modalOpen" data-title="Alasan Reject">
                                                    <small>Alasan Reject</small></button>
                                            </td>
                                    @endif

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
