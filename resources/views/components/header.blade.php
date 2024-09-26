<header class="container-fluid header-img vh-100">
    @if (session('message'))
    <div class="container-fluid pt-5">
        <div class="row justify-content-center">
            <div class="col-4 pt-5">
                <div class="alert alert-success">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{$slot}}
    {{-- <div class="header-img position-relative">
    </div> --}}
</header>