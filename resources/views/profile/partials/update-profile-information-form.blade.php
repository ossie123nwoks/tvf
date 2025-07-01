<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="flex items-center gap-4">
        <div>
            <img class="h-16 w-16 rounded-full object-cover" 
                 src="{{ auth()->user()->profile_photo_url }}" 
                 alt="{{ auth()->user()->name }}">
        </div>
        <div>
            <x-input-label for="avatar" value="Profile Photo" />
            <input id="avatar" name="avatar" type="file" class="mt-1 block w-full">
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
    </div>

    <div>
        <x-input-label for="name" value="Name" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div>
        <x-input-label for="bio" value="About" />
        <x-text-area id="bio" name="bio" class="mt-1 block w-full">{{ old('bio', $user->bio) }}</x-text-area>
        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>