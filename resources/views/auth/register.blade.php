<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- ID Number -->
            <div class="mb-4">
                <x-input-label for="id_no" :value="__('ID Number')" />
                <x-text-input id="id_no" autocomplete="off" class="block mt-1 w-full" type="text" name="id_no" :value="old('id_no')" required autofocus />
                <x-input-error :messages="$errors->get('id_no')" class="mt-2" />
            </div>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Full Name')" />
                <x-text-input id="name" autocomplete="off" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Department -->
            <div class="mt-4">
                <x-input-label for="department" :value="__('Department')" />
                <select id="department" name="department" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" :value="old('department')">
                    @foreach ($depts as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Local Phone')" />
                <x-text-input id="email" autocomplete="off" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Local Phone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Local Phone')" />
                <x-text-input id="phone" autocomplete="off" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
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
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-primary-button style="display: block !important;" class="w-full py-3 text-center">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
