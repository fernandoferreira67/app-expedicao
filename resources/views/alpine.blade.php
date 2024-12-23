<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ALPINE JS -TEST</title>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-screen">
    <div class="flex items-center justify-center h-full min-h-screen">

        <div x-data>
            <span x-text="$store.counter.count"></span>
            <button @click="$store.counter.count++">Increment</button>
            <button @click="$store.counter.count--">Decrement</button>
        </div>

        <div x-data></div>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('counter', {count:0})
        })
    </script>
</body>
</html>
