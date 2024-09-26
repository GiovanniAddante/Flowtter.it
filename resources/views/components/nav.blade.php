<nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0 nav-custom fs-5">
    <div class="container-fluid ">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-50">
                {{-- ADVERTISEMENT --}}
                <li class="nav-item">
                    <a class="nav-link nav-title"
                        href="{{ route('advertisement.index') }}">{{ __('ui.allAdvertisements') }} </a>
                </li>
                {{-- CATEGORY --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-title" href="#!" id="categoriesDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{ __('ui.allCategories') }}</a>
                    <ul class="dropdown-menu cat-custom-menu" aria-labelledby="categoriesDropdown">
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('categoryShow', compact('category')) }}"
                                    class="dropdown-item cat-title">{{ __("ui.$category->name") }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                {{-- ADD ADVERTISEMENT --}}
                @auth
                    <li class="nav-item">
                        <a role="button" class="nav-link nav-title"
                            href="{{ route('advertisement.create') }}">{{ __('ui.addAdvertisement') }}</a>
                    </li>
                @endauth
            </ul>
            {{-- LOGO --}}
            <div class="w-25 d-flex justify-content-center align-items-center">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <span class="nav-logo">
                        <img src="/media/flowtter_logo.png" class="my-logo-nav">
                    </span>
                </a>
            </div>
            <div class="collapse navbar-collapse w-50" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    {{-- SEARCH BAR --}}
                    <form action="{{ route('advertisements.search') }}" method="GET" class="d-flex dropdown">
                        <input type="search" name="searched" class="form-control input-search-custom me-2 rounded-5" placeholder="{{ __('ui.search') }}">
                        <button type="submit" class="btn loupe-btn me-2"><img src="/media/loupe.png" class="loupe-icon" alt=""></button>
                    </form>
                    {{-- USER MENU --}}
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-title" href="#!" id="profileDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ __('ui.welcome') }}
                                {{ Auth::user()->name }}
                                <img src="/media/surfboard_icon.png" class="profile-icon">
                                @if (App\Models\Advertisement::toBeRevisonedCount() && Auth::user()->is_revisor)
                                    <span
                                        class="position-absolute top-0 start-75 translate-middle-relative">{{ App\Models\Advertisement::toBeRevisonedCount() }}
                                        <span class="visually-hidden">{{ __('ui.allUnreadMessages') }}</span>
                                    </span>
                                @endif
                            </a>
                            <ul class=" dropdown-menu  profile-custom-menu" aria-labelledby="profileDropdown">
                                @if (Auth::user()->is_revisor)
                                    <li class="nav-item">
                                        <a role="button" class="nav-link profile-title position-relative"
                                            href="{{ route('revisor.index') }}">{{ __('ui.toBeRevised') }}
                                            <span
                                                class="position-absolute top-0 start-75 translate-middle-relative">{{ App\Models\Advertisement::toBeRevisonedCount() }}
                                                <span class="visually-hidden">{{ __('ui.allUnreadMessages') }}</span>
                                            </span>
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('revisor.become') }}"
                                            class="nav-link profile-title">{{ __('ui.workWithUs') }}</a>
                                    </li>
                                @endif
                                {{-- LOGOUT --}}
                                <li class="nav-item me-3 me-lg-0">
                                    <a class="nav-link profile-title" href="#"
                                        onclick="event.preventDefault(); document.querySelector('#logout').submit();">
                                        Logout
                                    </a>
                                </li>
                                <form action="{{ route('logout') }}" method="POST" id="logout">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @endauth
                    {{-- LOGIN/REGISTER MENU --}}
                    @guest
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-title" href="#!" id="profileDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ __('ui.welcome') }}</a>
                            <ul class="dropdown-menu profile-custom-menu" aria-labelledby="profileDropdown">
                                {{-- ACCEDI --}}
                                <li class="nav-item me-3 me-lg-0">
                                    <a class="nav-link profile-title" href="{{ route('login') }}">
                                        {{ __('ui.login') }}
                                    </a>
                                </li>
                                {{-- REGISTRATI --}}
                                <li class="nav-item me-3 me-lg-0">
                                    <a class="nav-link profile-title " href="{{ route('register') }}">
                                        {{ __('ui.register') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    {{-- LINGUE --}}
                    <div class="dropdown p-0">
                        <a role="button" class="nav-link nav-title " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="/media/earth_icon.png" class="language-icon" alt="world">
                        </a>
                        <ul class="dropdown-menu lang-custom-menu p-0">
                            <li class="dropdown-item  p-0">
                                <x-_locale lang="it" nation='it' />
                            </li>
                            <li class="dropdown-item  p-0">
                                <x-_locale lang="en" nation='gb' />
                            </li>
                            <li class="dropdown-item  p-0">
                                <x-_locale lang="es" nation='es' />
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</nav>
