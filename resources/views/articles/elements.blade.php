<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    {{--Common App Styles--}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>

{{--list--}}
@yield('content')

{{--Common Scripts--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>
</html>