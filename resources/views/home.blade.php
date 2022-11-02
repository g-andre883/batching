<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
</head>

<body class="antialiased">
    @component('components.header')
    @endcomponent
    <div class="container">
        <div class="form">
            <div class="jumbotron">
                <h3>Laravel Job Batching </h3>
                <hr>
                <strong>Upload 5 Milion records or more</strong>
                <hr>
                <h2> In The Background</h2>
            </div>
        </div>
    </div>
</body>

</html>
