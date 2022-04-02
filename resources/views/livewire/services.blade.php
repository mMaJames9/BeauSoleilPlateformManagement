<div>

    <div class="row">
        <div class="d-flex justify-content-start mb-4">
            <button class="btn mt-4 btn-sm btn-info my-1"
                    type="button"
                    wire:click.prevent="addService()">Ajouter
            </button>
        </div>
    </div>

    <div>
        @foreach ($createTickets as $index => $createTicket)

            <div class="row mb-4">
                <div class="col-6">
                    <div class="form-group">
                        <label class="required" for="service_id">Selectionner les
                            services</label>

                        <select class="serviceClass form-select"
                                style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                                name="createTickets[{{$index}}][service_id]"
                                wire:model="createTickets.{{$index}}.service_id"
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
                <div class="col-3">
                    <div class="form-group">
                        <label class="required" for="price_service">Prix</label>
                        <input class="servicePrice form-control"
                               style="padding-top: .70rem!important; padding-bottom: .70rem!important;"
                               type="text"
                               id="price_service"
                               name="createTickets[{{$index}}][price_service]"
                               autocomplete="off"
                               placeholder="en FCFA"
                               value="1000"
                               disabled
                               wire:model="createTickets.{{$index}}.price_service">

                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="d-flex justify-content-center mt-4">
                            <div class="form-group">
                                <button class="btn mt-1 pt-2 btn-sm btn-danger my-1"
                                        type="button"
                                        wire:click.prevent="removeService({{$index}})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
