<div>
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background with overlay -->
        <div 
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/hero-bg.jpg') }}')"
        >
            <div class="absolute inset-0 gradient-bg opacity-90"></div>
        </div>

        <!-- Content -->
        <div class="container relative z-10 mx-auto px-4 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-right space-y-6 animate-fade-in-up">
                    <h1 class="text-5xl lg:text-6xl font-bold text-primary-foreground leading-tight min-h-[4rem] lg:min-h-[5rem]">
                        <span x-data="{ text: 'مرحباً، أنا إبراهيم', displayText: '', index: 0 }" 
                              x-init="
                                  setTimeout(() => {
                                      const interval = setInterval(() => {
                                          if (index < text.length) {
                                              displayText += text[index];
                                              index++;
                                          } else {
                                              clearInterval(interval);
                                          }
                                      }, 150);
                                  }, 500);
                              ">
                            <span x-text="displayText"></span><span class="animate-pulse">|</span>
                        </span>
                    </h1>
                    <p class="text-2xl lg:text-3xl font-semibold text-primary-foreground/90">
                        مطور ويب محترف
                    </p>
                    <p class="text-lg text-primary-foreground/80 max-w-2xl mx-auto lg:mx-0">
                        أعمل على تصميم وتطوير الأنظمة والمواقع الإلكترونية باحترافية واهتمام بالتفاصيل. 
                        أسعى دائمًا لتقديم حلول برمجية متكاملة تجمع بين السرعة، الأداء، والتصميم العصري.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-end pt-4">
                        <x-ui.button 
                            size="lg"
                            class="bg-secondary hover:bg-secondary/90 text-secondary-foreground font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300"
                            as="a"
                            href="https://wa.me/249111638872"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            تواصل عبر واتساب
                        </x-ui.button>
                        <x-ui.button 
                            size="lg"
                            variant="outline"
                            class="border-2 border-primary-foreground bg-black text-primary-foreground hover:bg-black/80 hover:text-primary-foreground font-bold text-lg"
                            as="a"
                            href="#services"
                        >
                            اكتشف خدماتي
                        </x-ui.button>
                    </div>
                </div>

                <!-- Profile Image -->
                <div class="flex justify-center lg:justify-start animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="relative">
                        <div class="absolute inset-0 bg-secondary/20 rounded-full blur-3xl animate-float"></div>
                        <img 
                            src="{{ asset('images/profile.jpg') }}" 
                            alt="إبراهيم - مطور ويب محترف"
                            class="relative rounded-full w-72 h-72 lg:w-96 lg:h-96 object-cover object-center border-8 border-primary-foreground/10 shadow-2xl"
                            style="object-position: center 30%"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 right-1/2 transform translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-primary-foreground/50 rounded-full flex justify-center">
                <div class="w-1.5 h-3 bg-primary-foreground/50 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>
</div>
