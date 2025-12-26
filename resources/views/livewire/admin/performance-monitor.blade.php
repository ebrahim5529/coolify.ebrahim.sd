<div>
    <div class="space-y-6" x-data="performanceMonitor()">
        <div>
            <h1 class="text-3xl font-bold text-foreground mb-2">قياس أداء Backend API</h1>
            <p class="text-muted-foreground">
                اختبار سرعة تحميل البيانات من Backend على مختلف الأجهزة
            </p>
        </div>

        <x-ui.card class="border-2">
            <x-ui.card-header>
                <x-ui.card-title class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    معلومات الجهاز
                </x-ui.card-title>
            </x-ui.card-header>
            <x-ui.card-content>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-muted rounded-lg">
                        <div class="text-sm text-muted-foreground">نوع الجهاز</div>
                        <div class="text-lg font-semibold" x-text="deviceInfo.typeText"></div>
                    </div>
                    <div class="p-4 bg-muted rounded-lg">
                        <div class="text-sm text-muted-foreground">حجم الشاشة</div>
                        <div class="text-lg font-semibold" x-text="deviceInfo.screenSize"></div>
                    </div>
                    <div class="p-4 bg-muted rounded-lg">
                        <div class="text-sm text-muted-foreground">نوع الاتصال</div>
                        <div class="text-lg font-semibold" x-text="deviceInfo.connection"></div>
                    </div>
                </div>
            </x-ui.card-content>
        </x-ui.card>

        <x-ui.card class="border-2">
            <x-ui.card-header>
                <x-ui.card-title>اختبار الأداء</x-ui.card-title>
                <x-ui.card-description>
                    Backend URL: {{ config('app.url') }}/api
                </x-ui.card-description>
            </x-ui.card-header>
            <x-ui.card-content class="space-y-6">
                <x-ui.button 
                    @click="runTest()" 
                    :disabled="isRunning"
                    class="w-full"
                    size="lg"
                >
                    <span x-show="!isRunning">
                        <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        بدء اختبار الأداء
                    </span>
                    <span x-show="isRunning">
                        <svg class="w-4 h-4 ml-2 inline animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        جاري الاختبار...
                    </span>
                </x-ui.button>

                <!-- الإحصائيات -->
                <div x-show="stats" class="space-y-4">
                    <x-ui.card>
                        <x-ui.card-header>
                            <x-ui.card-title>الإحصائيات العامة</x-ui.card-title>
                        </x-ui.card-header>
                        <x-ui.card-content>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="text-center p-4 bg-muted rounded-lg">
                                    <div class="text-2xl font-bold text-primary" x-text="stats?.successRate + '%'"></div>
                                    <div class="text-sm text-muted-foreground">معدل النجاح</div>
                                </div>
                                <div class="text-center p-4 bg-muted rounded-lg">
                                    <div class="text-2xl font-bold text-primary" x-text="formatDuration(stats?.averageDuration)"></div>
                                    <div class="text-sm text-muted-foreground">متوسط الوقت</div>
                                </div>
                                <div class="text-center p-4 bg-muted rounded-lg">
                                    <div class="text-2xl font-bold text-primary" x-text="formatDuration(stats?.minDuration)"></div>
                                    <div class="text-sm text-muted-foreground">أسرع استجابة</div>
                                </div>
                                <div class="text-center p-4 bg-muted rounded-lg">
                                    <div class="text-2xl font-bold text-primary" x-text="formatDataSize(stats?.totalDataSize)"></div>
                                    <div class="text-sm text-muted-foreground">إجمالي البيانات</div>
                                </div>
                            </div>
                        </x-ui.card-content>
                    </x-ui.card>

                    <!-- نتائج الاختبار -->
                    <x-ui.card>
                        <x-ui.card-header>
                            <x-ui.card-title>نتائج الاختبار</x-ui.card-title>
                        </x-ui.card-header>
                        <x-ui.card-content>
                            <div class="space-y-4">
                                <template x-for="(metric, index) in metrics" :key="index">
                                    <div class="p-4 border rounded-lg space-y-2">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-2">
                                                <svg x-show="metric.success" class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <svg x-show="!metric.success" class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="font-semibold" x-text="metric.endpoint"></span>
                                                <x-ui.badge :variant="metric.success ? 'default' : 'destructive'" x-text="metric.status || 'خطأ'"></x-ui.badge>
                                            </div>
                                            <div class="font-bold" :class="getDurationColor(metric.duration)" x-text="formatDuration(metric.duration)"></div>
                                        </div>
                                        
                                        <div x-show="metric.dataSize" class="flex items-center gap-2 text-sm text-muted-foreground">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            <span>حجم البيانات: <span x-text="formatDataSize(metric.dataSize)"></span></span>
                                        </div>
                                        
                                        <div x-show="metric.error" class="text-sm text-red-600">
                                            خطأ: <span x-text="metric.error"></span>
                                        </div>

                                        <div class="space-y-1">
                                            <div class="flex justify-between text-xs text-muted-foreground">
                                                <span>الوقت</span>
                                                <span x-text="formatDuration(metric.duration)"></span>
                                            </div>
                                            <div class="w-full bg-muted rounded-full h-2">
                                                <div class="bg-primary h-2 rounded-full transition-all" :style="'width: ' + Math.min((metric.duration / 2000) * 100, 100) + '%'"></div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </x-ui.card-content>
                    </x-ui.card>
                </div>
            </x-ui.card-content>
        </x-ui.card>
    </div>

    <script>
        function performanceMonitor() {
            return {
                isRunning: false,
                metrics: [],
                stats: null,
                deviceInfo: {
                    typeText: '💻 سطح مكتب',
                    screenSize: window.innerWidth + ' × ' + window.innerHeight,
                    connection: 'غير معروف'
                },

                init() {
                    this.updateDeviceInfo();
                    window.addEventListener('resize', () => this.updateDeviceInfo());
                    
                    // Get connection info
                    if (navigator.connection) {
                        const conn = navigator.connection;
                        this.deviceInfo.connection = conn.effectiveType || 'غير معروف';
                        if (conn.downlink) {
                            this.deviceInfo.connection += ' (' + conn.downlink + ' Mbps)';
                        }
                    }
                },

                updateDeviceInfo() {
                    const width = window.innerWidth;
                    if (width < 768) {
                        this.deviceInfo.typeText = '📱 جوال';
                    } else if (width < 1024) {
                        this.deviceInfo.typeText = '📱 لوحي';
                    } else {
                        this.deviceInfo.typeText = '💻 سطح مكتب';
                    }
                    this.deviceInfo.screenSize = width + ' × ' + window.innerHeight;
                },

                async runTest() {
                    this.isRunning = true;
                    this.metrics = [];
                    this.stats = null;

                    const API_BASE_URL = '{{ config("app.url") }}/api';
                    const endpoints = [
                        { name: '/services', url: API_BASE_URL + '/services' },
                        { name: '/technologies', url: API_BASE_URL + '/technologies' },
                        { name: '/projects', url: API_BASE_URL + '/projects' },
                        { name: '/blog', url: API_BASE_URL + '/blog' },
                    ];

                    const results = [];
                    for (const endpoint of endpoints) {
                        const startTime = performance.now();
                        try {
                            const response = await fetch(endpoint.url);
                            const endTime = performance.now();
                            const duration = endTime - startTime;
                            const text = await response.clone().text();
                            const dataSize = new Blob([text]).size;

                            results.push({
                                endpoint: endpoint.name,
                                duration: duration,
                                status: response.status,
                                success: response.ok,
                                dataSize: dataSize,
                                error: null
                            });
                        } catch (error) {
                            const endTime = performance.now();
                            results.push({
                                endpoint: endpoint.name,
                                duration: endTime - startTime,
                                status: 0,
                                success: false,
                                dataSize: 0,
                                error: error.message || 'خطأ غير معروف'
                            });
                        }
                    }

                    this.metrics = results;
                    this.stats = this.calculateStats(results);
                    this.isRunning = false;
                },

                calculateStats(results) {
                    const successful = results.filter(r => r.success);
                    const durations = successful.map(r => r.duration);
                    const totalDataSize = results.reduce((sum, r) => sum + (r.dataSize || 0), 0);

                    return {
                        successRate: (successful.length / results.length) * 100,
                        averageDuration: durations.reduce((a, b) => a + b, 0) / durations.length || 0,
                        minDuration: Math.min(...durations) || 0,
                        maxDuration: Math.max(...durations) || 0,
                        totalDataSize: totalDataSize
                    };
                },

                formatDuration(ms) {
                    if (!ms) return '0ms';
                    if (ms < 1000) return Math.round(ms) + 'ms';
                    return (ms / 1000).toFixed(2) + 's';
                },

                formatDataSize(bytes) {
                    if (!bytes) return '0 B';
                    if (bytes < 1024) return bytes + ' B';
                    if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
                    return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
                },

                getDurationColor(duration) {
                    if (duration < 500) return 'text-green-600';
                    if (duration < 1000) return 'text-yellow-600';
                    return 'text-red-600';
                }
            }
        }
    </script>
</div>
