@props(['code' => '', 'language' => 'typescript'])

<div 
    x-data="{ copied: false }"
    class="relative group my-6 rounded-lg overflow-hidden border border-border/50 hover:border-primary/30 transition-all duration-300"
>
    <div class="flex items-center justify-between bg-muted/50 px-4 py-2 border-b border-border/50">
        <span class="text-sm text-muted-foreground font-mono">{{ $language }}</span>
        <button
            @click="
                navigator.clipboard.writeText(@js($code));
                copied = true;
                setTimeout(() => copied = false, 2000);
            "
            class="flex items-center gap-2 text-sm hover:bg-primary/10 px-2 py-1 rounded transition-colors"
        >
            <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
            <svg x-show="copied" class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span x-text="copied ? 'تم النسخ!' : 'نسخ'"></span>
        </button>
    </div>
    <pre class="bg-muted p-4 overflow-x-auto text-sm font-mono leading-relaxed"><code>{{ $code }}</code></pre>
</div>

