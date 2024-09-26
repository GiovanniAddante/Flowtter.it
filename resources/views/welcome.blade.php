<x-layout>
    <x-header class="min-vh-100">
        <div class="container header-text">
            <div class="row pt-5">
                <div class="col-12 p-5 d-flex justify-content-center align-items-center d-flex flex-column">
                    {{-- TITLE --}}
                    <h1 class="text-center p-5 display-1 fw-bolder">{{__('ui.welcomeOn')}} flowtter <span><img src="/media/water.png" class="my-logo" alt="" srcset=""></span></h1>
                    <div class="justify-content-center mb-5">
                        <a role="button" class="btn btn-custom fs-3" href="{{route('advertisement.create')}}">{{__('ui.addAdvertisement')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </x-header>
    {{-- WAVES --}}
    <div class="position-relative my-container-wave">
        <img src="/media/white_wave2.png" class="my-wave" srcset="">
        <img src="/media/white_wave2upside.png" class="my-wave-upside-top" srcset="">
    </div>
    {{-- I nostri annunci più recenti --}}
    <div class="py-5 text-center">
        <h3 class="fs-1 pt-5 latestAdv-title ">{{__('ui.latestAds')}}</h3>            
    </div>
    <div class="container">
        <div class="row">
            @forelse ($advertisements as $advertisement)
            <div class="col-12 col-md-4 mb-3">
                <a href="{{ route('advertisement.show-detail', $advertisement) }}" class="text-decoration-none">
                    <div class="card">
                        <img src="{{ !$advertisement->images()->get()->isEmpty() ? $advertisement->images()->first()->getUrl(400,300) : 'https://picsum.photos/346' }}" alt="foto" class="img-card-custom">
                        <div class="card-body">
                            <h5 class="card-title">{{ $advertisement->title }}</h5>
                            <p class="card-text">{{ $advertisement->price }} &euro; </p>
                            <p class="card-text">{{ Str::limit($advertisement->description, 80) }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center mt-3">
                            <div class="d-flex">
                                <p class="align-items-center">{{__('ui.cardPublished')}} {{ $advertisement->created_at->format('d-m-Y H:i') }}</p>
                            </div>
                            <div>
                                <a href="{{ route('categoryShow', $advertisement->category) }}" class="btn btn-custom">{{ __('ui.' . $advertisement->category->name) }}</a>
                            </div>
                        </div>                        
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 col-md-4 mb-3 w-100">
                <h1 class="text-center">{{__('ui.noAdvertisement')}}</h1>
            </div>
            @endforelse
        </div>
    </div>
    <div class="position-relative my-container-wave-upside">
        <img src="/media/white_wave2upside.png" class="my-wave-upside" srcset="">
    </div>
    <div class="my-surfers-cnt">
    </div>
</x-layout>
