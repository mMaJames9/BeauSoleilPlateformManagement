
@extends('layouts.app')
@section('content')
    <div id="app">
        <div id="sidebar" class="active">
            @include('partials.menu')

            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>

                <div class="page-heading">
                    <h3>Statistiques de Beau Soleil</h3>
                </div>

                <div class="page-content">
                    <section class="row">
                        <div class="col-12 col-lg-9">
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <a href=" " class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                                        <div class="text-white card-body card-6">
                                                <span class="rotate">
                                                    <i class="fas fa-user display-4 card-icon"></i>
                                                </span>
                                            <div class="fw-bolder card-count fs-2 mb-2 mt-5">
                                                {{$data}} </div>
                                            <div class="fw-bold fs-7">
                                                Total Clients
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <a href="" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                                        <div class="text-white card-body card-4">
                                                <span class="rotate"><i class="fas fa-cube fa-4x display-4 card-icon text-white"></i></span>
                                            <div class="text-inverse-primary fw-bolder card-count fs-2 mb-2 mt-5 amount-position">
                                            {{$serv}}</div>
                                            <div class="fw-bold text-inverse-primary fs-7">total services </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <a href="" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                                        <div class="text-white card-body card-4">
                                                <span class="rotate"><i class="fas fa-cube fa-4x display-4 card-icon text-white"></i></span>
                                            <div class="text-inverse-primary fw-bolder card-count fs-2 mb-2 mt-5 amount-position">{{$tick}}</div>
                                            <div class="fw-bold text-inverse-primary fs-7">Total tickets </div>
                                        </div>
                                    </a>
                                </div>

                            </div>


                        </div>
                    </section>
                </div>

            </div>
        </div>
@endsection

 
 
