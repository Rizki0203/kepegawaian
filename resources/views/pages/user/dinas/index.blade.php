@extends('layouts.app')
@section('title', 'Pindah Dinas')

@section('content')
    <h1 class="h3 mb-3"><strong>Halaman</strong> Pindah Dinas</h1>

    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    Pindah Dinas
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('user.dinas.create') }}" class="btn btn-sm btn-primary">
                        <i class="me-1" data-feather="plus"></i>Ajukan Dinas
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
                                <th>Aksi</th>
                                <th>Status</th>
                                <th>Nama</th>
                                <th>Kepada Yth.</th>
                                <th>Perihal</th>
                                <th>Tujuan Dinas</th>
                                <th>Tanggal</th>
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
                                            <a href="{{ route('user.dinas.edit', $item->id) }}" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Klik Untuk Mengedit Data">
                                                <i data-feather="edit" class="btn-icon-wrapper d-inline"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteConfirmation('{{ route('user.dinas.destroy', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Menghapus Data">
                                                <i data-feather="trash" class="btn-icon-wrapper d-inline"></i></button>
                                        @elseif($item->is_approved == 1)
                                            <a href="{{ route('admin.dinas.export', $item->id) }}" target="_blank" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Klik Untuk Mendownload Data">
                                                Download
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteConfirmation('{{ route('user.dinas.destroy', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Menghapus Data">
                                                <i data-feather="trash" class="btn-icon-wrapper d-inline"></i></button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-url="{{ route('admin.dinas.alasan-reject', $item->id) }}" data-bs-toggle="modal" data-bs-target=".modalOpen" data-title="Alasan Reject">
                                                    <small>Alasan Reject</small></button>
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
                                    <td>{{ \Carbon\Carbon::parse($item->mulai_dinas)->isoFormat('DD MMM Y') }} - {{ \Carbon\Carbon::parse($item->berakhir_dinas)->isoFormat('DD MMM Y') }}</td>
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
        <x-modal class="modal-lg" />
    @endsection
