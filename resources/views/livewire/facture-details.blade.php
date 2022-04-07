<div>
    <div class="row">
        <div class="d-flex justify-content-start mb-4">
            <button class="btn mt-4 btn-sm btn-info my-1"
            type="button" wire:click.prevent="addService()">Ajouter</button>
        </div>
    </div>

    @foreach ($factureDetails as $index => $factureDetail)
    <div class="row mb-4">
        <div class="col-4" style="margin-right: 4rem">
            <div class="form-group">
                <label class="required" for="service_id">Selectionner les
                    services</label>

                    <select class="serviceName form-select {{ $errors->has('service_id') ? 'is-invalid' : '' }}"
                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                    name="factureDetails[{{$index}}][service_id]" wire:model="factureDetails.{{$index}}.service_id"
                    id="service_id">

                    <option value="0" selected>-- Choisir un service --</option>
                    @foreach($categories as $category)
                    <optgroup label="{{ $category->label_category }}">
                        @foreach($services as $service)
                        @if($service->category_id == $category->id)
                        <option value="{{$service->id}}">{{ $service->label_service }}</option>
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

        <div class="col-2">
            <div class="form-group">
                <label class="required" for="price_service">Prix Unitaire (en CFA)</label>
                <input class="form-control-plaintext h5 {{ $errors->has('service_id') ? 'is-invalid' : '' }}" style="padding-top: .70rem!important; padding-bottom: .70rem!important;" type="number" id="price_service" name="factureDetails[{{$index}}][price_service]" autocomplete="off" placeholder="0" readonly>

                @if($errors->has('price_service'))
                <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('price_service') }}</div>
                @endif
            </div>
        </div>

        <div class="col-2" style="margin-right: 4rem">
            <div class="form-group">
                <label class="required" for="quantity">Quantité</label>
                <div class="input-group input-group-lg">
                    <input class="quantityService form-control  {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number"  min="1" id="quantity" name="factureDetails[{{$index}}][quantity]" wire:model="factureDetails.{{$index}}.quantity" aria-label="Entrer la quantité de services" aria-describedby="inputGroup-sizing-lg">
                </div>

                @if($errors->has('quantity'))
                <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                @endif
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label class="required" for="amountEachService">Montant (en CFA)</label>
                <input class="totalAmount form-control-plaintext h5 {{ $errors->has('amountEachService') ? 'is-invalid' : '' }}" wire:model="factureDetails.{{$index}}.amountEachService" style="padding-top: .70rem!important; padding-bottom: .70rem!important;" type="text" id="amountEachService" name="factureDetails[{{$index}}][amountEachService]" autocomplete="off" readonly>

                @if($errors->has('amountEachService'))
                <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('amountEachService') }}</div>
                @endif

            </div>
        </div>
        <div class="col-1">
            <div class="row">
                <div class="d-flex justify-content-center mt-4">
                    <div class="form-group">
                        <button class="btn mt-1 pt-2 btn-sm btn-danger my-1"
                        type="button" wire:click.prevent="removeService({{$index}})">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    <div class="row" style="margin-top: 10rem;">
        <div class="col-7">

        </div>
        <div class="col d-flex justify-content-end">

            <div class="form-group text-right">
                <label class="mb-0 equired h5" for="total_price">Montal Total (en CFA)</label>
                <input class="totalPrice form-control-plaintext h1 {{ $errors->has('total_price') ? 'is-invalid' : '' }}"
                type="text" name="total_price" autocomplete="off" readonly id="total_price">

                @if($errors->has('total_price'))
                    <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('total_price') }}</div>
                    @endif
            </div>

        </div>
    </div>

</div>



