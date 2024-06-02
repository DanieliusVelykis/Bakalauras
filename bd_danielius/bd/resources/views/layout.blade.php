<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Danieliaus paslaugos')</title>
        <link rel="stylesheet" href="/css/index.css">
        <link rel="stylesheet" href="/css/registration.css">
        <link rel="stylesheet" href="/css/users.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.paypal.com/sdk/js?client-id=ARWHOwzu7QGGTmBXT8bKr821bDuOM2OmsIlDXL0mCg25S3yPruyIag4kSoYLasxvxa_1O1iWwjAlWxAh&currency=EUR"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    </head>
    <body>
        @include('includes.header')
        @yield('content')
    </body>
</html>