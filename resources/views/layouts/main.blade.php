<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}{{ isset($title) ? ' | ' . $title : '' }}</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: {
                            500: '#f97316',
                            600: '#ea580c',
                        },
                        primary: '#f97316',
                        secondary: '#6b7280',
                        success: '#10b981',
                        danger: '#ef4444',
                        warning: '#f59e0b',
                        info: '#3b82f6',
                    },
                    fontFamily: {
                        sans: ['Source Sans Pro', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css?v=3.2.0">
    
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini bg-gray-50">

<div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <div class="content-wrapper">
        @hasSection('title-content')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-xl font-semibold text-gray-800">
                            @yield('title-content')
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <section class="content p-4">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </section>
    </div>

    @include('layouts.footer')
</div>

@stack('modals')

<!-- Scripts -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/plugins/chart.js/Chart.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js?v=3.2.0"></script>

<!-- Custom Tailwind Components -->
<script>
    // Add active class to current nav item
    $(document).ready(function() {
        const currentUrl = window.location.href;
        $('.nav-link').each(function() {
            if (this.href === currentUrl) {
                $(this).addClass('bg-orange-100 text-orange-600');
                $(this).find('.nav-icon').addClass('text-orange-500');
            }
        });
    });
</script>

@stack('scripts')

</body>
</html>