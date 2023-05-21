<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autofocus autocomplete="username" />
            </div>

            <div>
                <x-label for="dob" value="{{ __(' Date of Birth') }}" />
                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" value="old('dob')"  autofocus autocomplete="dob" />" 
            </div>

            <div>
                <x-label for="name" value="{{ __(' First Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autocomplete="name" />
            </div>

            <div>
                <x-label for="middle_name" value="{{ __('Middle Name') }}" />
                <x-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" :value="old('middle_name')"  autofocus autocomplete="middle_name" />
            </div>

            <div>
                <x-label for="last_name" value="{{ __('Last Name') }}" />
                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"  autofocus autocomplete="last_name" />
            </div>

            <div>
                <x-label for="extension" value="{{ __('Extension') }}" />
                <x-input id="extension" class="block mt-1 w-full" type="text" name="extension" :value="old('extension')"  autofocus autocomplete="extension" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password"  autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"  autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms"  />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
