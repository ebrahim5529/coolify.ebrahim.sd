<div>
    <section id="about" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12 animate-fade-in-up">
                    <h1 class="text-4xl lg:text-5xl font-bold text-foreground mb-4">
                        نبذة <span class="text-gradient">عني</span>
                    </h1>
                    <p class="text-xl text-muted-foreground">إبراهيم حمزة - متخصص في تكنولوجيا المعلومات</p>
                </div>

                @if($personalInfo)
                    <x-ui.card class="card-gradient p-6 border-2 border-border shadow-xl mb-8 animate-fade-in-up">
                        <div class="flex flex-wrap items-center justify-center gap-6 text-card-foreground">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $personalInfo->location ?? 'السودان' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <a href="tel:0900856660" class="hover:text-secondary transition-colors">0900856660</a>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:Ebrahim5529@gmail.com" class="hover:text-secondary transition-colors">Ebrahim5529@gmail.com</a>
                            </div>
                        </div>
                    </x-ui.card>

                    <x-ui.card class="card-gradient p-8 lg:p-12 border-2 border-border shadow-xl mb-8 animate-fade-in-up">
                        <div class="space-y-8">
                            <h2 class="text-3xl font-bold text-card-foreground flex items-center gap-3">
                                <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                الملخص المهني
                            </h2>

                            <!-- التعليم والشهادات -->
                            <div class="space-y-4">
                                <h3 class="text-2xl font-semibold text-card-foreground flex items-center gap-2">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    التعليم والشهادات
                                </h3>
                                <div class="bg-card/50 rounded-lg p-4 border-l-4 border-primary">
                                    <p class="text-card-foreground/90 leading-relaxed mb-3">
                                        خريج <span class="font-semibold text-primary">بكالوريوس نظم معلومات</span> و<span class="font-semibold text-primary">ماجستير تقنية معلومات</span>، حاصل على شهادات عالمية مرموقة:
                                    </p>
                                    <div class="grid md:grid-cols-2 gap-2 text-sm">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-secondary rounded-full"></span>
                                            <span>Information Technology Infrastructure Library (ITIL)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-secondary rounded-full"></span>
                                            <span>Oracle Cloud Infrastructure (OCI)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-secondary rounded-full"></span>
                                            <span>Microsoft Azure Fundamentals (AZ-900)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-secondary rounded-full"></span>
                                            <span>Scrum Foundation Professional Certificate (SFPC)</span>
                                        </div>
                                        <div class="flex items-center gap-2 md:col-span-2">
                                            <span class="w-2 h-2 bg-secondary rounded-full"></span>
                                            <span>European Computer Driving Licence (ECDL)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- المهارات التقنية -->
                            <div class="space-y-4">
                                <h3 class="text-2xl font-semibold text-card-foreground flex items-center gap-2">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                    المهارات التقنية
                                </h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div class="bg-card/50 rounded-lg p-4">
                                        <h4 class="font-semibold text-primary mb-2">تصميم واجهات الويب</h4>
                                        <p class="text-sm text-card-foreground/80">HTML • JavaScript • CSS • jQuery • Bootstrap • Tailwind CSS • React.js</p>
                                    </div>
                                    <div class="bg-card/50 rounded-lg p-4">
                                        <h4 class="font-semibold text-primary mb-2">قواعد البيانات والأدوات</h4>
                                        <p class="text-sm text-card-foreground/80">إدارة قواعد البيانات • Microsoft Excel • الحوسبة السحابية</p>
                                    </div>
                                    <div class="bg-card/50 rounded-lg p-4 md:col-span-2">
                                        <h4 class="font-semibold text-primary mb-2">الهندسة والتحليل</h4>
                                        <p class="text-sm text-card-foreground/80">هندسة البرمجيات • تحليل وتصميم النظم</p>
                                    </div>
                                </div>
                            </div>

                            <!-- أدوات UML -->
                            <div class="space-y-4">
                                <h3 class="text-2xl font-semibold text-card-foreground flex items-center gap-2">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    أدوات UML وتحليل الأنظمة
                                </h3>
                                <div class="bg-card/50 rounded-lg p-4">
                                    <p class="text-card-foreground/90 leading-relaxed mb-3">
                                        أستخدم أدوات UML لتحليل أنظمة المعلومات مع إعداد وثائق SRS شاملة:
                                    </p>
                                    <div class="grid md:grid-cols-2 gap-2 text-sm">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>مخطط حالات الاستخدام (Use Case Diagram)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>مخطط السياق (Context Diagram)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>مخطط الوظائف (Functional Decomposition)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>مخطط تدفق البيانات (Data Flow Diagram)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>مخطط تدفق العمل (Workflow/Flowchart)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>مخطط الكيانات (Class Diagram)</span>
                                        </div>
                                        <div class="flex items-center gap-2 md:col-span-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>مخطط قواعد البيانات العلائقية (Entity Relationship)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- العمل كمحلل أنظمة -->
                            <div class="space-y-4">
                                <h3 class="text-2xl font-semibold text-card-foreground flex items-center gap-2">
                                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    محلل الأنظمة والتوثيق
                                </h3>
                                <div class="bg-card/50 rounded-lg p-4">
                                    <p class="text-card-foreground/90 leading-relaxed mb-3">
                                        أعمل كمحلل أنظمة متخصص في إعداد الوثائق التقنية والإدارية:
                                    </p>
                                    <div class="grid md:grid-cols-2 gap-2 text-sm">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                            <span>متطلبات البرمجيات (SRS)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                            <span>متطلبات العمل (BRD)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                            <span>تصميم UML</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                            <span>توثيق البرمجيات</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                            <span>وثائق النطاق</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                            <span>دراسات الجدوى الفنية</span>
                                        </div>
                                        <div class="flex items-center gap-2 md:col-span-2">
                                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                            <span>تحليل البيانات (Power BI • DAX • Excel)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- الذكاء الاصطناعي -->
                            <div class="space-y-4">
                                <h3 class="text-2xl font-semibold text-card-foreground flex items-center gap-2">
                                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    حلول الذكاء الاصطناعي
                                </h3>
                                <div class="space-y-4">
                                    <!-- الأتمتة بالذكاء الاصطناعي -->
                                    <div class="bg-card/50 rounded-lg p-4">
                                        <h4 class="font-semibold text-indigo-600 mb-2 flex items-center gap-2">
                                            <span class="w-3 h-3 bg-indigo-500 rounded-full"></span>
                                            أتمتة مدعومة بالذكاء الاصطناعي
                                        </h4>
                                        <ul class="text-sm text-card-foreground/80 space-y-1">
                                            <li>• إنشاء سير عمل ذكي يتفاعل تلقائيًا مع البيانات من البريد الإلكتروني والنماذج والدردشة</li>
                                            <li>• استخدام نماذج OpenAI وHugging Face لتحليل النصوص وتلخيص المستندات</li>
                                        </ul>
                                    </div>

                                    <!-- التحليلات المتقدمة -->
                                    <div class="bg-card/50 rounded-lg p-4">
                                        <h4 class="font-semibold text-indigo-600 mb-2 flex items-center gap-2">
                                            <span class="w-3 h-3 bg-indigo-500 rounded-full"></span>
                                            تحليلات متقدمة واتخاذ القرار
                                        </h4>
                                        <ul class="text-sm text-card-foreground/80 space-y-1">
                                            <li>• تحليل البيانات بالذكاء الاصطناعي مع تقديم توصيات تلقائية</li>
                                            <li>• تنفيذ إجراءات بناءً على التحليلات والاقتراحات المدعومة بالذكاء الاصطناعي</li>
                                        </ul>
                                    </div>

                                    <!-- الروبوتات المحادثة -->
                                    <div class="bg-card/50 rounded-lg p-4">
                                        <h4 class="font-semibold text-indigo-600 mb-2 flex items-center gap-2">
                                            <span class="w-3 h-3 bg-indigo-500 rounded-full"></span>
                                            روبوتات محادثة متقدمة
                                        </h4>
                                        <ul class="text-sm text-card-foreground/80 space-y-1">
                                            <li>• تكامل مع Telegram، WhatsApp، Facebook Messenger</li>
                                            <li>• دعم الردود التلقائية على الاستفسارات المتكررة باستخدام اللغة الطبيعية (NLP)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- الاختبار الآلي -->
                            <div class="space-y-4">
                                <h3 class="text-2xl font-semibold text-card-foreground flex items-center gap-2">
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    الاختبار الآلي (Automation Testing)
                                </h3>
                                <div class="bg-card/50 rounded-lg p-4">
                                    <p class="text-card-foreground/90 leading-relaxed">
                                        أغطي جميع خطوات الاختبار الآلي من التخطيط والتنفيذ إلى تقارير النتائج وتسجيل العيوب، مع التركيز على ضمان جودة البرمجيات وجودة الأداء.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </x-ui.card>
                @endif
            </div>
        </div>
    </section>
</div>
