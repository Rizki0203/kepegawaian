@extends('layouts.app')
@section('title', 'Tambah Pengajuan Dinas')

@section('content')
    <x-alerts />
    <div class="card">
        <div class="card-header">
            <u>Pengajuan Dinas</u>
        </div>
        <div class="card-body">
            <form action="{{ route('user.dinas.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <label class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control @error('user_id') is-invalid @enderror" disabled value="{{ Auth::user()->name }}" required>
                        @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Kepada Yth.</label>
                        <input name="tujuan" placeholder="Masukkan Tujuan Surat Kepada Yth." type="text" class="form-control @error('tujuan') is-invalid @enderror" value="{{ old('tujuan') }}" required>
                        @error('tujuan')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Perihal</label>
                        <input name="perihal" placeholder="Masukkan Perihal" type="text" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal') }}" required>
                        @error('perihal')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Tujuan Pembuatan Surat</label>
                        <input name="jenis_surat_dinas" placeholder="Masukkan Tujuan Pembuatan Surat (contoh: Mutasi Tempat Kerja)" type="text" class="form-control @error('jenis_surat_dinas') is-invalid @enderror" value="{{ old('jenis_surat_dinas') }}" required>
                        @error('jenis_surat_dinas')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold" for="alasan">Alasan</label>
                        <textarea name="alasan" id="alasan" cols="30" rows="2" class="form-control @error('alasan') is-invalid @enderror" placeholder="Masukkan alasan">{{ old('alasan') }}</textarea>
                        @error('alasan')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <label class="form-label fw-bold" for="alasan">Lampiran</label>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Photocopy KTP" name="lampiran[]" id="ktp">
                            <label class="form-check-label" for="ktp">
                                Photocopy KTP
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Photocopy SIM" name="lampiran[]" id="sim">
                            <label class="form-check-label" for="sim">
                                Photocopy SIM
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Photocopy KK" name="lampiran[]" id="kk">
                            <label class="form-check-label" for="kk">
                                Photocopy KK
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Photocopy Sertifikat" name="lampiran[]" id="sertifikat">
                            <label class="form-check-label" for="sertifikat">
                                Photocopy Sertifikat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Photocopy SK CPNS" name="lampiran[]" id="cpns">
                            <label class="form-check-label" for="cpns">
                                Photocopy SK CPNS
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Photocopy SK PNS" name="lampiran[]" id="pns">
                            <label class="form-check-label" for="pns">
                                Photocopy SK PNS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Photocopy SK Terakhir" name="lampiran[]" id="terakhir">
                            <label class="form-check-label" for="terakhir">
                                Photocopy SK Terakhir
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Photocopy DP3" name="lampiran[]" id="dp3">
                            <label class="form-check-label" for="dp3">
                                Photocopy DP3
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Photocopy Ijazah dan Transkrip Nilai" name="lampiran[]" id="ijazah">
                            <label class="form-check-label" for="ijazah">
                                Photocopy Ijazah dan Transkrip Nilai
                            </label>
                        </div>

                    </div>
                </div>
                <small class="text-muted"><i>Note: Pilih Lampiran yang diperlukan</i></small>

                <div class="col-md d-grid mt-3">
                    <button type="submit" class="btn btn-sm btn-primary mt-1">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection
