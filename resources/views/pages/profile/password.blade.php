@extends('layouts.app')
@section('title', 'Profil')
@section('content')

@section('icon-heading', 'pe-7s-user icon-gradient bg-plum-plate')
@section('heading', 'Profil')
@section('subheading', 'Profil User Sistem Informasi Peminjaman Transportasi Yayasan Hasnur Centre')
<x-alerts />
<div class="card p-4">
    <div class="card-body">
        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 d-flex flex-column p-3">
                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle align-self-center" alt="" style="width: 120px; height: 120px" />
                    <h5 class="fw-bold mt-3 text-center">{{ Auth::user()->name }}</h5>
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-primary text-start mt-3">Data Diri</a>
                    <a href="#" class="btn btn-primary btn-shadow btn-outline-2x text-start mt-2">Password</a>
                </div>
                <div class="col-md-9 ps-5">
                    <div class="h5 fw-bold">Password</div>
                    <label class="form-label">Password Lama</label>
                    <div class="input-group position-relative mb-4">
                        <span class="input-group-text border-end-0 bg-transparent">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror border-start-0" placeholder="...............">
                        @error('old_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label class="form-label">Password Baru</label>
                    <div class="input-group position-relative mb-4">
                        <span class="input-group-text border-end-0 bg-transparent">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror border-start-0" placeholder="Minimal 5 karakter">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <div class="input-group position-relative mb-4">
                        <span class="input-group-text border-end-0 bg-transparent">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror border-start-0" placeholder="Minimal 5 karakter">
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary alert-profile">Ubah Password</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="text/javascript">
        $('.alert-profile').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Apakah anda yakin ingin Memperbarui Password ?",
                icon: "warning",
                buttons: ["Cancel", "Ubah!"],
            }).then((willApprove) => {
                if (willApprove) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
@endsection
