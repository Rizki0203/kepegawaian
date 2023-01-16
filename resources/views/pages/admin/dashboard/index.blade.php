@extends('layouts.app')
@section('title', 'Dashboard')


@section('content')
    <h1 class="h3 mb-3"><strong>Dashboard</strong> Home</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-auto">
                                <form>
                                    <input type="date" placeholder="Tanggal" class="form-control" name="date" onchange="this.form.submit();" value="{{ old('date', @$_GET['date']) }}" onfocus="(this.type='date')">
                                </form>
                            </div>
                            <div class="col-md d-flex justify-content-end">
                                <a href="{{ route('admin.dashboard.export', ['date' => @$_GET['date']]) }}" class="btn btn-primary btn-sm download text-white" id="download" target="_blank">
                                    Download PDF</a>
                            </div>
                        </div>
                        {!! $chart->container() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script src="{{ $chart->cdn() }}"></script>

        {{ $chart->script() }}
    @endpush
@endsection
