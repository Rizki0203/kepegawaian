@extends('layouts.app')
@section('title', 'Karyawan')

@section('content')

    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    List Karyawan
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
                        <i class="me-1" data-feather="plus"></i>Tambah Data Karyawan
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="row no-gutters mb-4 mt-3">
                    <div class="col-md-auto">
                        <div class="row no-gutters">
                            <div class="col-md-auto pe-0">
                                <x-ordering class="form-select-sm" />
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend input-group-sm">
                                <span class="input-group-text border-0 bg-transparent">Search :</span>
                            </div>
                            <input placeholder="Search" id="search" type="search" name="search" onchange="this.form.submit();" value="{{ @$_GET['search'] }}" class="form-control form-control-sm rounded-3 fa-placeholder bg-transparent">

                        </div>
                    </div>
                        
                </div>
            </form>
            <div class="table-responsive">
                <table class="nowrap table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>E-Mail</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td width="50px">{{ $loop->iteration }}.</td>
                                <td>{{ $user->nidn }}</td>
                                <td class="d-flex align-items-center">
                                    <img src="{{ $user->avatar }}" class="img-fluid" width="52" height="100%">
                                    <div class="px-2 py-2">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="">{{ $user->name }}</a>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Klik Untuk Mengedit Data">
                                    <i data-feather="edit" class=" btn-icon-wrapper d-inline"></i></a>
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteConfirmation('{{ route('admin.users.destroy', [$user->id]) }}')" data-bs-toggle="tooltip" title="Klik Untuk Menghapus Data">
                                    <i  data-feather="trash" class=" btn-icon-wrapper d-inline" ></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">Tidak Ada Data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                {{-- <x-pagination :pagination="$users" /> --}}

            </div>
        </div>
    </div>
@endsection
