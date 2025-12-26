<div>
    @if(session('success'))
        <div class="fixed top-20 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-20 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif

    <section id="contact" class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h2 class="text-4xl lg:text-5xl font-bold text-foreground mb-4">
                        تواصل <span class="text-gradient">معي</span>
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        هل لديك مشروع أو استفسار؟ لا تتردد في التواصل معي
                    </p>
                </div>

                <div class="grid lg:grid-cols-5 gap-8">
                    <!-- Contact Info -->
                    <div class="lg:col-span-2 space-y-4">
                        <x-ui.card class="p-6 border-2 border-border hover:border-primary/30 transition-all duration-300">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-secondary/10 rounded-lg">
                                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg mb-2">واتساب</h3>
                                    <a 
                                        href="https://wa.me/249111638872" 
                                        target="_blank" 
                                        rel="noopener noreferrer"
                                        class="text-primary hover:text-primary/80 transition-colors"
                                    >
                                        +249 111 638 872
                                    </a>
                                </div>
                            </div>
                        </x-ui.card>

                        <x-ui.card class="p-6 border-2 border-border hover:border-primary/30 transition-all duration-300">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-accent/10 rounded-lg">
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg mb-2">هاتف</h3>
                                    <a 
                                        href="tel:+249111638872"
                                        class="text-primary hover:text-primary/80 transition-colors"
                                    >
                                        +249 111 638 872
                                    </a>
                                </div>
                            </div>
                        </x-ui.card>

                        <x-ui.button 
                            size="lg"
                            class="w-full bg-secondary hover:bg-secondary/90 text-secondary-foreground font-bold shadow-lg"
                            as="a"
                            href="https://wa.me/249111638872"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            محادثة مباشرة على واتساب
                        </x-ui.button>
                    </div>

                    <!-- Contact Form -->
                    <x-ui.card class="lg:col-span-3 card-gradient p-8 border-2 border-border">
                        <form wire:submit="submit" class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-card-foreground">
                                    الاسم
                                </label>
                                <x-ui.input 
                                    wire:model="name"
                                    placeholder="اسمك الكامل" 
                                    required 
                                    class="bg-background/50 border-border focus:border-primary"
                                />
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-card-foreground">
                                    البريد الإلكتروني
                                </label>
                                <x-ui.input 
                                    type="email"
                                    wire:model="email"
                                    placeholder="email@example.com" 
                                    required
                                    class="bg-background/50 border-border focus:border-primary"
                                />
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-card-foreground">
                                    الرسالة
                                </label>
                                <x-ui.textarea 
                                    wire:model="message"
                                    placeholder="اكتب رسالتك هنا..." 
                                    rows="5"
                                    required
                                    class="bg-background/50 border-border focus:border-primary resize-none"
                                ></x-ui.textarea>
                                @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <x-ui.button 
                                type="submit" 
                                size="lg"
                                :disabled="$isSubmitting"
                                class="w-full bg-primary hover:bg-primary/90 text-primary-foreground font-bold"
                            >
                                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                {{ $isSubmitting ? 'جاري الإرسال...' : 'إرسال الرسالة' }}
                            </x-ui.button>
                        </form>
                    </x-ui.card>
                </div>
            </div>
        </div>
    </section>
</div>
