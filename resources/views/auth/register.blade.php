<x-guest-layout>
    @section('title', __('Register'))
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="signup-form">
                    <h2>{{ __('Register') }}</h2> 
                    
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ __('Name') }}" name="name" :value="old('name')"  autofocus autocomplete="name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="{{ __('Email') }}" type="email" name="email" :value="old('email')"  >
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="{{ __('Password') }}"  name="password"  autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" name="password_confirmation"  autocomplete="new-password">
                        </div>
                        <button type="submit">{{ __('Register') }}</button>
                        <span class="dont-account">{{ __('Already registered?') }}<a href="{{ route('login') }}">{{ __('Log In') }}</a></span>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
