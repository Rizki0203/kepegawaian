@extends('layouts.app')
@section('title', 'Edit Pengajuan Cuti')

@section('content')
    <x-alerts />
    <div class="card">
        <div class="card-header">
            <u>Pengajuan Cuti</u>
        </div>
        <div class="card-body">
            <form action="{{ route('user.cuti.update', $cuti->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mulai Cuti</label>

                        <input name="mulai_cuti" placeholder="Tanggal Mulai Cuti" data-toggle="datepicker3" type="text" class="form-control @error('mulai_cuti') is-invalid @enderror" value="{{ old('mulai_cuti', $cuti->mulai_cuti) }}" required>
                        @error('mulai_cuti')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Berakhir Cuti</label>

                        <input name="berakhir_cuti" placeholder="Tanggal Berakhir Cuti" data-toggle="datepicker3" type="text" class="form-control @error('berakhir_cuti') is-invalid @enderror" value="{{ old('berakhir_cuti', $cuti->berakhir_cuti) }}" required>
                        @error('berakhir_cuti')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label fw-bold">Jenis Cuti</label>
                        <select name="jenis_cuti" class="select2 form-control bg-white" required>
                            <option disabled selected>Jenis Cuti</option>
                            
                                <option value="Cuti Keluarga" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'Cuti Keluarga' ? 'selected' : '' }}>Cuti Keluarga</option>
                                <option value="Cuti Ibadah" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'Cuti Ibadah' ? 'selected' : '' }}>Cuti Ibadah</option>
                                <option value="Cuti Karena Kesehatan" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'Cuti Karena Kesehatan' ? 'selected' : '' }}>Cuti Karena Kesehatan</option>
                                <option value="Cuti Melahirkan" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'Cuti Melahirkan' ? 'selected' : '' }}>Cuti Melahirkan</option>
                                <option value="Cuti Studi" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'Cuti Studi' ? 'selected' : '' }}>Cuti Studi</option>
                                <option value="Cuti untuk Kegiatan Sosial" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'Cuti untuk Kegiatan Sosial' ? 'selected' : '' }}>Cuti untuk Kegiatan Sosial</option>
                                <option value="Cuti Bersama" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'Cuti Bersama' ? 'selected' : '' }}>Cuti Bersama</option>
                        </select>
                        @if ($errors->has('jenis_cuti'))
                            <span class="text-danger">
                                {{ $errors->first('jenis_cuti') }}
                            </span>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold mt-3" for="keterangan">Keterangan</label>

                        <textarea name="keterangan" id="keterangan" cols="30" rows="2" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan">{{ old('keterangan', $cuti->keterangan) }}</textarea>
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
