<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script
            src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
            integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
            crossorigin="anonymous">
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @vite(['resources/js/app.js', 'resources/js/home.js', 'resources/css/app.css'])
    </head>
    <body class="">
        <div class="d-flex flex-wrap align-items-center justify-content-center" id="post-item-wrapper"></div>
    </body>
    <template id="post-item-template">
        <div id="post-item" class="card m-2 align-items-start" style="width: 18rem; min-height: 380px; max-height:500px;">
            <img id="post-image" src="..." class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 id="post-title" class="card-title">Card title</h5>
              <p id="post-body" class="card-text d-none" style="max-height: 100px; overflow:hidden;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <button type="button" id="post-button" class="btn btn-primary">Go somewhere</button>
            </div>
        </div>
    </template>
</html>
