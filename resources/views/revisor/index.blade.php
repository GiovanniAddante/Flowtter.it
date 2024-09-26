<x-layout>
    <div class="min-vh-100 pt-5">
        <div class="container-fluid pt-5">
            <div class="row">
                <div class="col-12 text-center p-5 mb-3">
                    <h1 class="title-index-pages">
                        {{ $advertisement_to_check ? __('ui.reviewAdvertisement') : __('ui.noReviewAdvertisement') }}
                    </h1>
                </div>
            </div>
        </div>
        @if ($advertisement_to_check)
            <div class="container mb-5">
                <div class="row">
                    {{-- LABELS/TAG --}}
                    <div class="col-12 col-md-3 border-end d-flex flex-column">
                        <div>
                            <h4 class="tc-accent card-text-custom text-end pb-3 px-5">Tags</h4>
                        </div>
                        <div class="px-5">
                            @if (count($advertisement_to_check->images))                                
                                @if ($advertisement_to_check->images->first->get()->labels)
                                    @foreach ($advertisement_to_check->images->first->get()->labels as $label)
                                        <p class="text-end">{{ $label }}</p>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>
                    {{-- CAROUSEL --}}
                    <div class="col-12 col-md-6 border-end">
                        <div id="carouselExampleIndicators" class="carousel slide mb-5">
                            @if ($advertisement_to_check->images)
                                <div class="carousel-inner">
                                    @foreach ($advertisement_to_check->images as $image)
                                        <div
                                            class="carousel-item @if ($loop->first) active @endif text-center">
                                            <img src="{{ $image->getUrl(400, 300) }}" class="img-preview img-revisor" alt="immagine">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="carousel-inner">
                                    <div class="carousel-item">
                                        <img src="https://picsum.photos/500" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://picsum.photos/501" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://picsum.photos/502" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                            @endif
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <i class="fa-solid fa-chevron-left fs-1"></i>
                                <span class="visually-hidden">{{ __('ui.prevPageButton') }}</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <i class="fa-solid fa-chevron-right fs-1"></i>
                                <span class="visually-hidden">{{ __('ui.nextPageButton') }}</span>
                            </button>
                        </div>
                        <h5 class="card-text-custom pb-3 fw-bold text-center">{{ __('ui.titleAdvertisement') }}
                            {{ $advertisement_to_check->title }}</h5>
                        <p class="card-text fs-5 text-center">{{ __('ui.descriptionAdvertisement') }}<br>
                            {{ $advertisement_to_check->description }}</p>
                        <p class="card-text-custom fs-5 text-center">{{ __('ui.dateAdvertisement') }} il
                            {{ $advertisement_to_check->created_at }}</p>
                    </div>
                    {{-- SAFE SEARCH --}}
                    <div class="col-12 col-md-3">
                        <div class="card-body">
                            @if (count($advertisement_to_check->images))   
                                <h4 class="tc-accent card-text-custom pb-3 mx-5">{{ __('ui.imagesReview') }}</h4>
                                <p class="px-5">{{ __('ui.adultContent') }} : <span
                                        class="{{ $advertisement_to_check->images->first->get()->adult }}"></span>
                                </p>
                                <p class="px-5">{{ __('ui.spoofContent') }} : <span
                                        class="{{ $advertisement_to_check->images->first->get()->spoof }}"></span>
                                </p>
                                <p class="px-5">{{ __('ui.medicalContent') }} : <span
                                        class="{{ $advertisement_to_check->images->first->get()->medical }}"></span></p>
                                <p class="px-5">{{ __('ui.violenceContent') }} : <span
                                        class="{{ $advertisement_to_check->images->first->get()->violence }}"></span></p>
                                <p class="px-5">{{ __('ui.racyContent') }} : <span
                                        class="{{ $advertisement_to_check->images->first->get()->racy }}"></span></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- BUTTONS --}}
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex justify-content-end p-5">
                            <form action="{{ route('revisor.accept', ['advertisement' => $advertisement_to_check]) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="btn btn-accept fs-4 mb-2">{{ __('ui.acceptAdvertisement') }}</button>
                            </form>
                        </div>
                        <div class="col-12 col-md-6 d-flex justify-content-start p-5">
                            <form action="{{ route('revisor.reject', ['advertisement' => $advertisement_to_check]) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="btn btn-reject fs-4">{{ __('ui.rejectAdvertisement') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout>
