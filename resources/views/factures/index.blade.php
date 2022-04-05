@extends('layouts.admin')

@section('page_title_header')
    <h3>Liste des factures</h3>
@endsection

@section('content')

    @can('facture_create','facture_edit','facture_delete')
        @if(session('status'))
            <script>
                window.addEventListener("load", function () {
                    Toastify({
                        text: "{{ session('status') }}",
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#198754",
                    }).showToast();
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                window.addEventListener("load", function () {
                    Toastify({
                        text: "{{ session('error') }}",
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#dc3545",
                    }).showToast();
                });
            </script>
        @endif
    @endcan

    <div style="margin-bottom: 2rem;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("factures.create") }}">
                Ajouter une nouvelle facture
            </a>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table class="table table-responsive table-lg display" id="tdfactures">
                    <thead>
                    <tr>
                        <th class="text-center">Numéro</th>
                        <th class="text-center">Nom Client</th>
                        <th class="text-center" width="40%">Services</th>
                        <th class="text-center" width="40%">Montant Total</th>
                        <th class="text-center">Créée le</th>
                        <th class="text-center"></th>


                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($factures as $facture)
                        <tr>
                            <td class="">
                                <span class="badge bg-light-primary my-1">
                                    {{ $facture->num_ticket ?? '' }}
                                </span>
                            </td>
                            <td class="">
                                <span class="badge bg-light-primary my-1">
                                    {{ $facture->client->name_client ?? '' }}
                                </span>
                            </td>
                            <td class="">
                                @foreach($facture->client as $services)
                                <span class="badge bg-light-primary my-1">
                                    {{ $services }}
                                @endforeach
                                </span>
                            </td>
                            <td class="">
                                <span class="badge bg-light-primary my-1">
                                    {{ $facture->total_price }} FCFA
                                </span>
                            </td>
                            <td class="">
                                <span class="badge bg-light-primary my-1">
                                    {{ $facture->created_at }}
                                </span>
                            </td>
                            <td class="">
                                <a class="badge bg-light-secondary" href="{{ route('factures.edit', $facture->id) }}">
                                    Edit
                                </a>

                                <a role="button" class="badge bg-light-danger" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $facture->id }}">
                                    Delete
                                </a>

                                <div class="modal fade" id="modal{{ $facture->id }}" tabindex="-1"
                                    aria-labelledby="deleteservice" aria-hidden="true" style="display: none;"
                                    role="dialog">
                                    <div class="modal-dialog modal-dialog modal-dialog modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">

                                            <form action="{{ route('factures.destroy', $facture->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteservice">Confimer la
                                                        suppression</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-left">
                                                    <p>Vous êtes sur le point de supprimer <span class="fw-bold">{{
                                                    $facture->num_ticket }}</span>. Cliquez sur "Confirmer" pour
                                                        valider ou sur "Fermer" pour annuler... </p>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" id="id" name="id" class="btn btn-xs btn-danger"
                                                        value="Confirmer">

                                                    <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Fermer</span>
                                                    </button>

                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                            {{-- @foreach($client->services as $panier)
                            <tr class="">
                                <td>{{ $loop->iteration }}</td>

                                <td class="">
                                        <span class="badge bg-light-warning
                                    my-1">
                                            {{ $facture->price_service ?? '' }} FCFA
                                    </span>
                                </td>
                                <td class="">{{ $facture->created_at ?? '' }}</td>
                                <td class="text-center">

                                </td>
                            </tr>
                        @endforeach --}}
                    @endforeach
                    </tbody>
                </table>
            </div>



        </div>

    </section>
@endsection


@section('scripts')
    @parent

    <script>
        // Simple Datatable
        let tdfactures = document.querySelector('#tdfactures');
        let dataTable = new simpleDatatables.DataTable(tdfactures);
    </script>
@endsection
