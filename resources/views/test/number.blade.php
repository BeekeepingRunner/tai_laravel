<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Happy random number</title>
    </head>
    <body>
        <div>
            @if (count($numbers) > 0)
                <h2>Happy numbers are: </h2>
                <ul>
                    @foreach ($numbers as $element)
                    <li>{{ $element }}</li>
                    @endforeach
                </ul>
            @else
                <h2>No happy numbers</h2>
            @endif
        </div>
    </body>
</html>
