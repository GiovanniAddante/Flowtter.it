<x-layout>
    <header class="min-vh-100 pt-5">
        @if (count($advertisements))
            <div class="container-fluid pb-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center title-index-pages p-5">{{ __('ui.allAdvertisements') }}</h1>
                        @if (!empty($searched))
                            <h2 class="text-center no-adv-title">{{ __('ui.searchResults') }} "{{$searched}}" </h2>                            
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="container-fluid">
                <div class="row">
                    <h3 class="title-index-pages text-center fs-1 p-5">{{ __('ui.noAdvertisements') }}</h3>

                </div>
            </div>
        @endif
        <div class="container">
            <div class="row justify-content-center p-3">
                @forelse ($advertisements as $advertisement)
                    <div class="col-12 col-md-4 mb-3">
                        <a href="{{ route('advertisement.show-detail', $advertisement) }}" class="text-decoration-none">
                            <div class="card">
                                <img src="{{ !$advertisement->images()->get()->isEmpty() ? $advertisement->images()->first()->getUrl(400, 300) : 'https://picsum.photos/346' }} "
                                    alt="foto" class="img-card-custom img-fluid">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $advertisement->title }}</h5>
                                    <p class="card-text">{{ $advertisement->price }} &euro; </p>
                                    <p class="card-text">{{ Str::limit($advertisement->description, 80) }}</p>

                                    <div class="d-flex justify-content-end w-100 mt-3">
                                        <a href="{{ route('categoryShow', $advertisement->category) }}"
                                            class="btn btn-custom ">{{ __('ui.Category') }}
                                            {{ __('ui.' . $advertisement->category->name) }}</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 col-md-6 mt-3">
                        <div class="alert-custom  py-3 shadow">
                            <h3 class="no-adv-title text-center p-3">{{ __('ui.noAdvertisementSearch') }} <img
                                    src="/media/sad-face_icon.png" alt="" class="sad-icon"></h3>
                            <h3 class="publish-adv-title text-center">{{ __('ui.publishAdvertisement') }} <a
                                    href="{{ route('advertisement.create') }}"
                                    class=" text-decoration-none text-reset"> <img src="/media/adv_icon.png"
                                        class="adv-icon" alt=""></a></h3>

                        </div>
                    </div>
                @endforelse
                <div class="col-12 mt-5 mb-5">
                    {{ $advertisements->links() }}
                </div>
            </div>
        </div>
    </header>
</x-layout>
