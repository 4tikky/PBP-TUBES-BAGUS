@if(session('error') || session('success') || session('warning'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if(session('error'))
            <div class="mb-3 rounded-md border border-red-200 bg-red-50 text-red-800 px-4 py-2">
                {{ session('error') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="mb-3 rounded-md border border-amber-200 bg-amber-50 text-amber-800 px-4 py-2">
                {{ session('warning') }}
            </div>
        @endif
        @if(session('success'))
            <div class="mb-3 rounded-md border border-green-200 bg-green-50 text-green-800 px-4 py-2">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <script>
        setTimeout(() => {
            document.querySelectorAll('[class*="bg-red-50"],[class*="bg-amber-50"],[class*="bg-green-50"]').forEach(el => {
                el.style.transition = 'opacity .3s'; el.style.opacity = '0';
                setTimeout(() => el.remove(), 300);
            });
        }, 4000);
    </script>
@endif