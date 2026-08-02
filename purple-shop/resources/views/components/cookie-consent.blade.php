<div x-data="{
        showBanner: false,
        init() {
            if (!localStorage.getItem('cookie_consent')) {
                setTimeout(() => { this.showBanner = true; }, 1000);
            }
        },
        acceptCookies() {
            localStorage.setItem('cookie_consent', 'accepted');
            this.showBanner = false;
        },
        declineCookies() {
            localStorage.setItem('cookie_consent', 'declined');
            this.showBanner = false;
        }
    }"
    x-show="showBanner"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-y-full opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-full opacity-0"
    class="fixed bottom-4 right-4 left-4 md:left-auto md:max-w-md z-50 p-5 bg-slate-900/95 backdrop-blur-md border border-purple-500/30 rounded-2xl shadow-[0_10px_30px_rgba(124,58,237,0.25)] text-slate-200"
    style="display: none;">
    
    <div class="flex items-start gap-3">
        <div class="p-2 bg-purple-600/20 text-purple-400 rounded-xl border border-purple-500/30 text-xl shrink-0">
            🍪
        </div>
        <div>
            <h3 class="text-sm font-bold text-slate-100 font-mono uppercase tracking-wider">Cookie & Privacy Notice</h3>
            <p class="text-xs text-slate-400 mt-1 leading-relaxed">
                We use cookies to improve your shopping experience, analyze site traffic, and personalize content. By clicking <strong class="text-purple-300">"Accept All"</strong>, you consent to our privacy terms.
            </p>
        </div>
    </div>

    <div class="mt-4 pt-3 border-t border-slate-800 flex items-center justify-end gap-2">
        <button @click="declineCookies()" 
                class="px-4 py-2 text-xs font-semibold text-slate-400 hover:text-slate-200 hover:bg-slate-800 rounded-xl transition">
            Decline
        </button>
        <button @click="acceptCookies()" 
                class="px-5 py-2 text-xs font-bold text-white bg-purple-600 hover:bg-purple-500 rounded-xl shadow-lg shadow-purple-600/30 transition hover:scale-105 active:scale-95">
            Accept All ✨
        </button>
    </div>
</div>