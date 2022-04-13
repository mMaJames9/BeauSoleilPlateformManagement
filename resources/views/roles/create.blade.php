@extends('layouts.admin')

@section('page_title_header')
    <h3>Création d'un nouveau Rôle</h3>
@endsection

@section('content')
    <section id="create-role">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="POST" action="{{ route("roles.store") }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label class="required" for="label_role">Titre</label>
                                        <input class="form-control {{ $errors->has('label_role') ? 'is-invalid' : '' }}"
                                               type="text" name="label_role" id="label_role"
                                               value="{{ old('label_role', '') }}">
                                        @if($errors->has('label_role'))
                                            <div id="validationServer04Feedback"
                                                 class="invalid-feedback">{{ $errors->first('label_role') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="permissions">Choisir les permissions</label>
                                        <div class="form-group">
                                            <select class="choices form-select multiple-remove {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple >
                                                @foreach($permissions as $id => $permissions)
                                                    <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>{{ $permissions }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if($errors->has('permissions'))
                                        <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('permissions') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group mt-4">
                                        <button class="btn btn-success" type="submit">
                                            Enregistrer
                                        </button>
                                        <a class="btn btn-warning" href="{{ route('roles.index') }}">Retour à la
                                            liste</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
