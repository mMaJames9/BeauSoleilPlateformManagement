@extends('layouts.admin')

@section('page_title_header')
    <h3>Modifier les données d'un service</h3>
@endsection

@section('content')

    <section id="edit-service">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="POST" action="{{ route("services.update", [$service->id]) }}"
                                      enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-group">
                                        <select class="choices form-select {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                                            @foreach($categories as $id => $category)
                                                <option value="{{ $id }}" {{ ($service->category ? $service->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('category'))
                                            <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('category') }}</div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label class="required" for="label_service">Nom Service</label>
                                                <input class="form-control {{ $errors->has('label_service') ? 'is-invalid' : '' }}" type="text" name="label_service" id="label_service" value="{{ old('label_service', $service->label_service) }}">
                                                @if($errors->has('label_service'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('label_service') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="required" for="price_service">Prix Service</label>
                                                <input class="form-control {{ $errors->has('price_service') ? 'is-invalid' : '' }}" type="number" name="price_service" id="price_service" value="{{ old('price_service', $service->price_service) }}">
                                                @if($errors->has('price_service'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('price_service') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <button class="btn btn-success" type="submit">
                                            Enregistrer
                                        </button>
                                        <a class="btn btn-warning" href="{{ route('services.index') }}">Retour à la liste</a>
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
