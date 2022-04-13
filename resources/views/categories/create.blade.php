@extends('layouts.admin')

@section('page_title_header')
    <h3>Création d'une nouvelle Catégorie</h3>
@endsection

@section('content')

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


    <section id="create-category">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="POST" action="{{ route("categories.store") }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label class="required" for="label_category">Nom Catégorie</label>
                                                <input class="form-control {{ $errors->has('label_category') ?
                                                'is-invalid' : '' }}" type="text" name="label_category" id="label_category" value="{{ old('label_category', '') }}" >

                                                @if($errors->has('label_category'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('label_category') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <button class="btn btn-success" type="submit">
                                            Enregistrer
                                        </button>
                                        <a class="btn btn-warning" href="{{ route('categories.index') }}">Retour à la liste</a>
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
