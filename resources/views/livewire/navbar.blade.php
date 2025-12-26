<div>
    <nav 
        x-data="{ isOpen: false, isScrolled: false }"
        x-init="
            window.addEventListener('scroll', () => {
                isScrolled = window.scrollY > 50;
            });
        "
        :class="isScrolled 
            ? 'bg-white/95 backdrop-blur-xl shadow-lg border-b border-border/50' 
            : 'bg-white/90 backdrop-blur-md'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
    >
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo with Icon -->
                <a 
                    href="#"
                    class="flex items-center gap-3 group transition-transform duration-300 hover:scale-105"
                >
                    <div class="relative">
                        <div class="absolute inset-0 bg-primary/20 rounded-lg blur-lg group-hover:bg-primary/30 transition-all duration-300"></div>
                        <div class="relative bg-gradient-to-br from-primary to-secondary p-2.5 rounded-lg shadow-lg">
                            <svg class="h-6 w-6 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                    </div>
                    <span class="text-2xl font-bold text-gradient">
                        إبراهيم حمزة
                    </span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-1">
                    @foreach([
                        ['href' => '#services', 'label' => 'الخدمات'],
                        ['href' => '#projects', 'label' => 'المشاريع'],
                        ['href' => '#blog', 'label' => 'المدونة'],
                        ['href' => '#about', 'label' => 'نبذة عني'],
                        ['href' => '#contact', 'label' => 'تواصل معي'],
                    ] as $link)
                        <a
                            href="{{ $link['href'] }}"
                            class="relative px-4 py-2 text-foreground/80 hover:text-foreground font-semibold transition-all duration-300 group"
                        >
                            <span class="relative z-10">{{ $link['label'] }}</span>
                            <!-- Hover Effect -->
                            <div class="absolute inset-0 bg-primary/5 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                            <!-- Active Indicator -->
                            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-primary to-secondary group-hover:w-3/4 transition-all duration-300"></div>
                        </a>
                    @endforeach
                    
                    <x-ui.button 
                        class="mr-2 bg-gradient-to-r from-primary to-secondary hover:shadow-glow text-primary-foreground font-bold transition-all duration-300 hover:scale-105 shadow-lg"
                        as="a"
                        href="https://wa.me/249111638872"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        واتساب
                    </x-ui.button>
                </div>

                <!-- Mobile Menu Button -->
                <button
                    class="md:hidden text-foreground p-2 hover:bg-muted rounded-lg transition-all duration-300"
                    @click="isOpen = !isOpen"
                    aria-label="القائمة"
                >
                    <svg x-show="!isOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="isOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div 
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 max-h-0"
                x-transition:enter-end="opacity-100 max-h-96"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 max-h-96"
                x-transition:leave-end="opacity-0 max-h-0"
                class="md:hidden overflow-hidden"
            >
                <div class="py-4 border-t border-border/50 bg-card/95 backdrop-blur-xl rounded-b-2xl">
                    <div class="flex flex-col gap-2">
                        @foreach([
                            ['href' => '#services', 'label' => 'الخدمات'],
                            ['href' => '#projects', 'label' => 'المشاريع'],
                            ['href' => '#blog', 'label' => 'المدونة'],
                            ['href' => '#about', 'label' => 'نبذة عني'],
                            ['href' => '#contact', 'label' => 'تواصل معي'],
                        ] as $index => $link)
                            <a
                                href="{{ $link['href'] }}"
                                class="text-foreground/80 hover:text-foreground hover:bg-primary/5 font-semibold transition-all duration-300 px-4 py-3 rounded-lg mx-2 animate-fade-in"
                                style="animation-delay: {{ $index * 50 }}ms"
                                @click="isOpen = false"
                            >
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                        <div class="px-4 pt-2">
                            <x-ui.button 
                                class="w-full bg-gradient-to-r from-primary to-secondary hover:shadow-glow text-primary-foreground font-bold transition-all duration-300"
                                as="a"
                                href="https://wa.me/249111638872"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                واتساب
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
