<x-layout>
    <div class="container min-vh-100 pt-5">
        <div class="row justify-content-center p-5">
            <h1 class="title-index-pages text-center p-5">{{ __('ui.workWithUsTitle') }}</h1>
            <h2 class="card-text-custom text-center pb-5">{{ __('ui.workWithUsSubTitle') }}</h2>
            <form action="{{ route('revisor.request') }}" method="POST" class="form-custom col-12 col-md-5 p-4">
                @csrf
                @if (session('message'))
                    <div class="alert alert-success text-center">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                    @if (session('denied'))
                        <div class="alert alert-danger text-center">
                            {{ session('denied') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                @endif
                <!-- NOME -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label card-text-custom fs-4" for="name">{{ __('ui.workWithUsName') }}</label>
                    <input type="text" id="name" class="form-control" name="name" />
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>

                <!-- EMAIL -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label card-text-custom fs-4"
                        for="email">{{ __('ui.workWithUsEmail') }}</label>
                    <input type="email" id="email" disabled class="form-control" name="email"
                        value="{{ Auth::user()->email }}" />
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <!-- RICHIESTA -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label card-text-custom fs-4"
                        for="description">{{ __('ui.workWithUsDesc') }}</label>
                    <textarea class="form-control" id="description" rows="4" name="description"></textarea>
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
                <!-- Submit button -->
                <div class="d-flex justify-content-end">
                    <button type="submit"
                        class="btn btn-custom btn-block fs-5 m-2">{{ __('ui.workWithUsSend') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
