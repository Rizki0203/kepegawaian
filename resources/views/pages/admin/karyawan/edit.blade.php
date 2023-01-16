@extends('layouts.app')
@section('title', 'Ubah Karyawan')

@section('content')
    <x-alerts />
    <div class="card">
        <div class="card-header">
            <u>Ubah Data Karyawan</u>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Nama Karyawan</label>
                        <div class="input-group position-relative mb-4">
                            <span class="input-group-text border-end-0 @error('name') border border-danger @enderror bg-transparent">
                                <i data-feather="user"></i>
                            </span>
                            <input name="name" placeholder="Masukkan Nama Karyawan" type="text" class="form-control border-start-0 @error('name') is-invalid @enderror bg-transparent" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label fw-bold">E-Mail Karyawan</label>
                        <div class="input-group position-relative">
                            <span class="input-group-text border-end-0 @error('email') border border-danger @enderror bg-transparent">
                                <i data-feather="mail"></i>
                            </span>
                            <input name="email" placeholder="Masukkan E-Mail Karyawan" type="text" aria-describedby="helpEmail" class="form-control border-start-0 @error('email') is-invalid @enderror bg-transparent" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Password</label>
                        <div class="input-group position-relative mb-4">
                            <span class="input-group-text border-end-0 @error('password') border border-danger @enderror bg-transparent">
                                <i data-feather="lock"></i>
                            </span>
                            <input data-role="input-password-element" placeholder="Enter password (Min 6 Character)" id="password" type="password" class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror" name="password" @if (!@$user) required @endif autocomplete="current-password">
                           
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md d-grid mt-5">
                    <button type="submit" class="btn btn-sm btn-success mt-1">Ubah</button>
                </div>
            </form>
        </div>
    </div>


@endsection
