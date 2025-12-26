<div>
    <section class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl lg:text-5xl font-bold text-foreground mb-4">
                    التقنيات التي <span class="text-gradient">أستخدمها</span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    أعمل بأحدث التقنيات والأدوات لضمان أفضل النتائج
                </p>
            </div>

            @if($technologies->isEmpty())
                <div class="text-center py-12">
                    <p class="text-muted-foreground">لا توجد تقنيات متاحة حالياً</p>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 max-w-6xl mx-auto">
                    @foreach($technologies as $index => $tech)
                        <div
                            class="group relative flex flex-col items-center gap-4 p-6 rounded-xl bg-card border-2 border-border hover:border-primary transition-all duration-500 hover:shadow-2xl hover:-translate-y-3 animate-fade-in-up overflow-hidden"
                            style="animation-delay: {{ $index * 0.1 }}s"
                        >
                            <div 
                                class="absolute inset-0 opacity-0 group-hover:opacity-10 transition-all duration-500"
                                style="background-color: {{ $tech->color ?? '#000' }}"
                            ></div>
                            
                            <div class="relative w-20 h-20 flex items-center justify-center">
                                <div 
                                    class="absolute inset-0 rounded-full opacity-0 group-hover:opacity-20 blur-xl transition-all duration-500 scale-150"
                                    style="background-color: {{ $tech->color ?? '#000' }}"
                                ></div>
                                <div 
                                    class="relative w-16 h-16 rounded-full flex items-center justify-center transition-all duration-500 group-hover:scale-110"
                                    style="background-color: {{ $tech->color ?? '#000' }}20"
                                >
                                    @if($tech->icon && (str_starts_with($tech->icon, 'http://') || str_starts_with($tech->icon, 'https://')))
                                        <img 
                                            src="{{ $tech->icon }}" 
                                            alt="{{ $tech->name }}"
                                            class="w-14 h-14 object-contain p-1"
                                            loading="lazy"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                        >
                                        <span class="text-3xl hidden">{{ $tech->name[0] ?? '💻' }}</span>
                                    @else
                                        <span class="text-3xl">{{ $tech->icon ?? '💻' }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <h3 class="text-center font-bold text-card-foreground group-hover:text-primary transition-colors duration-300">
                                {{ $tech->name }}
                            </h3>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
