<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/vendor.bundle.addons.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('backend/images/logo_2H_tech.png')}}"/>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        {{-- stard navbar1 --}}
        @include('include.navbar1')
        {{-- end  navbar1 --}}
        <div class="container-fluid page-body-wrapper">

            {{-- stard navbar2 --}}
            @include('include.navbar2')
            {{-- end  navbar2 --}}
            {{-- stard content --}}
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('contenu')
                </div>
                @include('include.adminfooter');
            </div>
            {{-- end content --}}
        </div>
        <!--page body wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{asset('backend/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('backend/js/vendor.bundle.addons.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{asset('backend/js/off-canvas.js')}}"></script>
    <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('backend/js/template.js')}}"></script>
    <script src="{{asset('backend/js/settings.js')}}"></script>
    <script src="{{asset('backend/js/todolist.js')}}"></script>
    <script src="{{asset('backend/js/bootbox.min.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    @yield('scripts')
    <!-- End custom js for this page-->
    <script>
        $(document).on('click', '#delete', function(e){
            e.preventDefault();
            var link = $(this).attr("href");
            bootbox.confirm("Voulez-vous vraiment supprimer cet élement ?", function(confirmed){
                if(confirmed){
                    window.location.href = link;
                };
            });
        });
    </script>
</body>
</html>
