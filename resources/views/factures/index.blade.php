@extends('layouts.admin')

@section('title') Liste des Factures @endsection

@section('page_title_header')
    <h3>Liste des Factures</h3>
@endsection


@section('content')

    {{-- @can('facture_create','facture_edit','facture_delete') --}}
        @if(session('status'))
            <script>
                window.addEventListener("load", function () {
                    Toastify({
                        text: "{{ session('status') }}",
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        position: "right",
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
                        position: "right",
                        backgroundColor: "#dc3545",
                    }).showToast();
                });
            </script>
        @endif
    {{-- @endcan --}}

    <div style="margin-bottom: 2rem;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-secondary" href="{{ route("factures.create") }}">
                Ajouter une nouvelle facture
            </a>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="col-5 mb-5">
                    <table class="table table-borderless w-20">
                        <tbody>
                            <tr>
                                <td>Date Minimale: </td>
                                <td>
                                    <input class="form-control" type="text" id="min" name="min">
                                </td>
                                <td>Date Maximale: </td>
                                <td>
                                    <input class="form-control" type="text" id="max" name="max">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="table table-responsive table-lg display" id="tdfactures">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Numéro</th>
                        <th class="text-center">Nom Client</th>
                        <th class="text-center" width="40%">Services</th>
                        <th class="text-center">Montant Total</th>
                        <th class="text-center">Créée le</th>
                        {{-- <th class="text-center"></th> --}}
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach ($factures as $facture)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="">
                            <span class="badge bg-light-primary my-1">
                                {{ $facture->num_ticket }}
                            </span>
                        </td>
                        <td class="">
                            <span class="badge bg-light-secondary my-1">
                                {{ $facture->client->name_client ?? '' }}
                            </span>
                        </td>
                        <td class="">
                            @foreach ($facture->services as $service)
                            <span class="badge bg-light-primary my-1">
                                {{ $service->label_service }}
                            </span>
                            @endforeach
                        </td>
                        <td class="">
                            <span class="badge bg-light-warning my-1">
                                {{ $facture->total_price }} FCFA
                            </span>
                        </td>
                        <td class="">
                            <span class="badge bg-light-primary my-1">
                                {{ $facture->created_at }}
                            </span>
                        </td>
                        {{-- <td class="">
                            <a class="badge bg-light-secondary" href="{{ route('factures.show', $facture->id) }}">
                                Show
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
                                                <p>Vous êtes sur le point de supprimer la facture No. <span class="fw-bold">{{
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

    var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[5] );

                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
            );
                $(document).ready(function() {

                    minDate = new DateTime($('#min'), {
                        format: 'Do MMMM YYYY'
                    });
                    maxDate = new DateTime($('#max'), {
                        format: 'Do MMMM YYYY'
                    });

                    var table = $('#tdfactures').DataTable( {
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
                                    columns: [ 1,2,3,4,5]
                                }
                            },

                            {
                                extend: 'print',
                                className: 'my-1 btn-sm btn btn-info',
                                exportOptions: {
                                    columns: [ 1,2,3,4,5]
                                }
                            }
                        ],

            order: [[5, 'desc']],
            } );

            var cnt = $(".dt-buttons").contents();
            $(".dt-buttons").replaceWith(cnt);
            var cnta = $("#buttons").contents();
            $("#buttons").replaceWith(cnta);

            $('#min, #max').on('change', function () {
                table.draw();
            });

        } );

</script>
@endsection
