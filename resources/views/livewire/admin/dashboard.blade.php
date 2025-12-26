<div>
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-foreground mb-2">لوحة التحكم</h1>
            <p class="text-muted-foreground">مرحباً بك في لوحة التحكم الإدارية</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-ui.card class="card-gradient border-2 border-border hover:border-primary/50 transition-all">
                <x-ui.card-header class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <x-ui.card-title class="text-sm font-medium text-card-foreground">
                        الخدمات
                    </x-ui.card-title>
                    <div class="p-2 rounded-lg bg-blue-500/10">
                        <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                </x-ui.card-header>
                <x-ui.card-content>
                    <div class="text-3xl font-bold text-card-foreground mb-1">
                        {{ $stats['services'] }}
                    </div>
                    <x-ui.card-description class="text-xs">
                        <svg class="inline h-3 w-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        إجمالي الخدمات
                    </x-ui.card-description>
                </x-ui.card-content>
            </x-ui.card>

            <x-ui.card class="card-gradient border-2 border-border hover:border-primary/50 transition-all">
                <x-ui.card-header class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <x-ui.card-title class="text-sm font-medium text-card-foreground">
                        المشاريع
                    </x-ui.card-title>
                    <div class="p-2 rounded-lg bg-green-500/10">
                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                    </div>
                </x-ui.card-header>
                <x-ui.card-content>
                    <div class="text-3xl font-bold text-card-foreground mb-1">
                        {{ $stats['projects'] }}
                    </div>
                    <x-ui.card-description class="text-xs">
                        <svg class="inline h-3 w-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        إجمالي المشاريع
                    </x-ui.card-description>
                </x-ui.card-content>
            </x-ui.card>

            <x-ui.card class="card-gradient border-2 border-border hover:border-primary/50 transition-all">
                <x-ui.card-header class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <x-ui.card-title class="text-sm font-medium text-card-foreground">
                        مقالات المدونة
                    </x-ui.card-title>
                    <div class="p-2 rounded-lg bg-purple-500/10">
                        <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </x-ui.card-header>
                <x-ui.card-content>
                    <div class="text-3xl font-bold text-card-foreground mb-1">
                        {{ $stats['blog_posts'] }}
                    </div>
                    <x-ui.card-description class="text-xs">
                        <svg class="inline h-3 w-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        إجمالي المقالات
                    </x-ui.card-description>
                </x-ui.card-content>
            </x-ui.card>

            <x-ui.card class="card-gradient border-2 border-border hover:border-primary/50 transition-all">
                <x-ui.card-header class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <x-ui.card-title class="text-sm font-medium text-card-foreground">
                        الرسائل
                    </x-ui.card-title>
                    <div class="p-2 rounded-lg bg-orange-500/10">
                        <svg class="h-5 w-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </x-ui.card-header>
                <x-ui.card-content>
                    <div class="text-3xl font-bold text-card-foreground mb-1">
                        {{ $stats['messages'] }}
                    </div>
                    <x-ui.card-description class="text-xs">
                        <svg class="inline h-3 w-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        إجمالي الرسائل
                    </x-ui.card-description>
                </x-ui.card-content>
            </x-ui.card>

            <x-ui.card class="card-gradient border-2 border-border hover:border-primary/50 transition-all">
                <x-ui.card-header class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <x-ui.card-title class="text-sm font-medium text-card-foreground">
                        رسائل غير مقروءة
                    </x-ui.card-title>
                    <div class="p-2 rounded-lg bg-red-500/10">
                        <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </x-ui.card-header>
                <x-ui.card-content>
                    <div class="text-3xl font-bold text-card-foreground mb-1">
                        {{ $stats['unread_messages'] }}
                    </div>
                    <x-ui.card-description class="text-xs">
                        <svg class="inline h-3 w-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        رسائل جديدة
                    </x-ui.card-description>
                </x-ui.card-content>
            </x-ui.card>
        </div>

        <!-- Quick Actions -->
        <x-ui.card class="card-gradient border-2 border-border">
            <x-ui.card-header>
                <x-ui.card-title>إجراءات سريعة</x-ui.card-title>
                <x-ui.card-description>الوصول السريع إلى الأقسام الرئيسية</x-ui.card-description>
            </x-ui.card-header>
            <x-ui.card-content>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a
                        href="{{ route('admin.services') }}"
                        class="p-4 bg-accent rounded-lg hover:bg-accent/80 transition-all text-center group border border-border hover:border-primary/50"
                    >
                        <svg class="h-8 w-8 mx-auto mb-2 text-primary group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        <p class="text-sm font-medium">إدارة الخدمات</p>
                        <svg class="h-4 w-4 mx-auto mt-2 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <a
                        href="{{ route('admin.projects') }}"
                        class="p-4 bg-accent rounded-lg hover:bg-accent/80 transition-all text-center group border border-border hover:border-primary/50"
                    >
                        <svg class="h-8 w-8 mx-auto mb-2 text-primary group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        <p class="text-sm font-medium">إدارة المشاريع</p>
                        <svg class="h-4 w-4 mx-auto mt-2 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <a
                        href="{{ route('admin.blog') }}"
                        class="p-4 bg-accent rounded-lg hover:bg-accent/80 transition-all text-center group border border-border hover:border-primary/50"
                    >
                        <svg class="h-8 w-8 mx-auto mb-2 text-primary group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-sm font-medium">إدارة المدونة</p>
                        <svg class="h-4 w-4 mx-auto mt-2 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <a
                        href="{{ route('admin.contact') }}"
                        class="p-4 bg-accent rounded-lg hover:bg-accent/80 transition-all text-center group border border-border hover:border-primary/50 relative"
                    >
                        @if($stats['unread_messages'] > 0)
                            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $stats['unread_messages'] }}
                            </span>
                        @endif
                        <svg class="h-8 w-8 mx-auto mb-2 text-primary group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-sm font-medium">الرسائل</p>
                        <svg class="h-4 w-4 mx-auto mt-2 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                </div>
            </x-ui.card-content>
        </x-ui.card>
    </div>
</div>
