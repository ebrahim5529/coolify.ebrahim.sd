<div>
    <section id="blog" class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl lg:text-5xl font-bold text-foreground mb-4">
                    آخر <span class="text-gradient">المقالات</span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    مقالات ومحتوى تقني حول تطوير الويب والتقنيات الحديثة
                </p>
            </div>

            @if($posts->isEmpty())
                <div class="text-center py-12">
                    <p class="text-muted-foreground">لا توجد مقالات متاحة حالياً</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $index => $post)
                        <x-ui.card 
                            class="group overflow-hidden border-2 border-border hover:border-primary/50 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/20 animate-fade-in-up hover:-translate-y-3"
                            style="animation-delay: {{ $index * 0.1 }}s"
                        >
                            @if($post->image)
                                <div class="relative h-48 overflow-hidden">
                                    <img 
                                        src="{{ (str_starts_with($post->image, 'http://') || str_starts_with($post->image, 'https://')) ? $post->image : asset('storage/' . $post->image) }}" 
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        loading="lazy"
                                        onerror="this.style.display='none';"
                                    />
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-card-foreground mb-3 group-hover:text-primary transition-colors duration-300">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-muted-foreground leading-relaxed mb-4">
                                    {{ $post->description }}
                                </p>
                                <x-ui.button size="sm" as="a" href="{{ route('blog.show', $post->slug) }}">
                                    اقرأ المزيد
                                </x-ui.button>
                            </div>
                        </x-ui.card>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
