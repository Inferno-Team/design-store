<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <title>Design Shop</title>
</head>

<body>
    <div id="app" style="direction: rtl;margin:0;padding:0">
        <app></app>
    </div>
    <script src="{{ mix('js/app.js') }}">  </script>
</body>

</html>