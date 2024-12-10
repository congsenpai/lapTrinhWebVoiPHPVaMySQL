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
    @vite(['resources/css/bootstrap.min.css', 'resources/css/animate.min.css', 'resources/css/nice-select.css', 'resources/css/slick.min.css', 'resources/css/styleclient.css', 'resources/css/main-color.css', 'resources/js/jquery-3.4.1.min.js', 'resources/js/bootstrap.min.js', 'resources/js/bootstrap.js', 'resources/js/jquery.countdown.min.js', 'resources/js/jquery.nice-select.min.js', 'resources/js/jquery.nicescroll.min.js', 'resources/js/slick.min.js', 'resources/js/biolife.framework.js', 'resources/js/functions.js'])
    {{-- Other package --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>


<body class="biolife-body">
    <!-- Preloader -->
    <div id="biof-loading">
        <div class="biof-loading-center">
            <div class="biof-loading-center-absolute">
                <div class="dot dot-one"></div>
                <div class="dot dot-two"></div>
                <div class="dot dot-three"></div>
            </div>
        </div>
    </div>
    @include('client.layouts.header')
    <main>
        <script>
            @if (session('success'))
                toastr.success("{{ session('success') }}", '', {
                    timeOut: 5000,
                    positionClass: 'toast-bottom-right'
                });
            @endif
            @if (session('info'))
                toastr.info("{{ session('info') }}", '', {
                    timeOut: 5000,
                    positionClass: 'toast-bottom-right'
                });
            @endif
        
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}", '', {
                        timeOut: 5000,
                        positionClass: 'toast-bottom-right'
                    });
                @endforeach
            @endif
        </script>
        
        @yield('content')
    </main>
    @include('client.layouts.footer')

</body>

</html>
