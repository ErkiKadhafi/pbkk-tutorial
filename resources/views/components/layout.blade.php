<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $titlePage }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .layout {
            max-width: 68.75rem;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

    </style>
</head>

<body>
    {{ $slot }}
</body>

</html>
