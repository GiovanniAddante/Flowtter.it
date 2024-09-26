<x-layout>
    <div class="container min-vh-100 pt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 pt-5">
                <h1 class="title-index-pages text-center m-5 pb-5">{{ __('ui.registerTitle') }}</h1>
                <form method="POST" action="{{ route('register') }}" class="form-custom shadow p-5">
                    @csrf
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" name="name" id="name" class="form-control" />
                                <label class="card-text-custom fs-4" for="name">{{ __('ui.registerName') }}</label>
                            </div>
                        </div>

                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="email" class="form-control" />
                        <label class="card-text-custom fs-4" for="email">{{ __('ui.registerEmail') }}</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="password" class="form-control" />
                        <label class="card-text-custom fs-4" for="password">{{ __('ui.registerPassword') }}</label>
                    </div>

                    <!-- Password confirmation -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" />
                        <label class="card-text-custom fs-4"
                            for="password_confirmation">{{ __('ui.registerConfirmPassword') }}</label>
                    </div>

                    <!-- Submit button -->
                    <div class=" d-flex justify-content-end">
                        <button type="submit" class="btn btn-custom fs-5 mb-4">{{ __('ui.register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
