<div>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-background via-background to-primary/5 p-4">
        <x-ui.card class="w-full max-w-md card-gradient border-2 border-border">
            <x-ui.card-header class="text-center space-y-4">
                <div class="mx-auto w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <x-ui.card-title class="text-3xl font-bold">تسجيل الدخول</x-ui.card-title>
                <x-ui.card-description class="text-base">
                    أدخل بياناتك للوصول إلى لوحة التحكم
                </x-ui.card-description>
            </x-ui.card-header>
            <x-ui.card-content>
                <form wire:submit="login" class="space-y-6">
                    <div class="space-y-2">
                        <x-ui.label for="email" class="text-right">البريد الإلكتروني</x-ui.label>
                        <div class="relative">
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-muted-foreground w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <x-ui.input
                                id="email"
                                type="email"
                                wire:model="email"
                                placeholder="email@example.com"
                                class="pr-10 bg-background/50 border-border focus:border-primary"
                                dir="ltr"
                                required
                            />
                        </div>
                        @error('email')
                            <p class="text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <x-ui.label for="password" class="text-right">كلمة المرور</x-ui.label>
                        <div class="relative">
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-muted-foreground w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <x-ui.input
                                id="password"
                                type="password"
                                wire:model="password"
                                placeholder="••••••••"
                                class="pr-10 bg-background/50 border-border focus:border-primary"
                                required
                            />
                        </div>
                        @error('password')
                            <p class="text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input 
                            id="remember" 
                            type="checkbox" 
                            wire:model="remember"
                            class="w-4 h-4 text-primary bg-background border-border rounded focus:ring-primary"
                        >
                        <label for="remember" class="mr-2 text-sm text-muted-foreground">
                            تذكرني
                        </label>
                    </div>

                    <x-ui.button
                        type="submit"
                        class="w-full bg-primary hover:bg-primary/90 text-primary-foreground font-bold"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove wire:target="login">
                            <svg class="ml-2 h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            تسجيل الدخول
                        </span>
                        <span wire:loading wire:target="login">
                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white inline-block ml-2"></div>
                            جاري تسجيل الدخول...
                        </span>
                    </x-ui.button>
                </form>
            </x-ui.card-content>
        </x-ui.card>
    </div>
</div>
