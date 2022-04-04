@extends('layouts.admin')

@section('page_title_header')
    <h3>Facture</h3>
@endsection

@section('content')
    <section id="create-ticket">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-5">
                    <div class="card-header mb-4">
                        <span>Facture No.</span>
                        <input type="text" readonly class="mb-3 form-control-plaintext h4" name="num_ticket"
                               value="{{$random}}">
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <form method="POST" action="{{ route("tickets.store") }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-2">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label class="required" for="name_client">Nom Client</label>
                                                <input class="form-control "
                                                       style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                       type="text" name="name"
                                                       autocomplete="off" placeholder="Nom du Client">

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
                                                <input class="form-control "
                                                       style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                       type="text" name="updated_at" value="{{$date}}" disabled
                                                       autocomplete="off">
                                                @if($errors->has('updated_at'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row d-flex justify-content-start mb-4">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label class="required" for="phone_number">No. Tel</label>
                                                <input class="form-control" maxlength="10"
                                                       style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                                       type="number" name="phone_number" list="phone_number"
                                                       autocomplete="off" placeholder="6XX-XXX-XXX">
                                                @if($errors->has('phone_number'))
                                                    <div id="validationServer04Feedback" class="invalid-feedback"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                     @livewire('services')

                                    <div class="form-group">
                                        <label class="required" for="total_amount">Montal Total</label>
                                        <input class="form-control "
                                               style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                               type="text" name="total_amount" autocomplete="off" id="total_amount"
                                               value="" disabled>

                                        @if($errors->has('total_amount'))
                                            <div id="validationServer04Feedback" class="invalid-feedback"></div>
                                        @endif
                                    </div>

                                    <div class="form-group mt-4">
                                        <button class="btn btn-success" type="submit">
                                            Enregistrer
                                        </button>
                                        <a class="btn btn-primary" href="{{ route('PrintData') }}"> Print </a>
                                        <a class="btn btn-primary" href="{{ route('tickets.index') }}"> Retour à la
                                            liste </a>
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

@section('scripts')
    @parent

    @yield('scripts')

    <script>
        $(document).ready(function () {
            $(document).on('change', '.serviceClass', function () {
                // console.log('changing hahah');

                var service_id = $(this).val();
                console.log(service_id);
                var op = "";

                $.ajax({
                    type: 'get',
                    url: '{!!URL::to('findPriceService')!!}',
                    data: {'id': service_id},
                    dataType: 'json',
                    success: function (data) {
                        // console.log("price_service");
                        console.log(data.price_service);

                        a.find('.servicePrice').val('data.price_service');
                    },
                    error: function () {

                    }
                });
            })
        })
    </script>

@endsection
