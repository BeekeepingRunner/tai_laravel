<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        @section('sidebar')
            This is the master sidebar
        @show
        
        <div class="container">
            @yield('content')
        </div>
        
    </body>
</html>
