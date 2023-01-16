@extends('layouts.app')
@section('title', 'Tambah Kinerja')

@section('content')
    <x-alerts />
    <div class="card">
        <div class="card-header">
            <u>Kinerja</u>
        </div>
        <div class="card-body">
            <form action="{{ route('user.kinerja.update', $kinerja->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Pilih Tugas yang telah dikerjakan</label>
                        <select name="tugas_id" class="select2 form-control bg-white" required>
                            <option disabled selected>Pilih Tugas</option>
                            @foreach ($tugas as $item)
                                <option value="{{ $item->id }}" {{ old('tugas_id', $kinerja->tugas_id) == $item->id ? 'selected' : '' }}>{{ $item->tugas }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('tugas_id'))
                            <span class="text-danger">
                                {{ $errors->first('tugas_id') }}
                            </span>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Aktifitas</label>
                        <textarea name="aktifitas" rows="3" placeholder="Masukkan Aktifitas anda hari ini" type="text" class="form-control @error('aktifitas') is-invalid @enderror" required>{{ old('aktifitas', $kinerja->aktifitas) }}</textarea>
                        @error('aktifitas')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold mt-3" for="keterangan">Keterangan</label>

                        <textarea name="keterangan" id="keterangan" cols="30" rows="2" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan">{{ old('keterangan', $kinerja->keterangan) }}</textarea>
                        @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md d-grid mt-3">
                    <button type="submit" class="btn btn-sm btn-success mt-1">Ubah</button>
                </div>
            </form>
        </div>
    </div>

@endsection
