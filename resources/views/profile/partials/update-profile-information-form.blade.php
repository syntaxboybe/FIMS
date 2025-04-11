@php
    use Illuminate\Support\Facades\Storage;
@endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-frappe-text">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-frappe-subtext0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Image -->
        <div>
            <x-input-label for="profile_image" :value="__('Profile Image')" />

            <div class="mt-2 flex items-center">
                @if ($user->profile_image)
                    <div class="mr-4">
                        <div class="h-20 w-20 rounded-full overflow-hidden bg-gray-200 dark:bg-frappe-surface0">
                            <img src="{{ Storage::url($user->profile_image) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                        </div>
                    </div>
                @endif
                <x-text-input id="profile_image" name="profile_image" type="file" class="mt-1 block w-full" accept="image/*" />
            </div>
            <p class="mt-1 text-sm text-gray-500 dark:text-frappe-overlay2">
                {{ __('Upload a profile picture (JPEG, PNG, JPG, or GIF, max 2MB)') }}
            </p>
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-frappe-text">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-frappe-subtext0 hover:text-gray-900 dark:hover:text-frappe-text rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-frappe-blue">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-frappe-green">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-frappe-subtext0"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
