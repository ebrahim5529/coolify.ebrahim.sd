<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'لوحة التحكم' }} | إبراهيم</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS (required for Summernote) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="min-h-screen bg-background">
        <!-- Admin Navbar -->
        <nav class="bg-card border-b border-border sticky top-0 z-40">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-foreground">
                            لوحة التحكم
                        </a>
                        <div class="hidden md:flex items-center gap-4">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted-foreground hover:text-foreground transition-colors">الرئيسية</a>
                            <a href="{{ route('admin.services') }}" class="text-muted-foreground hover:text-foreground transition-colors">الخدمات</a>
                            <a href="{{ route('admin.projects') }}" class="text-muted-foreground hover:text-foreground transition-colors">المشاريع</a>
                            <a href="{{ route('admin.blog') }}" class="text-muted-foreground hover:text-foreground transition-colors">المدونة</a>
                            <a href="{{ route('admin.contact') }}" class="text-muted-foreground hover:text-foreground transition-colors">الرسائل</a>
                            <a href="{{ route('admin.technologies') }}" class="text-muted-foreground hover:text-foreground transition-colors">التقنيات</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('home') }}" target="_blank" class="text-muted-foreground hover:text-foreground transition-colors text-sm">
                            عرض الموقع
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-ui.button type="submit" variant="outline" size="sm">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                تسجيل الخروج
                            </x-ui.button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            {{ $slot }}
        </main>
    </div>
    
    <!-- jQuery (required for Summernote and Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS (required for Summernote) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    @livewireScripts
    
    <!-- Initialize Toastr and Summernote -->
    <script>
        // Toastr configuration
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "rtl": true
        };

        // Show session messages with Toastr
        @if(session('message'))
            toastr.success("{{ session('message') }}", "نجح");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}", "خطأ");
        @endif

        @if(session('warning'))
            toastr.warning("{{ session('warning') }}", "تحذير");
        @endif

        @if(session('info'))
            toastr.info("{{ session('info') }}", "معلومة");
        @endif

        // Listen for Livewire events
        document.addEventListener('livewire:init', () => {
            Livewire.on('show-toast', (data) => {
                const type = data[0].type || 'success';
                const message = data[0].message || '';
                const title = data[0].title || '';
                
                if (type === 'success') {
                    toastr.success(message, title);
                } else if (type === 'error') {
                    toastr.error(message, title);
                } else if (type === 'warning') {
                    toastr.warning(message, title);
                } else if (type === 'info') {
                    toastr.info(message, title);
                }
            });
        });
    </script>
</body>
</html>

