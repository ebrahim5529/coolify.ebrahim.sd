<div>
    <livewire:navbar />
    <main>
        <section class="py-20 bg-background">
            <div class="container mx-auto px-4">
                <header class="text-center mb-16 animate-fade-in-up">
                    <h1 class="text-4xl lg:text-5xl font-bold text-foreground mb-4">
                        المدونة التقنية
                    </h1>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        مقالات ونصائح احترافية في تطوير الويب والبرمجة لمساعدتك على تطوير مهاراتك
                    </p>
                </header>

                @if($posts->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-muted-foreground">لا توجد مقالات متاحة حالياً</p>
                    </div>
                @else
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($posts as $index => $post)
                            <article 
                                class="card-gradient hover:shadow-hover transition-all duration-300 overflow-hidden group rounded-lg border bg-card text-card-foreground shadow-sm animate-fade-in-up"
                                style="animation-delay: {{ $index * 0.1 }}s"
                            >
                                @if($post->image)
                                    <div class="relative overflow-hidden h-48">
                                        <img 
                                            src="{{ (str_starts_with($post->image, 'http://') || str_starts_with($post->image, 'https://')) ? $post->image : asset('storage/' . $post->image) }}" 
                                            alt="{{ $post->title }}"
                                            loading="lazy"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                            onerror="this.style.display='none';"
                                        />
                                        <div class="absolute top-4 right-4 bg-secondary text-secondary-foreground px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $post->category ?? 'عام' }}
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-card-foreground mb-2 group-hover:text-primary transition-colors">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-muted-foreground mb-4">
                                        {{ $post->description }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between text-sm text-muted-foreground mb-4">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <time datetime="{{ $post->date }}">{{ $post->date ? \Carbon\Carbon::parse($post->date)->locale('ar')->format('Y-m-d') : '' }}</time>
                                        </div>
                                        @if($post->read_time)
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>{{ $post->read_time }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <x-ui.button 
                                        variant="outline" 
                                        class="w-full group/btn"
                                        as="a"
                                        href="{{ route('blog.show', $post->slug) }}"
                                    >
                                        اقرأ المزيد
                                        <svg class="mr-2 h-4 w-4 transition-transform group-hover/btn:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </x-ui.button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </main>
    <x-footer />
    <x-whatsapp-button />
</div>
