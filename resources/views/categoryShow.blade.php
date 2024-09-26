<x-layout>
    <header class=" pt-5">
        @if ($category)
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center title-index-pages">{{ __('ui.Category') }} {{ $category->name }}</h1>
                    </div>
                </div>
            </div>
        @else
            <div class="container-fluid">
                <div class="row">
                    <h3 class="text-center">{{ __('ui.noAdvertisements') }}</h3>
                    <div class="text-center w-100">
                        <a role="button" class="btn btn-custom"
                            href="{{ route('advertisement.create') }}">{{ __('ui.publishAdvertisements') }}</a>
                    </div>
                </div>
            </div>
        @endif
    </header>
    <div class="container min-vh-100 pt-5 mb-5 pb-5">
        <div class="row justify-content-center">
            @forelse ($category->advertisements as $advertisement)
                <div class="col-12 col-md-4 mb-3">
                    <a href="{{ route('advertisement.show-detail', $advertisement) }}" class="text-decoration-none">
                        <div class="card">
                            @if (!$advertisement->images()->get()->isEmpty())
                                <img src="{{ $advertisement->images()->first()->getUrl(400, 300) }}"
                                    alt="{{ $advertisement->title }}" class="img-card-custom">
                            @else
                                <img src="https://picsum.photos/400/300" alt="foto" class="img-card-custom">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $advertisement->title }}</h5>
                                <p class="card-text">{{ __('ui.adPrice') }} {{ $advertisement->price }} &euro; </p>
                                <p class="card-text">{{ Str::limit($advertisement->description, 30) }}</p>
                            </div>
                            <div class="card-footer footer-title-custom">
                                <p>{{ $advertisement->category->name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 col-md-6 p-5 text-center">
                    <h3 class="no-adv-title pb-5">{{ __('ui.noAdvertisement') }} <img src="/media/sad-face_icon.png"
                            alt="" class="sad-icon"></h3>
                    <h3 class="publish-adv-title">{{ __('ui.publishAdvertisement') }} <a
                            href="{{ route('advertisement.create') }}" class=" text-decoration-none text-reset"> <img
                                src="/media/adv_icon.png" class="adv-icon" alt=""></a></h3>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
