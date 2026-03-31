<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Register As')" />
            <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">-- Select Role --</option>
                <option value="patient" {{ old('role') == 'patient' ? 'selected' : '' }}>Patient (Book appointments)</option>
                <option value="hospital" {{ old('role') == 'hospital' ? 'selected' : '' }}>Hospital (Provide services)</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
            <p class="text-xs text-gray-500 mt-1">
                * Hospitals require admin approval before activation
            </p>
        </div>

        <!-- Additional Fields for Hospital -->
        <div id="hospitalFields" class="hidden">
            <div class="mt-4">
                <x-input-label for="hospital_name" :value="__('Hospital Name')" />
                <x-text-input id="hospital_name" class="block mt-1 w-full" type="text" name="hospital_name" :value="old('hospital_name')" />
                <x-input-error :messages="$errors->get('hospital_name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="address" :value="__('Address')" />
                <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('address') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- JavaScript for showing/hiding hospital fields -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const hospitalFields = document.getElementById('hospitalFields');

            roleSelect.addEventListener('change', function() {
                if (this.value === 'hospital') {
                    hospitalFields.classList.remove('hidden');
                } else {
                    hospitalFields.classList.add('hidden');
                }
            });

            // Show hospital fields if old input is 'hospital' (after validation error)
            if (roleSelect.value === 'hospital') {
                hospitalFields.classList.remove('hidden');
            }
        });
    </script>
</x-guest-layout>
