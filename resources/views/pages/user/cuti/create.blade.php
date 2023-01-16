@extends('layouts.app')
@section('title', 'Tambah Pengajuan Cuti')

@section('content')
    <x-alerts />
    <div class="card">
        <div class="card-header">
            <u>Pengajuan Cuti</u>
        </div>
        <div class="card-body">
            <form action="{{ route('user.cuti.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mulai Cuti</label>

                        <input name="mulai_cuti" placeholder="Tanggal Mulai Cuti" data-toggle="datepicker3" type="text" class="form-control @error('mulai_cuti') is-invalid @enderror" value="{{ old('mulai_cuti') }}" required>
                        @error('mulai_cuti')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Berakhir Cuti</label>

                        <input name="berakhir_cuti" placeholder="Tanggal Berakhir Cuti" data-toggle="datepicker3" type="text" class="form-control @error('berakhir_cuti') is-invalid @enderror" value="{{ old('berakhir_cuti') }}" required>
                        @error('berakhir_cuti')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold mt-3" for="keterangan">Keterangan</label>

                        <textarea name="keterangan" id="keterangan" cols="30" rows="2" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan">{{ old('keterangan') }}</textarea>
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
