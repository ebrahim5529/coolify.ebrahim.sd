<div>
    <section id="about" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h1 class="text-4xl lg:text-5xl font-bold text-foreground mb-4">
                        نبذة <span class="text-gradient">عني</span>
                    </h1>
                    <p class="text-xl text-muted-foreground">إبراهيم حمزة - متخصص في تكنولوجيا المعلومات</p>
                </div>

                @if($personalInfo)
                    <x-ui.card class="card-gradient p-6 border-2 border-border shadow-xl mb-8 animate-fade-in-up">
                        <div class="flex flex-wrap items-center justify-center gap-6 text-card-foreground">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $personalInfo->location ?? 'السودان' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <a href="tel:0900856660" class="hover:text-secondary transition-colors">0900856660</a>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:Ebrahim5529@gmail.com" class="hover:text-secondary transition-colors">Ebrahim5529@gmail.com</a>
                            </div>
                        </div>
                    </x-ui.card>

                    <x-ui.card class="card-gradient p-8 lg:p-12 border-2 border-border shadow-xl mb-8 animate-fade-in-up">
                        <div class="space-y-6">
                            <h2 class="text-3xl font-bold text-card-foreground flex items-center gap-3">
                                <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                الملخص المهني
                            </h2>
                            <p class="text-lg text-card-foreground/90 leading-relaxed">
                                {{ $personalInfo->summary ?? 'متخصص في تكنولوجيا المعلومات حاصل على درجة الماجستير في تكنولوجيا المعلومات ودرجة البكالوريوس في نظم المعلومات.' }}
                            </p>
                        </div>
                    </x-ui.card>
                @endif
            </div>
        </div>
    </section>
</div>
