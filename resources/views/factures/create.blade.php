@extends('layouts.admin')

@section('page_title_header')
    <h3>Factures</h3>
@endsection

@section('content')
    <section id="create-facture">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-5">

                    <form method="POST" action="{{ route("factures.store") }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header mb-4">
                            <label class="required" for="num_ticket">Facture No.</label>
                            <input type="text" name="num_ticket" class="form-control-plaintext h2 mb-3 {{ $errors->has('num_ticket') ? 'is-invalid' : '' }}" readonly value="{{$random}}">

                            @if($errors->has('name_client'))
                            <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('num_ticket') }}</div>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">

                                        <div class="row mb-2">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label class="required" for="name_client">Nom Client</label>
                                                    <input class="form-control {{ $errors->has('name_client') ? 'is-invalid' : '' }}"
                                                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                    type="text" name="name_client"
                                                    autocomplete="off" placeholder="Nom du Client" list="name_client" required>
                                                    <datalist id="name_client">
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->name_client ?? '' }}">
                                                    @endforeach
                                                    </datalist>

                                                    @if($errors->has('name_client'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('name_client') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col">
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="required" for="updated_at">Date Facture</label>
                                                    <input class="form-control-plaintext h5 {{ $errors->has('updated_at') ? 'is-invalid' : '' }}"
                                                    readonly style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                    type="text" name="updated_at" value="{{$date}}"
                                                    autocomplete="off">

                                                    @if($errors->has('updated_at'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('updated_at') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-start mb-4">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label class="required" for="phone_number">No. Tel</label>
                                                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" maxlength="9"
                                                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                    type="number" min="620000000" max="699999999" maxlength="9" name="phone_number" list="phone_number"
                                                    autocomplete="off" placeholder="6XXXXXXXX">

                                                    @if($errors->has('phone_number'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" mb-4">
                                            <div class="form-group">
                                                <label class="required" for="service_id">Selectionner les
                                                    services</label>

                                                    <select class="choices form-select-lg multiple-remove " multiple="multiple {{ $errors->has('service_id') ? 'is-invalid' : '' }}"
                                                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                    name="service_id[]" id="service_id">

                                                    <option value="0" selected>-- Choisir un service --</option>
                                                    @foreach($categories as $category)
                                                    <optgroup label="{{ $category->label_category }}">
                                                        @foreach($services as $service)
                                                        @if($service->category_id == $category->id)
                                                        <option value="{{$service->id}}">{{ $service->label_service }} : {{ $service->price_service }} FCFA</option>
                                                        @endif
                                                        @endforeach
                                                    </optgroup>
                                                    @endforeach
                                                </select>

                                                @if($errors->has('service_id'))
                                                <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('service_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row" style="margin-top: 6rem;">
                                            <div class="col-7">

                                            </div>
                                            <div class="col d-flex justify-content-end">

                                                <div class="form-group text-right">
                                                    <label class="mb-0 equired h6" for="total_price">Montal Total (en CFA)</label>
                                                    <input class="totalPrice form-control-plaintext h1 {{ $errors->has('total_price') ? 'is-invalid' : '' }}"
                                                    type="text" name="total_price" autocomplete="off" readonly id="total_price">

                                                    @if($errors->has('total_price'))
                                                        <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('total_price') }}</div>
                                                        @endif
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group mt-4">
                                            <button class="btn btn-success" type="submit" href="{{ route('PrintData') }}">
                                                Enregistrer
                                            </button>
                                            <a class="btn btn-primary" href="{{ route('factures.index') }}">Retour à la liste</a>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('scripts')
    @parent

@endsection
