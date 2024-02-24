<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script
            src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
            integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
            crossorigin="anonymous">
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @vite(['resources/js/app.js', 'resources/js/login.js', 'resources/css/app.css'])
    </head>
    <body class="d-flex align-items-center justify-content-center vh-100">
        <div class="d-flex flex-column align-items-center justify-content-center w-50 shadow-lg rounded">
            <h3 class="pt-4 text-primary text-sm">Login Ke Akun Anda</h3>
            <form id="loginForm" class="container-sm p-4 max-w-sm">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <div class="input-group-text">@</div>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email">
                    </div>
                    <ul class="text-danger fs-6 flex-col mt-2" id="emailError"></ul>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <div id="showPassword" class="input-group-text p-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" id="showPasswordIcon" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" id="hidePasswordIcon" width="16" height="16" fill="currentColor" class="d-none bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                    <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/>
                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>
                                </svg>
                        </div>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="new-password" placeholder="password">
                    </div>
                    <ul class="text-danger fs-6 flex-col mt-2" id="passwordError"></ul>
                </div>
                <div class="col-auto">
                    <button type="submit" id="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>
