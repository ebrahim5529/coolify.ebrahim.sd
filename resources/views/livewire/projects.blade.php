<div>
    <section id="projects" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl lg:text-5xl font-bold text-foreground mb-4">
                    مشاريعي <span class="text-gradient">السابقة</span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    مجموعة من المشاريع التي قمت بتطويرها باستخدام أحدث التقنيات
                </p>
            </div>

            @if($projects->isEmpty())
                <div class="text-center py-12">
                    <p class="text-muted-foreground">لا توجد مشاريع متاحة حالياً</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $index => $project)
                        <x-ui.card 
                            class="group overflow-hidden border-2 border-border hover:border-primary/50 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/20 animate-fade-in-up hover:-translate-y-3"
                            style="animation-delay: {{ $index * 0.1 }}s"
                        >
                            @if($project->image)
                                <div class="relative h-48 overflow-hidden">
                                    <img 
                                        src="{{ asset('storage/' . $project->image) }}" 
                                        alt="{{ $project->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    />
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-card-foreground mb-3 group-hover:text-primary transition-colors duration-300">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-muted-foreground leading-relaxed mb-4">
                                    {{ $project->description }}
                                </p>
                                @if($project->demo_url || $project->github_url)
                                    <div class="flex gap-2">
                                        @if($project->demo_url)
                                            <x-ui.button size="sm" as="a" href="{{ $project->demo_url }}" target="_blank">
                                                عرض المشروع
                                            </x-ui.button>
                                        @endif
                                        @if($project->github_url)
                                            <x-ui.button size="sm" variant="outline" as="a" href="{{ $project->github_url }}" target="_blank">
                                                GitHub
                                            </x-ui.button>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </x-ui.card>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
