<div>
    <livewire:navbar />
    
    <article class="py-12">
        <!-- Header Image -->
        @if($post->image)
            <div class="w-full h-[400px] md:h-[500px] relative overflow-hidden mb-8">
                <img 
                    src="{{ (str_starts_with($post->image, 'http://') || str_starts_with($post->image, 'https://')) ? $post->image : asset('storage/' . $post->image) }}" 
                    alt="{{ $post->title }}"
                    class="w-full h-full object-cover"
                    loading="lazy"
                    onerror="this.style.display='none';"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-background to-transparent"></div>
            </div>
        @endif

        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Breadcrumb -->
            <nav class="mb-6 text-sm">
                <a href="{{ route('home') }}" class="text-muted-foreground hover:text-primary">الرئيسية</a>
                <span class="mx-2 text-muted-foreground">/</span>
                <a href="{{ route('blog.index') }}" class="text-muted-foreground hover:text-primary">المدونة</a>
                <span class="mx-2 text-muted-foreground">/</span>
                <span class="text-foreground">{{ $post->title }}</span>
            </nav>

            <!-- Article Header -->
            <header class="mb-8">
                <div class="inline-block bg-secondary text-secondary-foreground px-4 py-1 rounded-full text-sm font-semibold mb-4">
                    {{ $post->category ?? 'عام' }}
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold text-foreground mb-4 leading-tight">
                    {{ $post->title }}
                </h1>
                
                <p class="text-xl text-muted-foreground mb-6">
                    {{ $post->description }}
                </p>

                <div class="flex flex-wrap items-center gap-6 text-muted-foreground">
                    @if($post->date)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <time datetime="{{ $post->date }}">{{ \Carbon\Carbon::parse($post->date)->locale('ar')->format('Y-m-d') }}</time>
                        </div>
                    @endif
                    @if($post->read_time)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $post->read_time }}</span>
                        </div>
                    @endif
                    <button 
                        x-data="{ copied: false }"
                        @click="
                            navigator.clipboard.writeText(window.location.href);
                            copied = true;
                            setTimeout(() => copied = false, 2000);
                        "
                        class="flex items-center gap-2 hover:text-primary transition-colors"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        <span x-text="copied ? 'تم النسخ!' : 'مشاركة'"></span>
                    </button>
                </div>
            </header>

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none
                prose-headings:text-foreground prose-headings:font-bold
                prose-h2:text-3xl prose-h2:mt-12 prose-h2:mb-4 prose-h2:text-gradient
                prose-h3:text-2xl prose-h3:mt-8 prose-h3:mb-3
                prose-p:text-muted-foreground prose-p:leading-relaxed prose-p:mb-4 prose-p:text-lg
                prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                prose-strong:text-foreground prose-strong:font-semibold
                prose-code:bg-primary/10 prose-code:text-primary prose-code:px-2 prose-code:py-1 prose-code:rounded prose-code:text-sm prose-code:font-mono
                prose-ul:text-muted-foreground prose-ul:my-6 prose-ul:space-y-2
                prose-li:mb-2 prose-li:text-lg
                prose-ol:text-muted-foreground prose-ol:my-6
                prose-pre:bg-muted prose-pre:p-4 prose-pre:rounded-lg prose-pre:overflow-x-auto">
                {!! $post->content !!}
            </div>

            <!-- Back to Blog Button -->
            <div class="mt-12 pt-8 border-t border-border">
                <x-ui.button 
                    variant="outline" 
                    size="lg"
                    as="a"
                    href="{{ route('blog.index') }}"
                    class="gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    العودة إلى المدونة
                </x-ui.button>
            </div>
        </div>
    </article>

    <x-footer />
    <x-whatsapp-button />
</div>
