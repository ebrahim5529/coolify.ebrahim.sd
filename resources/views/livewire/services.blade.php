<div>
    <section id="services" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl lg:text-5xl font-bold text-foreground mb-4">
                    خدماتي <span class="text-gradient">المتميزة</span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    أقدم مجموعة شاملة من الخدمات البرمجية لتحويل أفكارك إلى واقع رقمي ناجح
                </p>
            </div>

            @if($services->isEmpty())
                <div class="text-center py-12">
                    <p class="text-muted-foreground">لا توجد خدمات متاحة حالياً</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $index => $service)
                        <x-ui.card 
                            class="card-gradient p-8 border-2 border-border hover:border-primary/50 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/20 group cursor-pointer animate-fade-in-up hover:-translate-y-3"
                            style="animation-delay: {{ $index * 0.1 }}s"
                        >
                            <div class="mb-6 inline-flex p-4 bg-primary/10 rounded-xl group-hover:bg-primary/20 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                @php
                                    $iconMap = [
                                        'Code' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                                        'ShoppingCart' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
                                        'Brain' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                                        'Zap' => 'M13 10V3L4 14h7v7l9-11h-7z',
                                        'Palette' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',
                                        'Server' => 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01',
                                        'Database' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4',
                                        'Wrench' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
                                    ];
                                    $iconPath = $iconMap[$service->icon] ?? $iconMap['Code'];
                                @endphp
                                <svg class="w-10 h-10 text-primary group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-card-foreground mb-3 group-hover:text-primary transition-colors duration-300">
                                {{ $service->title }}
                            </h3>
                            <p class="text-muted-foreground leading-relaxed group-hover:text-foreground transition-colors duration-300">
                                {{ $service->description }}
                            </p>
                        </x-ui.card>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
