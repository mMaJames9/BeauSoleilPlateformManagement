<div>

    <div class="row">
        <div class="d-flex justify-content-start mb-4">
            <button class="btn mt-4 btn-sm btn-info my-1"
            type="button" wire:click.prevent="addService()">Ajouter</button>
        </div>
    </div>

    @foreach ($createfactures as $index => $createfacture)

        <div class="row mb-4">
            <div class="col-4">
                <div class="form-group">
                    <label class="required" for="service_id">Selectionner les
                        services</label>

                        <select class="serviceName form-select"
                        style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                        name="createfactures[{{$index}}][service_id]" wire:model="createfactures.{{$index}}.service_id"
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
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label class="required" for="price_service">Prix Unitaire (en CFA)</label>
                    <input class="servicePrice form-control-plaintext h5"
                    {{-- wire:model="createfactures.{{$index}}.price_service" --}}
                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                    type="number"
                    id="price_service"
                    name="createfactures[{{$index}}][price_service]"
                    autocomplete="off"
                    placeholder="0"
                    readonly>

                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <label class="required" for="quantity">Quantité</label>
                    <input class="form-control"
                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                    type="number"
                    min="1"
                    id="quantity"
                    name="createfactures[{{$index}}][quantity]"
                    autocomplete="off"
                    wire:model="createfactures.{{$index}}.quantity">

                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label class="required" for="montantCalcule">Montant (en CFA)</label>
                    <input class="form-control-plaintext h5"
                    style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                    type="text"
                    id="montantCalcule"
                    name="createfactures[{{$index}}][montantCalcule]"
                    autocomplete="off"
                    placeholder="0"
                    readonly>

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
    </div>



