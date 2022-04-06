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
                            <input type="text" readonly class="mb-3 form-control-plaintext h4" name="num_ticket"
                            value="{{$random}}">
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
                                                        <option value={{ $client->name_client ?? '' }}>
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
                                                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                    type="text" name="updated_at" value="{{$date}}" readonly
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

                                    @livewire('services')

                                    <div class="row" style="margin-top: 10rem;">
                                        <div class="col-7">

                                        </div>
                                        <div class="col d-flex justify-content-end">

                                            <div class="form-group text-right">
                                                <label class=" mb-0 equired h5" for="total_price">Montal Total (en CFA)</label>
                                                <input class="form-control-plaintext h1 {{ $errors->has('total_price') ? 'is-invalid' : '' }}"
                                                type="text" name="total_price" autocomplete="off" readonly id="total_price"
                                                value="1000" disabled>

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

    <script>
        $(document).ready(function () {
            $(document).on('change', '.serviceName', function () {
                var service_id = $(this).val();

                var a = $(this).parent().parent().parent();
                console.log(service_id);
                var op = "";

                $.ajax({
                    type: 'get',
                    url: '{!!URL::to('findPriceService')!!}',
                    data: {'id': service_id},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.price_service);

                        a.find('.servicePrice').val(data.price_service);
                    },
                    error: function () {

                    }
                });
            })
        })
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('change', '.quantity', function () {
                var montantCalcule = $(this).val();

                var a = $(this).parent();
                console.log(montantCalcule);
                var op = "";

                $.ajax({
                    type: 'get',
                    url: '{!!URL::to('findPriceService')!!}',
                    data: {'id': service_id},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.price_service);

                        a.find('.servicePrice').val(data.price_service);
                    },
                    error: function () {

                    }
                });
            })
        })
    </script>

@endsection
