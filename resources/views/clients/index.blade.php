@extends('layouts.admin')

@section('title') Liste des Clients @endsection

@section('page_title_header')
    <h3>Liste des Clients</h3>
@endsection

@section('content')

    {{-- @can('client_create','client_edit','client_delete') --}}
        @if(session('status'))
            <script>
                window.addEventListener("load", function() {
                    Toastify({
                        text: "{{ session('status') }}",
                        duration: 5000,
                        close:true,
                        gravity:"top",
                        position: "right",
                        backgroundColor: "#198754",
                    }).showToast();
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                window.addEventListener("load", function() {
                    Toastify({
                        text: "{{ session('error') }}",
                        duration: 5000,
                        close:true,
                        gravity:"top",
                        position: "right",
                        backgroundColor: "#dc3545",
                    }).showToast();
                });
            </script>
        @endif
    {{-- @endcan --}}

    <div style="margin-bottom: 2rem;" class="row">
        <div class="col-lg-12">

        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table class="table table-responsive table-lg" class="display" id="tdclients">
                    <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Téléphone</th>
                        <th class="text-center">Créé le</th>
                        {{-- <th class="text-center"></th> --}}
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($clients as $client)
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td class="">
                                <span class="badge bg-light-primary my-1">
                                {{ $client->name_client ?? '' }}
                                </span>
                            </td>
                            <td class="">
                                <span class="badge bg-light-warning my-1">
                                {{ $client->phone_number ?? '' }}
                                </span>
                            </td>
                            <td>
                            <span class="badge bg-light-primary my-1">
                                {{ $client->created_at }}
                            </span>
                            </td>
                            {{-- <td class="text-center">
                                <a role="button" class="badge bg-light-danger" data-bs-toggle="modal"
                                   data-bs-target="#modal{{ $client->id }}">
                                    Delete
                                </a>

                                <div class="modal fade" id="modal{{ $client->id }}" tabindex="-1"
                                     aria-labelledby="deleteclient" aria-hidden="true" style="display: none;" role="dialog">
                                    <div class="modal-dialog modal-dialog modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">

                                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteclient">Confimer la suppression</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-left">
                                                    <p>Vous êtes sur le point de supprimer <span class="fw-bold">{{
                                                    $client->name_client }}</span>. Cliquez sur "Confirmer" pour valider ou sur "Fermer" pour annuler... </p>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" id="id" name="id" class="btn btn-xs btn-danger" value="Confirmer">

                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Fermer</span>
                                                    </button>

                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </td> --}}
                        </tr>
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

    $(document).ready(function() {

        var table = $('#tdclients').DataTable( {
            dom:'<"row my-4"<"col-4" l><"#buttons"<"col-4 d-inline-block text-center" B>><"col-4" f>> rtip',
            autoFill: true,
            lengthChange: true,
            responsive: true,
            lengthMenu: [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            select: true,

            columnDefs: [{
                orderable: false,
                // className: 'select-checkbox',
                targets: 0
            },
            {
                orderable: false,
                searchable: false,
                targets: -1
            }],

            select: {
                style:    'multi+shift',
                selector: 'td:first-child'
            },

            buttons: [

                {
                    extend: 'pdf',
                    className: 'my-1 btn-sm btn btn-dark',
                    exportOptions: {
                        columns: [ 1,2,3]
                    }
                },

                {
                    extend: 'print',
                    className: 'my-1 btn-sm btn btn-info',
                    exportOptions: {
                        columns: [ 1,2,3]
                    }
                }
            ],

            order: [[3, 'desc']],
            } );

            var cnt = $(".dt-buttons").contents();
            $(".dt-buttons").replaceWith(cnt);
            var cnta = $("#buttons").contents();
            $("#buttons").replaceWith(cnta);

        } );

    </script>

@endsection
