<a
    href="https://wa.me/249111638872?text={{ urlencode('مرحباً، أريد الاستفسار عن خدماتك') }}"
    target="_blank"
    rel="noopener noreferrer"
    class="fixed bottom-6 right-6 z-50 group"
    aria-label="تواصل عبر واتساب"
    x-data="{ isHovered: false }"
    @mouseenter="isHovered = true"
    @mouseleave="isHovered = false"
>
    <!-- Tooltip -->
    <div 
        x-show="isHovered"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-2"
        class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-card border border-border px-4 py-2 rounded-lg shadow-lg whitespace-nowrap pointer-events-none"
    >
        <span class="text-sm font-semibold text-foreground">تواصل معنا عبر واتساب</span>
        <div class="absolute left-full top-1/2 -translate-y-1/2 border-8 border-transparent border-l-card"></div>
    </div>

    <!-- Button -->
    <div class="relative">
        <!-- Ping Animation -->
        <span class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-75"></span>
        
        <!-- Glow Effect -->
        <div class="absolute inset-0 rounded-full bg-green-500 opacity-20 blur-xl group-hover:opacity-40 transition-opacity duration-300"></div>
        
        <!-- Main Button -->
        <div 
            class="relative w-16 h-16 rounded-full flex items-center justify-center transition-all duration-300 group-hover:scale-110 shadow-2xl"
            style="background: linear-gradient(135deg, #25D366, #128C7E);"
        >
            <svg 
                class="w-8 h-8 text-white transition-transform duration-300 group-hover:scale-110 group-hover:rotate-12" 
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
                stroke-width="2"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
        </div>
    </div>
</a>

