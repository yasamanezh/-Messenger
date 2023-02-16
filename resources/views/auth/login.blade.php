<x-guest-layout>
    @section('title', __('Log in'))
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="signin-form">
                    <h2>{{ __('Log in') }}</h2>
                    <x-jet-validation-errors class="mb-4" />
                   
                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ __('Email') }}"  name="email" :value="old('email')"  autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password"  autocomplete="current-password" placeholder="{{ __('Password') }}">
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-6 remember-me-wrap">
                                <p>
                                    <input type="checkbox" id="test" name="remember">
                                    <label for="test">{{ __('Remember me') }}</label>
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 lost-your-password-wrap">
                                <a href="{{ route('password.request') }}" class="lost-your-password"> {{ __('Forgot your password?') }}</a>
                            </div>
                        </div>
                        <button type="submit"> {{ __('Log in') }}</button>
                        <span class="dont-account">Don't have an account? <a href="{{ route('register') }}">{{ __('Register') }}</a></span>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
