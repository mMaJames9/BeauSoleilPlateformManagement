<div>

    <div class=" mb-4">
        <div class="form-group">
            <label class="required" for="service_id">Selectionner les
                services</label>

                <select class="choices form-select multiple-remove " multiple="multiple {{ $errors->has('service_id') ? 'is-invalid' : '' }}"
                style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                name="service_id[]" id="service_id" wire:model="servicesName">

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
                <input class="form-control-plaintext h1 {{ $errors->has('total_price') ? 'is-invalid' : '' }}" style="padding-top: .70rem!important; padding-bottom: .70rem!important;" wire:model="totalPrices" type="number" id="total_price" name="total_price" autocomplete="off" readonly>

                @if($errors->has('total_price'))
                <div id="validationServer04Feedback" class="invalid-feedback">{{ $errors->first('total_price') }}</div>
                @endif
            </div>

        </div>
    </div>
</div>
