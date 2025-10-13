<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username"
                pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$"
                title="Masukkan email yang valid (contoh: nama@domain.com)" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Nomor Telepon')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Alamat')" />
            <textarea id="address" name="address" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('address', $user->address) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <p id="email-hint-profile" class="mt-1 text-xs text-gray-500">
        Format email harus valid, contoh: nama@domain.com
    </p>
</section>

{{-- Live validation (email) --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const email = document.getElementById('email');
    const hint  = document.getElementById('email-hint-profile');
    const reEmail = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

    function validateEmail() {
        if (!email || !hint) return;
        const ok = reEmail.test((email.value || '').trim());
        hint.classList.toggle('text-green-600', ok);
        hint.classList.toggle('text-gray-500', !ok);
        email.setAttribute('aria-invalid', ok ? 'false' : 'true');
    }

    if (email) {
        validateEmail();
        email.addEventListener('input', validateEmail);
        email.addEventListener('blur', validateEmail);
    }
});
</script>