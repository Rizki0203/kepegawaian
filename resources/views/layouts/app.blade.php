<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/bphl.png') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>@yield('title') - Kepegawaian</title>

    @include('includes.styles')
    @stack('after-styles')
</head>

<body>
    @include('sweetalert::alert')

    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">BPHP IX Banjarbaru</span>
                </a>

                @include('includes.sidebar')
            </div>
        </nav>

        <div class="main">
            @include('includes.navbar')

            <main class="content">
                <div class="container-fluid p-0">
                    <x-alerts />
                    @yield('content')

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <p class="mb-0">
                        <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Balai Pengelolaan Hutan Produksi Wilayah IX Banjarbaru</strong></a> &copy;
                    </p>
                </div>
            </footer>
        </div>
    </div>

    @include('includes.script')
    @stack('after-scripts')

</body>

</html>
