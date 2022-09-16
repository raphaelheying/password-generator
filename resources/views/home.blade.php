<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Password Generator</title>

        @vite('resources/css/app.css')
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <livewire:styles />

    </head>
    <body>
        <livewire:password-generator />
        <livewire:scripts />
    </body>
</html>
