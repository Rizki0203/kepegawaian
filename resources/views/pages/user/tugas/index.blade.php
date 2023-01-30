@extends('layouts.app')
@section('title', 'List Tugas')

@section('content')
    <h1 class="h3 mb-3"><strong>Halaman</strong> List Tugas</h1>

    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    List Tugas
                </div>
                {{-- <div class="col-md-6 text-end">
                    <a href="{{ route('admin.tugas.create') }}" class="btn btn-sm btn-primary">
                        <i class="me-1" data-feather="plus"></i>Tambah Tugas Karyawan
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
                                <a href="{{ route('user.tugas.export', ['tanggal' => @$_GET['tanggal'], 'show' => @$_GET['show']]) }}" target="_blank" class="btn btn-outline-success btn-sm">
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
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tgl Tugas</th>
                                <th>Tgl Deadline</th>
                                <th>Status Hari</th>
                                <th>Status Pengerjaan</th>
                                <th>Tugas</th>
                                @foreach ($tugas as $item)
                                    @if ($item->is_complete == 0)
                                        <th>Aksi</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tugas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $item->user->name }} 
                                        @if ($item->created_at->isToday())
                                        <span class="badge bg-success text-white">Hari Ini</span>
                                    @endif</td>
                                    <td>{{ \Carbon\Carbon::parse($item->mulai)->isoFormat('DD MMM Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->berakhir)->isoFormat('DD MMM Y') }}</td>
                                    <td><span class="badge bg-warning text-dark">Sisa {{ $item->sisahari }}</span></td>
                                    <td>
                                            {!! $item->StatusComplete !!}
                                       
                                    </td>
                                    <td>{{ $item->tugas }}</td>
                                    @if ($item->is_complete == 0)
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm" onclick="selesaiConfirmation('{{ route('user.tugas.selesai', [$item->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Menandai Selesai">
                                                Tandai Selesai</button>
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
            <x-pagination :pagination="$tugas" />
        </div>
    @endsection
