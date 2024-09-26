<div class="container-fluid pt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 text-center pt-3">
            <h2 class="title-index-pages p-5">{{ __('ui.publishAdvertisement') }}</h2>
        </div>
        <div class="col-12 col-md-5 p-3">
            <form wire:submit="store" enctype="multipart/form-data" class="form-custom shadow p-5">
                @if (session('message'))
                    <div class="alert alert-success text-center">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- TITOLO -->
                <div data-mdb-input-init class="form-outline mb-3">
                    <label class="form-label card-text-custom fs-4"
                        for="title">{{ __('ui.titleAdvertisement') }}</label>
                    <input type="text" id="title" class="form-control " wire:model.blur="title" />
                    @error('title')
                        <span class="error-message">{{ $message }}</span> 
                        @enderror
                    </div>
                    <!-- DESCRIZIONE -->
                    <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label card-text-custom fs-4"
                        for="description">{{ __('ui.descriptionAdvertisement') }}</label>
                        <textarea class="form-control " id="description" rows="4" wire:model.blur="description"></textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- PREZZO -->
                    <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label card-text-custom fs-4"
                        for="price">{{ __('ui.priceAdvertisement') }}</label>
                        <input type="number" id="price" class="form-control " wire:model.blur="price" />
                    @error('price')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- CATEGORIA -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <select wire:model.defer="category" id="category" class="form-control card-text-custom fs-5 mt-5">
                            <option value="">{{ __('ui.chooseCategory') }}</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ __('ui.' . $category->name) }}
                            </option>
                            @endforeach
                    </select>
                </div>
                
                <!-- IMMAGINE -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label card-text-custom fs-4"
                    for="temporary_images">{{ __('ui.imageAdvertisement') }}</label>
                    <input type="file" id="temporary_images" multiple
                    class="form-control @error('temporary_images.*') is-invalid @enderror"
                    wire:model="temporary_images" placeholder="Inserisci le immagini qui" />
                    @error('temporary_images')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                @if (!empty($images))
                    <div class="row">
                        <div class="col-12">
                            <p>{{ __('ui.imgPreviewAdvertisement') }}</p>
                            <div class="row border border-4 border-info shadow rounded py-4">
                                @foreach ($images as $key => $image)
                                    <div class="col my-3 ">
                                        <div class="img-preview mx-auto shadow rounded"
                                            style="height: 20vh; width: 15vh; background-image: url({{ $image->temporaryUrl() }}); background-position:center; background-size: cover;">
                                        </div>
                                        <button class="btn btn-danger shadow d-block text-center mt-2 mx-auto"
                                        wire:click.prevent="removeImage({{ $key }})">{{ __('ui.deletePreviewAdvertisement') }}</button>
                                    </div>
                                    @endforeach

                            </div>
                        </div>
                    </div>
                @endif

                <!-- Submit button -->
                <div class=" d-flex justify-content-end mt-3">
                    <button type="submit"
                        class="btn btn-custom fs-5 btn-block mt-4">{{ __('ui.addButtonAdvertisement') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

