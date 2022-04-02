@extends('layouts.admin')

@section('page_title_header')
    <h3>Liste des Services</h3>
@endsection

@section('content')

    @can('service_create','service_edit','service_delete')
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
            <a class="btn btn-success" href="{{ route("services.create") }}">
                Ajouter un nouveau service
            </a>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table class="table table-responsive table-lg" class="display" id="tdservices">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Nom Service</th>
                        <th class="text-center">Catégorie</th>
                        <th class="text-center">Créée le</th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($services as $service)
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td class="">
                                <span class="badge bg-light-primary
                                my-1">
                                    {{ $service->label_service ?? '' }}
                                </span>
                            </td>
                            <td class="">
                                    <span class="badge bg-light-warning
                                my-1">
                                        {{ $service->category->label_category ?? '' }}
                                </span>
                            </td>
                            <td class="">{{ $service->created_at ?? '' }}</td>
                            <td class="text-center">
                                <a class="badge bg-light-secondary" href="{{ route('services.edit', $service->id) }}">
                                    Edit
                                </a>

                                <a role="button" class="badge bg-light-danger" data-bs-toggle="modal"
                                   data-bs-target="#modal{{ $service->id }}">
                                    Delete
                                </a>

                                <div class="modal fade" id="modal{{ $service->id }}" tabindex="-1"
                                     aria-labelledby="deleteservice" aria-hidden="true" style="display: none;"
                                     role="dialog">
                                    <div class="modal-dialog modal-dialog modal-dialog modal-dialog-scrollable"
                                         role="document">
                                        <div class="modal-content">

                                            <form action="{{ route('services.destroy', $service->id) }}" method="POST">
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
                                                    $service->label_service }}</span>. Cliquez sur "Confirmer" pour
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
        let tdservices = document.querySelector('#tdservices');
        let dataTable = new simpleDatatables.DataTable(tdservices);
    </script>
@endsection
