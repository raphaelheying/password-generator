<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Password Generator</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')
        <livewire:styles />

    </head>
    <body class="bg-gray-300">
        <div class="container mx-auto flex justify-center">
            <livewire:form-password-generator />
        </div>

        <livewire:scripts />
    </body>
</html>
