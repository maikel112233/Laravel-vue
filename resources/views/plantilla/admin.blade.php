<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>ADMIN</title>
  </head>
  <body>
   
    <div class="container-scroller">
        @include('plantilla.parciales.nav')
        <div class="container-fluid page-body-wrapper">
            @include('plantilla.parciales.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @include('plantilla.parciales.breadcrumb')
                    <!--Contenido-->
                    @yield('contenido')     
                </div>
                @include('plantilla.parciales.footer')
            </div>
        </div> 
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
  </body>
</html>