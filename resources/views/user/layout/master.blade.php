<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tittle')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    {{-- Link css, js vite --}}
    @vite([
    'resources/css/app.css',
    'resources/js/main.js',
    'resources/js/app.js',
    'resources/assets/vendor/bootstrap/css/bootstrap.min.css',
    'resources/assets/vendor/bootstrap-icons/bootstrap-icons.css',
    'resources/assets/vendor/boxicons/css/boxicons.min.css',
    'resources/assets/vendor/quill/quill.snow.css',
    'resources/assets/vendor/quill/quill.bubble.css',
    'resources/assets/vendor/remixicon/remixicon.css',
    'resources/assets/vendor/simple-datatables/style.css',
    'resources/assets/vendor/apexcharts/apexcharts.min.js',
    'resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/vendor/chart.js/chart.umd.js',
    'resources/assets/vendor/echarts/echarts.min.js',
    'resources/assets/vendor/quill/quill.min.js',
    'resources/assets/vendor/simple-datatables/simple-datatables.js',
    'resources/assets/vendor/tinymce/tinymce.min.js',
    'resources/assets/vendor/php-email-form/validate.js',
    ])

    {{-- Favicons --}}
    <link href="{{ Vite::asset('resources/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ Vite::asset('resources/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    {{-- Google Fonts --}}
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>

<body>

    @include('user.components.header')

    @yield('content')

    @include('user.components.footer')
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>

</html>
