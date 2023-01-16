@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <h1 class="h3 mb-3"><strong>Dashboard</strong> Home</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        @if (Auth::user()->role == 'user')
                            @if (empty(Auth::user()->profile))
                                <h3>Hai {{ Auth::user()->name }}, kamu belum melengkapi Profil Kamu</h3>
                                <a href="{{ route('profile.index') }}" class="text-danger"> Segera Lengkapi Profil Anda Untuk Kelancaran Proses
                                    Administrasi...,<u> Klik Disini untuk melengkapi Profil</u></a><br><br>
                            @else
                                <h2>Selamat Datang Kembali {{ Auth::user()->name }}</h2>

                                <div class="card">
                                    <div class="card-body">
                                        @if ($tugas->count() == 0)
                                            <div class="alert alert-success" role="alert">
                                                Hari ini anda tidak memiliki tugas
                                            </div>
                                        @else
                                            <div class="alert alert-danger mb-3" role="alert">
                                                Hari ini Ada {{ $tugas->count() }} tugas yang harus diselesaikan
                                            </div>

                                            <a href="{{ route('user.tugas.index') }}" class="btn btn-primary">Lihat Tugas</a>
                                        @endif
                                    </div>
                                </div>

                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
