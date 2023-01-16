@extends('layouts.app')
@section('title', 'Tambah Tugas')

@section('content')
    <x-alerts />
    <div class="card">
        <div class="card-header">
            <u>Pemberian Tugas</u>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.tugas.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Pilih Karyawan</label>
                        <select name="user_id" class="select2 form-control bg-white" required>
                            <option disabled selected>Pilih Karyawan</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}" {{ old('user_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('user_id'))
                            <span class="text-danger">
                                {{ $errors->first('user_id') }}
                            </span>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Deadline</label>

                        <input name="berakhir" placeholder="Tanggal Deadline Tugas" data-toggle="datepicker3" type="text" class="form-control @error('berakhir') is-invalid @enderror" value="{{ old('berakhir') }}" required>
                        @error('berakhir')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold">Deskripsi Tugas</label>

                        <textarea name="tugas" rows="3" placeholder="Masukkan Deskripsi Tugas" class="form-control @error('tugas') is-invalid @enderror"  required>{{ old('tugas') }}</textarea>
                        @error('tugas')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" rows="3" placeholder="Masukkan Keterangan" class="form-control @error('keterangan') is-invalid @enderror"  required>{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md d-grid mt-3">
                    <button type="submit" class="btn btn-sm btn-primary mt-1">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection
