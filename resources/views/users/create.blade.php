@extends('layouts.admin')

@section('page_title_header')
    <h3>Création d'un nouvel utilisateur</h3>
@endsection

@section('content')
    <section id="create-user">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="POST" action="{{ route("users.store") }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="required" for="name">Name</label>
                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" >
                                        @if($errors->has('name'))
                                            <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="required" for="email">Email</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" >
                                        @if($errors->has('email'))
                                            <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="required" for="password">Password</label>
                                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" >
                                        @if($errors->has('password'))
                                            <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="password-confirm">Confirm Password</label>
                                        <input class="form-control" type="password" name="password_confirmation" id="password-confirm" >
                                    </div>

                                    <div class="form-group">
                                        <label class="required" for="roles">Rôles</label>
                                        <div class="form-group">
                                            <select class="choices form-select multiple-remove {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple >
                                                @foreach($roles as $id => $roles)
                                                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $roles }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if($errors->has('roles'))
                                            <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('roles') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group mt-4">
                                        <button class="btn btn-success" type="submit">
                                            Enregistrer
                                        </button>
                                        <a class="btn btn-primary" href="{{ route('users.index') }}">Retour à la liste</a>
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
