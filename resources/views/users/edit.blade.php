@extends('layouts.admin')

@section('page_title_header')
    <h3>Modifier les données d'un utilisateur</h3>
@endsection

@section('content')

    <section id="edit-user">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="POST" action="{{ route("users.update", [$user->id]) }}"
                                      enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label class="required" for="name">Nom</label>
                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                               type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
                                        @if($errors->has('name'))
                                            <div id="validationServer04Feedback"
                                                 class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="role">Rôle</label>

                                        <div class="form-group">
                                            <select class="choices form-select multiple-remove {{ $errors->has('roles') ? 'is-invalid' : '' }}"
                                                    name="roles[]" id="roles" multiple>
                                                @foreach($roles as $id => $roles)
                                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if($errors->has('roles'))
                                            <div id="validationServer04Feedback"
                                                 class="invalid-feedback">{{ $errors->first('roles') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group mt-4">
                                        <button class="btn btn-success" type="submit">
                                            Enregistrer
                                        </button>
                                        <a class="btn btn-primary" href="{{ route('users.index') }}">Retour à la
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
