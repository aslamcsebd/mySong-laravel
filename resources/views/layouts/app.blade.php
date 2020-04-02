<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

   <head>
      @include('includes.head')
   </head>

   <body>

      {{-- total three part... --}}
     
      {{-- 1st part...  --}}
      @include('includes.header')

      {{-- 2nd part... --}}
      <main class="py-4 wrapper">
         @yield('content')
      </main>

      {{-- 3rd part... --}}
       @include('includes.footer')

   </body>
</html>