<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Beau Soleil</title>

    @livewireStyles

    <!-- Fonts -->
{{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"> --}}

<!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    @yield('styles')

</head>

<body>

<div class="app">
    <div id="sidebar" class="active">
        @include('partials.menu')

        <div id="main">

            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>

            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">

                        <div class="col-12 col-md-6 order-md-1 page-heading">
                            @yield('page_title_header')
                        </div>

                    </div>
                </div>

                <div class="page-content">
                    <div style="padding-top: 20px" class="container-fluid">
                        @if(session('message'))
                            <script>
                                window.addEventListener("load", function() {
                                    Toastify({
                                        text: "{{ session('message') }}",
                                        duration: 5000,
                                        close:true,
                                        gravity:"top",
                                        position: "right",
                                        backgroundColor: "#198754",
                                    }).showToast();
                                });
                            </script>
                        @endif
                        @if($errors->count() > 0)
                            @foreach($errors->all() as $error)
                                <script>
                                    window.addEventListener("load", function() {
                                        Toastify({
                                            text: "{{ $error }}",
                                            duration: 5000,
                                            close:true,
                                            gravity:"top",
                                            position: "right",
                                            backgroundColor: "#dc3545",
                                        }).showToast();
                                    });
                                </script>
                            @endforeach

                        @endif
                        @yield('content')

                    </div>
                </div>
            </div>

            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>

{{-- Modal de deconnexion --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confimer la déconnexion
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Vous êtes sur le point de vous déconnecter. Cliquer sur "Confirmer" pour valider l'action, ou "Fermer" pour annuler ...
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fermer</span>
                </button>
                <button type="button" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Confirmer</span>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->

<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/jquery3.5.1.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
<script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
<script src="{{ asset('assets/js/extensions/toastify.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

@livewireScripts

@yield('scripts')

</body>
</html>

