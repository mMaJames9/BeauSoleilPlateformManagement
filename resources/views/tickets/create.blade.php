@extends('layouts.admin')

@section('page_title_header')
    <h3>Facture</h3>
@endsection

@section('content')
    <section id="create-ticket">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-5">

                    <form method="POST" action="{{ route("tickets.store") }}" enctype="multipart/form-data">
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
                                                    <input class="form-control "
                                                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                    type="text" name="name_client"
                                                    autocomplete="off" placeholder="Nom du Client" required>

                                                    @if($errors->has('name'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback"></div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col">
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="required" for="updated_at">Date Facture</label>
                                                    <input class="form-control-plaintext h5"
                                                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                    type="text" name="updated_at" value="{{$date}}" readonly
                                                    autocomplete="off">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row d-flex justify-content-start mb-4">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label class="required" for="phone_number">No. Tel</label>
                                                    <input class="form-control" maxlength="10"
                                                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                    type="number" min="650000000" max="699999999" name="phone_number" list="phone_number"
                                                    autocomplete="off" placeholder="6XX-XXX-XXX">
                                                    @if($errors->has('phone_number'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback"></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    @livewire('services')

                                    <div class="row mt-5">
                                        <div class="col d-flex justify-content-end">

                                            <div class="form-group text-right">
                                                <label class="required" for="total_price">Montal Total</label>
                                                <input class="form-control "
                                                style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                type="text" name="total_price" autocomplete="off" id="total_price"
                                                value="" disabled>

                                                @if($errors->has('total_price'))
                                                <div id="validationServer04Feedback" class="invalid-feedback"></div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>


                                    <div class="form-group mt-4">
                                        <button class="btn btn-success" type="submit">
                                            Enregistrer
                                        </button>
                                        <a class="btn btn-primary" href="{{ route('tickets.index') }}">Retour à la liste</a>
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

@endsection
