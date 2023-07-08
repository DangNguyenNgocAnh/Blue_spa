<!DOCTYPE html>

<html>

<head>
    <title>404 - Not found</title>
    {{-- Link css, js vite --}}
    @vite([
    'resources/css/errors.css',
    ])
</head>

<body>
    <div class="error-page">
        <div>
            <h1 data-h1="404">404</h1>
            <p data-p="NOT FOUND">NOT FOUND</p>
        </div>
    </div>
</body>

</html>
