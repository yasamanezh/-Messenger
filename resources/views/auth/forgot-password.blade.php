<x-guest-layout>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="forget-password-form">
                    <h2>{{ __('Forgot your password?') }} </h2>
                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif

                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ __('Email') }}" name="email" :value="old('email')" required autofocus >
                        </div>
                        <button type="submit"> {{ __('Email Password Reset Link') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
