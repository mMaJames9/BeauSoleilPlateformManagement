@extends('layouts.admin')

@section('page_title_header')
    <h3>Liste des Permissions</h3>
@endsection

@section('content')

    @can('permission_create','permission_edit','permission_delete')
        @if(session('status'))
            <script>
                window.addEventListener("load", function() {
                    Toastify({
                        text: "{{ session('status') }}",
                        duration: 5000,
                        close:true,
                        gravity:"top",
                        position: "center",
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
                        position: "center",
                        backgroundColor: "#dc3545",
                    }).showToast();
                });
            </script>
        @endif
    @endcan

    <div style="margin-bottom: 2rem;" class="row">
        <div class="col-lg-12">

        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table class="table table-responsive table-lg" class="display" id="tdpermissions">
                    <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th class="text-center">Titre</th>
                        <th class="text-center">Créée le</th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($permissions as $permission)
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td class="">
                                <span class="badge bg-light-primary
                                my-1">
                                {{ $permission->label_permission ?? '' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light-primary my-1">
                                    {{ $permission->created_at }}
                                </span>
                                </td>
                            <td class="text-center">

                                <a role="button" class="badge bg-light-danger" data-bs-toggle="modal"
                                   data-bs-target="#modal{{ $permission->id }}">
                                    Delete
                                </a>

                                <div class="modal fade" id="modal{{ $permission->id }}" tabindex="-1"
                                     aria-labelledby="deletepermission" aria-hidden="true" style="display: none;" role="dialog">
                                    <div class="modal-dialog modal-dialog modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">

                                            <form action="{{ route('permissions.destroy', $permission->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deletepermission">Confimer la suppression</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-left">
                                                    <p>Vous êtes sur le point de supprimer <span class="fw-bold">{{
                                                    $permission->label_permission }}</span>. Cliquez sur "Confirmer" pour valider ou sur "Fermer" pour annuler... </p>
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
        let tdpermissions = document.querySelector('#tdpermissions');
        let dataTable = new simpleDatatables.DataTable(tdpermissions);
    </script>
@endsection
