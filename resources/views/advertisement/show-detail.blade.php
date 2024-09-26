<x-layout>
    <header class="container pt-5">
        <div class="row">
            <div class="col-12 p-5">
                <h1 class="title-index-pages text-center p-3">{{ __('ui.advDetail') }} {{ $advertisement->title }}</h1>
            </div>
        </div>
    </header>
    <main class="container min-vh-100 pb-5">
        <div class="row">
            <div class="col-12 col-md-6">
                {{-- carosello --}}
                <div id="carouselExample" class="carousel slide">
                    @if (!$advertisement->images()->get()->isEmpty())
                        <div class="carousel-inner">
                            @foreach ($advertisement->images as $image)
                                <div class="carousel-item @if ($loop->first) active @endif text-center">
                                    {{-- <img src="{{ Storage::url($image->path) }}" class="img-fluid" alt="immagine"> --}}
                                    <img src="{{ $image->getUrl(400, 300) }}" class="img-fluid" alt="immagine">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://picsum.photos/400" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/401" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/402" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    @endif
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <i class="fa-solid fa-chevron-left fs-1"></i>
                        <span class="visually-hidden">{{ __('ui.prevPageButton') }}</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <i class="fa-solid fa-chevron-right fs-1"></i>
                        <span class="visually-hidden">{{ __('ui.nextPageButton') }}</span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-6 pt-5 d-flex align-items-center">
                {{-- dettagli --}}
                <div class="container ">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="d-flex flex-column justify-content-center">
                                <h5 class="card-title fs-4 fw-bold">{{ $advertisement->title }}</h5>
                                <p class="card-text fs-5 fw-bold pt-2">{{ __('ui.priceAdvertisement') }}:
                                    {{ $advertisement->price }} &euro; </p>
                                <p class="card-text fs-5">{{ $advertisement->description }}</p>
                                {{-- EDIT / DELETE BUTTON --}}
                                @auth
                                    @if (Auth::user()->id == $advertisement->user->id)
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <a role="button" href="{{ route('advertisement.edit', $advertisement) }}"
                                                    class="btn btn-custom-modify">{{ __('ui.editButtonAdvertisement') }}</a>
                                            </div>
                                            <form action="{{ route('advertisement.delete', compact('advertisement')) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="btn btn-reject">{{ __('ui.deleteButtonAdvertisement') }}</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                <p class="mt-5">{{ __('ui.cardPublished') }}
                                    {{ $advertisement->created_at->diffForHumans() }} <br>
                                    <span>{{ __('ui.by') }} {{ $advertisement->user->name ?? '' }}</span>
                                </p>
                                <div class="w-100 text-end">
                                    <a href="{{ route('categoryShow', $advertisement->category) }}"
                                        class="btn btn-custom">{{ $advertisement->category->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
