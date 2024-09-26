<x-layout>
    <div class="container min-vh-100 pt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 pt-5">
                <h1 class="title-index-pages text-center mb-5 pb-5">{{ __('ui.loginTitle') }}</h1>
                <form method="POST" action="{{ route('login') }}" class="form-custom shadow p-5">
                    @csrf
                    <!-- 2 column grid layout with text inputs for the first and last names -->

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" name="email" id="email" class="form-control" />
                        <label class="form-label card-text-custom fs-4" for="email">{{ __('ui.loginEmail') }}</label>
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <input type="password" name="password" id="password" class="form-control" />
                            {{-- <span class="px-3 showPsw">
                                <i class="fa-regular fa-eye eye" id="eye"></i>
                                <i class="fa-solid fa-eye-slash hide eyeSlash" id="eyeSlash"></i>
                            </span> --}}
                        </div>
                        <label class="form-label card-text-custom fs-4" for="password">{{ __('ui.loginPassword') }}</label>
                    </div>
                    <!-- Remeber me checkbox -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input fs-5">
                        <label class="form-check-label card-text-custom" for="remember">{{ __('ui.loginRemember') }}</label>
                    </div>

                    <!-- Submit button -->
                    <div class=" d-flex justify-content-end">
                        <button type="submit" class="btn btn-custom fs-5 mb-1">{{ __('ui.login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
