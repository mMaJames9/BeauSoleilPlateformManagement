@extends('layouts.admin')

@section('page_title_header')
    <h3>Liste des rôles</h3>
@endsection

@section('content')

    @can('role_create','role_edit','role_delete')
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
            <a class="btn btn-secondary" href="{{ route("roles.create") }}">
                Ajouter un nouveau rôle
            </a>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table class="table table-responsive table-lg" class="display" id="tdroles">
                    <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th class="text-center">Titre</th>
                        <th class="text-center" width="60%">Permissions</th>
                        <th class="text-center">Créée le</th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($roles as $role)
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td class="">
                                <span class="badge bg-light-primary my-1">
                                {{ $role->label_role ?? '' }}
                                </span>
                            </td>
                            <td class="">
                                @foreach($role->permissions as $key => $item)
                                    <span class="badge bg-light-warning my-1">{{ $item->label_permission }}</span>
                                @endforeach
                            </td>
                            <td class="">{{ $role->created_at ?? '' }}</td>
                            <td class="text-center">
                                <a class="badge bg-light-secondary" href="{{ route('roles.edit', $role->id) }}">
                                    Edit
                                </a>

                                <a role="button" class="badge bg-light-danger" data-bs-toggle="modal"
                                   data-bs-target="#modal{{ $role->id }}">
                                    Delete
                                </a>

                                <div class="modal fade" id="modal{{ $role->id }}" tabindex="-1"
                                     aria-labelledby="deleterole" aria-hidden="true" style="display: none;"
                                     role="dialog">
                                    <div class="modal-dialog modal-dialog modal-dialog modal-dialog-scrollable"
                                         role="document">
                                        <div class="modal-content">

                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleterole">Confimer la suppression</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-left">
                                                    <p>Vous êtes sur le point de supprimer <span class="fw-bold">{{
                                                    $role->label_role }}</span>. Cliquez sur "Confirmer" pour valider ou
                                                        sur "Fermer" pour annuler... </p>
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
        let tdroles = document.querySelector('#tdroles');
        let dataTable = new simpleDatatables.DataTable(tdroles);
    </script>
@endsection
