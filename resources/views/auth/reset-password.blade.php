<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <p id="email-hint-reset" class="mt-1 text-xs text-gray-500">
            Format email harus valid, contoh: nama@domain.com
        </p>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
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

        {{-- Checklist password (live) --}}
        <div class="mt-2 text-xs">
            <ul class="space-y-1">
                <li id="pw-length-r"  class="flex items-center gap-2 text-gray-500"><span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span> Minimal 8 karakter</li>
                <li id="pw-lower-r"   class="flex items-center gap-2 text-gray-500"><span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span> Mengandung huruf kecil</li>
                <li id="pw-upper-r"   class="flex items-center gap-2 text-gray-500"><span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span> Mengandung huruf besar</li>
                <li id="pw-number-r"  class="flex items-center gap-2 text-gray-500"><span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span> Mengandung angka</li>
                <li id="pw-symbol-r"  class="flex items-center gap-2 text-gray-500"><span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span> Mengandung simbol</li>
                <li id="pw-match-r"   class="flex items-center gap-2 text-gray-500"><span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span> Konfirmasi password sama</li>
            </ul>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    {{-- Live validation script --}}
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const email = document.getElementById('email');
        const emailHint = document.getElementById('email-hint-reset');

        const pw  = document.getElementById('password');
        const pw2 = document.getElementById('password_confirmation');

        const el = {
            length:  document.getElementById('pw-length-r'),
            lower:   document.getElementById('pw-lower-r'),
            upper:   document.getElementById('pw-upper-r'),
            number:  document.getElementById('pw-number-r'),
            symbol:  document.getElementById('pw-symbol-r'),
            match:   document.getElementById('pw-match-r'),
        };

        const re = {
            email:  /^[^@\s]+@[^@\s]+\.[^@\s]+$/,
            lower:  /[a-z]/,
            upper:  /[A-Z]/,
            number: /\d/,
            symbol: /[^A-Za-z0-9]/,
        };

        function dot(li, ok) {
            if (!li) return;
            const s = li.querySelector('span');
            if (ok) {
                li.classList.remove('text-gray-500'); li.classList.add('text-green-600');
                if (s) { s.textContent = '✓'; s.className = 'w-4 h-4 inline-flex items-center justify-center rounded-full bg-green-100 text-green-700'; }
            } else {
                li.classList.remove('text-green-600'); li.classList.add('text-gray-500');
                if (s) { s.textContent = '•'; s.className = 'w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600'; }
            }
        }

        function validateEmail() {
            if (!email || !emailHint) return;
            const ok = re.email.test((email.value || '').trim());
            emailHint.classList.toggle('text-green-600', ok);
            emailHint.classList.toggle('text-gray-500', !ok);
            email.setAttribute('aria-invalid', ok ? 'false' : 'true');
        }

        function validatePassword() {
            const v = (pw?.value || '');
            dot(el.length, v.length >= 8);
            dot(el.lower,  re.lower.test(v));
            dot(el.upper,  re.upper.test(v));
            dot(el.number, re.number.test(v));
            dot(el.symbol, re.symbol.test(v));
            dot(el.match, v.length > 0 && v === (pw2?.value || ''));
        }

        function validatePasswordMatch() {
            const same = (pw?.value || '') === (pw2?.value || '') && (pw2?.value || '').length > 0;
            dot(el.match, same);
        }

        validateEmail(); validatePassword(); validatePasswordMatch();

        email?.addEventListener('input', validateEmail);
        pw?.addEventListener('input', validatePassword);
        pw2?.addEventListener('input', validatePasswordMatch);
    });
    </script>
</x-guest-layout>
