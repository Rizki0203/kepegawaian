@extends('layouts.app')
@section('title', 'Tambah Kontrak')

@section('content')
    <x-alerts />
    <div class="card">
        <div class="card-header">
            <u>Pembuatan Kontrak</u>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kontrak.store') }}" method="POST">
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
                            <label class="form-label">Jenis Kontrak</label><br/>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kontrak" id="flexRadioDefault1" value="honor" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Honor
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kontrak" id="flexRadioDefault2" value="part-time">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Part-Time
                                </label>
                            </div>
                            @error('jenis_kontrak')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mulai Kontrak</label>

                        <input name="mulai_kontrak" placeholder="Tanggal Mulai Kontrak" data-toggle="datepicker3" type="text" class="form-control @error('mulai_kontrak') is-invalid @enderror" value="{{ old('mulai_kontrak') }}" required>
                        @error('mulai_kontrak')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Berakhir Kontrak</label>

                        <input name="berakhir_kontrak" placeholder="Tanggal Berakhir kontrak" data-toggle="datepicker3" type="text" class="form-control @error('berakhir_kontrak') is-invalid @enderror" value="{{ old('berakhir_kontrak') }}" required>
                        @error('berakhir_kontrak')
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
