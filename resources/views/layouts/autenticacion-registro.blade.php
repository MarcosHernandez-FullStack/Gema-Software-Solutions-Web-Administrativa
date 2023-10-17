<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GEMA -{{$titulo?? "=D"}}</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/autenticacionRegistro.css') }}" />
    @livewireStyles
</head>
<body>
	<div class="login">
		@yield('content')
	</div>
{{--     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/dist/js/autenticacionRegistro.js')}}"></script> --}}
    @livewireScripts
</body>

</html>
