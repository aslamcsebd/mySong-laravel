   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   {{-- <meta http-equiv="refresh" content="5" /> --}}

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>{{ config('app.name', 'My Song') }}</title>
   <link rel="icon" href="{{ asset('UserPhoto/music.png') }}" type="image/icon type">

   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

   <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
   
   {{-- Date picker --}}
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>    
   <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>   
   <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

   <!-- Styles -->
   <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">


