@extends('layouts.admin')

@section('page_title_header')
    <h3>Liste des Tickets</h3>
@endsection

@section('content')

    @can('ticket_create','ticket_edit','ticket_delete')
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
            <a class="btn btn-success" href="{{ route("tickets.create") }}">
                Ajouter un nouveau ticket
            </a>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table class="table table-responsive table-lg display" id="tdtickets">
                    <thead>
                    <tr>
                        <th class="text-center">Numéro</th>
                        <th class="text-center">Nom Client</th>
                        <th class="text-center" width="40%">Services</th>
                        <th class="text-center">Créée le</th>
                        <th class="text-center"></th>


                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($clients as $client)
                        @foreach($client->services->unique('num_ticket') as $ticket)

                            <tr class="">
                                <td class="">

                                    <span class="badge bg-light-primary my-1">
                                        {{ $ticket->pivot->num_ticket ?? '' }}
                                    </span>
                                </td>
                                <td class="">
                                    <span class="badge bg-light-primary my-1">
                                        {{ $client->name_client ?? '' }}
                                    </span>
                                </td>
                                <td class="">
                                    @foreach($client->services and $client->tickets as $ticket)
                                        <span class="badge bg-light-primary my-1">
                                        {{ $ticket->label_service ?? '' }}
                                    </span>
                                    @endforeach
                                </td>
                                <td class="">{{ $ticket->pivot->created_at ?? '' }}</td>
                                <td class="text-center">
                                    <a class="badge bg-light-secondary" href="{{ route('tickets.show', $client->id) }}">
                                        Show
                                    </a>

                                    <a role="button" class="badge bg-light-danger" data-bs-toggle="modal"
                                       data-bs-target="#modal{{ $client->id }}">
                                        Delete
                                    </a>

                                    <div class="modal fade" id="modal{{ $client->id }}" tabindex="-1"
                                         aria-labelledby="deleteticket" aria-hidden="true" style="display: none;"
                                         role="dialog">
                                        <div class="modal-dialog modal-dialog modal-dialog modal-dialog-scrollable"
                                             role="document">
                                            <div class="modal-content">

                                                <form action="{{ route('tickets.destroy', $ticket->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteticket">Confimer la
                                                            suppression</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-left">
                                                        <p>Vous êtes sur le point de supprimer le ticket No. <span
                                                                    class="fw-bold">{{ $ticket->id }}</span>.
                                                            Cliquez sur "Confirmer" pour valider ou sur "Fermer" pour
                                                            annuler... </p>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" id="id" name="id"
                                                               class="btn btn-xs btn-danger"
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
                        @endforeach
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
        let tdtickets = document.querySelector('#tdtickets');
        let dataTable = new simpleDatatables.DataTable(tdtickets);
    </script>
@endsection
