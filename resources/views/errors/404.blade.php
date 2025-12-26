<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - الصفحة غير موجودة</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-background via-background to-primary/5 p-4">
        <x-ui.card class="w-full max-w-2xl shadow-2xl border-2">
            <x-ui.card-content class="p-8 md:p-12">
                <div class="text-center space-y-6">
                    <!-- 404 Number with Animation -->
                    <div class="relative">
                        <h1 class="text-9xl md:text-[12rem] font-bold text-primary/20 select-none">
                            404
                        </h1>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-24 h-24 md:w-32 md:h-32 text-primary animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div class="space-y-3">
                        <h2 class="text-3xl md:text-4xl font-bold text-foreground">
                            الصفحة غير موجودة
                        </h2>
                        <p class="text-lg md:text-xl text-muted-foreground">
                            عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها
                        </p>
                        <p class="text-sm text-muted-foreground font-mono bg-muted/50 p-2 rounded-md inline-block">
                            {{ request()->url() }}
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-6">
                        <x-ui.button
                            href="{{ route('home') }}"
                            size="lg"
                            class="w-full sm:w-auto group"
                        >
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            العودة للرئيسية
                        </x-ui.button>
                        <x-ui.button
                            onclick="window.history.back()"
                            variant="outline"
                            size="lg"
                            class="w-full sm:w-auto group"
                        >
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            الرجوع للخلف
                        </x-ui.button>
                    </div>

                    <!-- Quick Links -->
                    <div class="pt-8 border-t">
                        <p class="text-sm text-muted-foreground mb-4">روابط سريعة:</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <x-ui.button
                                variant="ghost"
                                size="sm"
                                href="{{ route('blog.index') }}"
                                class="text-sm"
                            >
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                المدونة
                            </x-ui.button>
                            <x-ui.button
                                variant="ghost"
                                size="sm"
                                href="{{ route('home') }}#about"
                                class="text-sm"
                            >
                                نبذة عني
                            </x-ui.button>
                            <x-ui.button
                                variant="ghost"
                                size="sm"
                                href="{{ route('home') }}#contact"
                                class="text-sm"
                            >
                                تواصل معي
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            </x-ui.card-content>
        </x-ui.card>
    </div>
</body>
</html>

