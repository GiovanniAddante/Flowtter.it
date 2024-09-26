<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap"
        rel="stylesheet">
    <link rel="icon" href="/media/surfboard.png">
    <title>{{ $title ?? 'flowtter.it' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-nav />
    {{ $slot }}
    <x-footer />
</body>

</html>
