<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Rules\Recaptcha;

class CreateNewUser implements CreatesNewUsers {

    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public $multiLanguage = false;

    public function mount($language = null) {
        
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
    }

    public function create(array $input): User {
  
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [$this->passwordRules(),'string',
            'min:8',             // must be at least 10 characters in length
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
        ],
            'recaptcha_token' => ['required', new Recaptcha($input['recaptcha_token'])],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],[
            'password'=>'The password must be 8 characters long and contain uppercase and lowercase letters numbers and symbols.'
            
            ])->validate();

        return User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'status' => 1,
                    'role' => 'user',
                    'password' => Hash::make($input['password']),
        ]);
    }

}
