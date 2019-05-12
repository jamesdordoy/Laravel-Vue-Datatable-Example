<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Basic Laravel Vue DataTable</title>
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="container pt-5" id="app">
            <user-datatable>
            </user-datatable>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
