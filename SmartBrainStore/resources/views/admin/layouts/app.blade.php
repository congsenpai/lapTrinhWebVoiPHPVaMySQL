<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartBrain - Fresh fruit - Smart Store</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ Vite::asset('resources/images/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Vite CSS and JS -->
    @vite(['resources/css/bootstrap.min.css', 'resources/css/animate.min.css', 'resources/css/nice-select.css', 'resources/css/slick.min.css', 'resources/css/styleclient.css', 'resources/css/style.css', 'resources/css/main-color.css', 'resources/js/jquery-3.4.1.min.js', 'resources/js/bootstrap.min.js', 'resources/js/bootstrap.js', 'resources/js/jquery.countdown.min.js', 'resources/js/jquery.nice-select.min.js', 'resources/js/jquery.nicescroll.min.js', 'resources/js/slick.min.js', 'resources/js/biolife.framework.js', 'resources/js/functions.js'])
    {{-- Other package --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}", '', {
                timeOut: 2000,
                positionClass: 'toast-bottom-right'
            });
        @endif
    
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}", '', {
                    timeOut: 2000,
                    positionClass: 'toast-bottom-right'
                });
            @endforeach
        @endif
    </script>
    <div class="container" style="width: 100%;margin: 0;padding: 0;">
        <div class="row">
            <div class="col-md-3" >@include('admin.layouts.sidebar')</div>
            <div class="col-md-9" style="padding-left: 80px">
                @include('admin.layouts.navbar')
                <main>
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>
