<x-auth-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email --}}
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email"
       value="{{ old('email') }}" required
       pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$"
       title="Masukkan email yang valid (contoh: nama@domain.com)"
       class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <p id="email-hint" class="mt-1 text-xs text-gray-500">
                Format email harus valid, contoh: nama@domain.com
            </p>
        </div>

        <!-- Password -->

        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <input id="password" name="password" type="password" required
       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$"
       title="Minimal 8 karakter, ada huruf besar, huruf kecil, angka, dan simbol"
                    x-bind:type="show ? 'text' : 'password'"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">

                {{-- Ikon Mata untuk Show/Hide --}}
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg @click="show = !show" :class="{'hidden': !show}" class="h-6 w-6 text-gray-500 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                    <svg @click="show = !show" :class="{'hidden': show}" class="h-6 w-6 text-gray-500 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
            </div>

        <!-- Confirm Password -->

        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
                <input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    x-bind:type="show ? 'text' : 'password'"
                    name="password_confirmation" required autocomplete="new-password">

                {{-- Ikon Mata untuk Show/Hide --}}
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg @click="show = !show" :class="{'hidden': !show}" class="h-6 w-6 text-gray-500 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                    <svg @click="show = !show" :class="{'hidden': show}" class="h-6 w-6 text-gray-500 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Checklist ketentuan password (live) --}}
        <div class="mt-2 text-xs">
            <ul class="space-y-1">
                <li id="pw-length"  class="flex items-center gap-2 text-gray-500">
                    <span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span>
                    Minimal 8 karakter
                </li>
                <li id="pw-lower"   class="flex items-center gap-2 text-gray-500">
                    <span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span>
                    Mengandung huruf kecil
                </li>
                <li id="pw-upper"   class="flex items-center gap-2 text-gray-500">
                    <span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span>
                    Mengandung huruf besar
                </li>
                <li id="pw-number"  class="flex items-center gap-2 text-gray-500">
                    <span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span>
                    Mengandung angka
                </li>
                <li id="pw-symbol"  class="flex items-center gap-2 text-gray-500">
                    <span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span>
                    Mengandung simbol
                </li>
                <li id="pw-match"   class="flex items-center gap-2 text-gray-500">
                    <span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600">•</span>
                    Konfirmasi password sama
                </li>
            </ul>
        </div>

        {{-- Script validasi live (tidak mengganggu backend validation) --}}
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const email   = document.getElementById('email');
            const pw      = document.getElementById('password');
            const pw2     = document.getElementById('password_confirmation');

            const emailHint = document.getElementById('email-hint');

            const el = {
                length:  document.getElementById('pw-length'),
                lower:   document.getElementById('pw-lower'),
                upper:   document.getElementById('pw-upper'),
                number:  document.getElementById('pw-number'),
                symbol:  document.getElementById('pw-symbol'),
                match:   document.getElementById('pw-match'),
            };

            const re = {
                email:  /^[^@\s]+@[^@\s]+\.[^@\s]+$/,
                lower:  /[a-z]/,
                upper:  /[A-Z]/,
                number: /\d/,
                symbol: /[^A-Za-z0-9]/,
            };

            function setState(li, ok) {
                if (!li) return;
                const dot = li.querySelector('span');
                if (ok) {
                    li.classList.remove('text-gray-500');
                    li.classList.add('text-green-600');
                    if (dot) { dot.textContent = '✓'; dot.className = 'w-4 h-4 inline-flex items-center justify-center rounded-full bg-green-100 text-green-700'; }
                } else {
                    li.classList.remove('text-green-600');
                    li.classList.add('text-gray-500');
                    if (dot) { dot.textContent = '•'; dot.className = 'w-4 h-4 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600'; }
                }
            }

            function validateEmail() {
                const ok = re.email.test(email.value.trim());
                emailHint.classList.toggle('text-green-600', ok);
                emailHint.classList.toggle('text-gray-500', !ok);
                email.setAttribute('aria-invalid', ok ? 'false' : 'true');
            }

            function validatePassword() {
                const v = pw.value || '';
                setState(el.length, v.length >= 8);
                setState(el.lower,  re.lower.test(v));
                setState(el.upper,  re.upper.test(v));
                setState(el.number, re.number.test(v));
                setState(el.symbol, re.symbol.test(v));

                const same = v.length > 0 && v === (pw2.value || '');
                setState(el.match, same);
            }

            function validatePasswordMatch() {
                const same = (pw.value || '') === (pw2.value || '') && pw2.value.length > 0;
                setState(el.match, same);
            }

            if (email) {
                validateEmail();
                email.addEventListener('input', validateEmail);
            }
            if (pw) {
                validatePassword();
                pw.addEventListener('input', validatePassword);
            }
            if (pw2) {
                pw2.addEventListener('input', validatePasswordMatch);
            }
        });
        </script>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
            
        </div>
    </form>
</x-auth-layout>
