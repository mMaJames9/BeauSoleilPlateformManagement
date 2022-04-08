<div>
    <div class="row">
        <div class="d-flex justify-content-start mb-4">
            <button class="btn mt-4 btn-sm btn-info my-1"
            type="button" wire:click.prevent="addService()">Ajouter</button>
        </div>
    </div>
    {{-- @php $total = 0; @endphp --}}
    @foreach ($servicePrices as $index => $servicePrice)
    <div class="row mb-4">
        <div class="col-4" style="margin-right: 4rem">
            <div class="form-group">
                <label class="required" for="services">Selectionner les
                    services</label>

                    <select class="serviceName form-select {{ $errors->has('services') ? 'is-invalid' : '' }}"
                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                    name="services[]" wire:model="serviceNames.{{ $index }}"
                    id="services">

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

                @if($errors->has('services'))
                <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('services') }}</div>
                @endif
            </div>
        </div>

        <div class="col-2">
            <div class="form-group">
                <label class="required" for="price_service">Prix Unitaire (en CFA)</label>
                <input class="form-control-plaintext h5 {{ $errors->has('price_service') ? 'is-invalid' : '' }}" style="padding-top: .70rem!important; padding-bottom: .70rem!important;" type="number" id="price_service" autocomplete="off" placeholder="0" name="total_price" readonly wire:model="servicePrices.{{ $index }}">

                @if($errors->has('price_service'))
                <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('price_service') }}</div>
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

    {{-- @php $total += $servicePrice; @endphp --}}
    @endforeach

    <div class="row" style="margin-top: 5rem;">
        <div class="col d-flex justify-content-start">

            <div class="form-group text-right">
                <label class="mb-0 equired h5" for="total_price">Montal Total (en CFA)</label>
                <input class="totalPrice form-control-plaintext h1 {{ $errors->has('total_price') ? 'is-invalid' : '' }}" type="text" name="total_price" autocomplete="off" readonly id="total_price" wire:model="totalPrice">

                @if($errors->has('total_price'))
                    <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('total_price') }}</div>
                    @endif
            </div>

        </div>
        <div class="col-7">

        </div>
    </div>

</div>



