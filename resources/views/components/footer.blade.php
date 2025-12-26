@php
$currentYear = date('Y');
@endphp

<footer class="gradient-bg text-primary-foreground py-12">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8 mb-8">
            <!-- Brand -->
            <div>
                <h3 class="text-2xl font-bold mb-4">إبراهيم</h3>
                <p class="text-primary-foreground/80">
                    مطور ويب محترف متخصص في تصميم وتطوير الحلول البرمجية المتكاملة
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-xl font-bold mb-4">روابط سريعة</h4>
                <ul class="space-y-2 text-primary-foreground/80">
                    <li>
                        <a href="#services" class="hover:text-secondary transition-colors">
                            الخدمات
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="hover:text-secondary transition-colors">
                            نبذة عني
                        </a>
                    </li>
                    <li>
                        <a href="/blog" class="hover:text-secondary transition-colors">
                            المدونة
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="hover:text-secondary transition-colors">
                            تواصل معي
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Social Links -->
            <div>
                <h4 class="text-xl font-bold mb-4">تواصل معي</h4>
                <div class="flex gap-4">
                    <a 
                        href="https://wa.me/249111638872" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="p-3 bg-primary-foreground/10 hover:bg-secondary rounded-lg transition-all duration-300 hover:scale-110"
                        aria-label="واتساب"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </a>
                    <a 
                        href="mailto:ibrahim@example.com"
                        class="p-3 bg-primary-foreground/10 hover:bg-secondary rounded-lg transition-all duration-300 hover:scale-110"
                        aria-label="البريد الإلكتروني"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-primary-foreground/20 pt-8 text-center text-primary-foreground/70">
            <p>
                © {{ $currentYear }} إبراهيم. جميع الحقوق محفوظة.
            </p>
        </div>
    </div>
</footer>

