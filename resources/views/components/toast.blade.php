<div id="toast-container" class="fixed top-24 right-4 z-[9999] flex flex-col gap-3 pointer-events-none">
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="pointer-events-auto bg-white border-l-4 border-green-500 rounded-xl shadow-2xl p-4 flex items-center gap-4 min-w-[320px] animate-fade-in-up">
        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-500 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <div class="flex-1">
            <p class="text-sm font-bold text-gray-900">Berhasil!</p>
            <p class="text-xs text-gray-500">{{ session('success') }}</p>
        </div>
        <button @click="show = false" class="text-gray-300 hover:text-gray-500 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="pointer-events-auto bg-white border-l-4 border-brand-brown rounded-xl shadow-2xl p-4 flex items-center gap-4 min-w-[320px] animate-fade-in-up">
        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-brand-brown shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="flex-1">
            <p class="text-sm font-bold text-gray-900">Terjadi Kesalahan</p>
            <p class="text-xs text-gray-500">{{ session('error') }}</p>
        </div>
        <button @click="show = false" class="text-gray-300 hover:text-gray-500 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    @endif
</div>
