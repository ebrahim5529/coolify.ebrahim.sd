<div>
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-foreground mb-2">إدارة المدونة</h1>
                <p class="text-muted-foreground">إدارة وعرض جميع مقالات المدونة</p>
            </div>
            <x-ui.button wire:click="openModal">
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                إضافة مقال جديد
            </x-ui.button>
        </div>

        <x-ui.card class="border-2">
            <x-ui.table>
                <x-ui.table-header>
                    <x-ui.table-row>
                        <x-ui.table-head>العنوان</x-ui.table-head>
                        <x-ui.table-head>الفئة</x-ui.table-head>
                        <x-ui.table-head>التاريخ</x-ui.table-head>
                        <x-ui.table-head>الحالة</x-ui.table-head>
                        <x-ui.table-head class="text-left">الإجراءات</x-ui.table-head>
                    </x-ui.table-row>
                </x-ui.table-header>
                <x-ui.table-body>
                    @if(empty($posts))
                        <x-ui.table-row>
                            <x-ui.table-cell colspan="5" class="text-center py-8 text-muted-foreground">
                                لا توجد مقالات
                            </x-ui.table-cell>
                        </x-ui.table-row>
                    @else
                        @foreach($posts as $post)
                            <x-ui.table-row>
                                <x-ui.table-cell class="font-medium max-w-md">{{ $post['title'] }}</x-ui.table-cell>
                                <x-ui.table-cell>
                                    <x-ui.badge variant="secondary">{{ $post['category'] ?? 'عام' }}</x-ui.badge>
                                </x-ui.table-cell>
                                <x-ui.table-cell class="text-sm text-muted-foreground">
                                    {{ $post['date'] ? \Carbon\Carbon::parse($post['date'])->locale('ar')->format('Y-m-d') : '' }}
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <x-ui.badge variant="{{ $post['published'] ? 'default' : 'secondary' }}">
                                        {{ $post['published'] ? 'منشور' : 'مسودة' }}
                                    </x-ui.badge>
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.blog.edit', $post['id']) }}" target="_blank">
                                            <x-ui.button variant="outline" size="sm">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </x-ui.button>
                                        </a>
                                        <x-ui.button variant="destructive" size="sm" wire:click="delete({{ $post['id'] }})" wire:confirm="هل أنت متأكد من حذف هذا المقال؟">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </x-ui.button>
                                    </div>
                                </x-ui.table-cell>
                            </x-ui.table-row>
                        @endforeach
                    @endif
                </x-ui.table-body>
            </x-ui.table>
        </x-ui.card>
    </div>

    <!-- Dialog -->
    <div 
        x-data="{ 
            open: @entangle('isDialogOpen'),
            init() {
                this.$watch('open', value => {
                    if (value) {
                        setTimeout(() => {
                            if (typeof window.initSummernote === 'function') {
                                window.initSummernote();
                            }
                        }, 500);
                    } else {
                        if (typeof window.destroySummernote === 'function') {
                            window.destroySummernote();
                        }
                    }
                });
            }
        }"
        x-show="open"
        x-cloak
        @keydown.escape.window="open = false"
        class="fixed inset-0 z-50 flex items-center justify-center"
        style="display: none;"
    >
        <div @click="open = false" class="fixed inset-0 bg-black/50"></div>
        <div 
            @click.away="open = false"
            class="relative z-50 w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-card rounded-lg shadow-lg border border-border p-6"
        >
            <x-ui.dialog-header>
                <x-ui.dialog-title>
                    {{ $editingPost ? 'تعديل المقال' : 'إضافة مقال جديد' }}
                </x-ui.dialog-title>
                <x-ui.dialog-description>
                    {{ $editingPost ? 'قم بتعديل بيانات المقال' : 'املأ البيانات التالية لإضافة مقال جديد' }}
                </x-ui.dialog-description>
            </x-ui.dialog-header>
            <form wire:submit="save" class="space-y-4 mt-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="title">العنوان</x-ui.label>
                        <x-ui.input id="title" wire:model="formData.title" placeholder="عنوان المقال" required />
                        @error('formData.title') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="slug">الرابط (Slug)</x-ui.label>
                        <x-ui.input id="slug" wire:model="formData.slug" placeholder="article-slug" dir="ltr" required />
                        @error('formData.slug') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <x-ui.label for="description">الوصف</x-ui.label>
                    <x-ui.textarea id="description" wire:model="formData.description" placeholder="وصف مختصر للمقال" rows="3" required />
                    @error('formData.description') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <x-ui.label for="content">المحتوى</x-ui.label>
                    <div wire:ignore>
                        <textarea id="summernote" class="summernote">{{ $formData['content'] ?? '' }}</textarea>
                    </div>
                    @error('formData.content') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="image">رابط الصورة</x-ui.label>
                        <x-ui.input id="image" wire:model="formData.image" placeholder="https://example.com/image.jpg" dir="ltr" />
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="category">الفئة</x-ui.label>
                        <x-ui.input id="category" wire:model="formData.category" placeholder="تطوير الويب" required />
                        @error('formData.category') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="date">التاريخ</x-ui.label>
                        <x-ui.input id="date" type="date" wire:model="formData.date" required />
                        @error('formData.date') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="read_time">وقت القراءة</x-ui.label>
                        <x-ui.input id="read_time" wire:model="formData.read_time" placeholder="5 دقائق" />
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="published">الحالة</x-ui.label>
                        <select id="published" wire:model="formData.published" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                            <option value="1">منشور</option>
                            <option value="0">مسودة</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-ui.label for="keywords">الكلمات المفتاحية</x-ui.label>
                    <x-ui.input id="keywords" wire:model="formData.keywords" placeholder="كلمة1, كلمة2, كلمة3" />
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <x-ui.button type="button" variant="outline" wire:click="closeDialog">إلغاء</x-ui.button>
                    <x-ui.button type="submit">{{ $editingPost ? 'تحديث' : 'إضافة' }}</x-ui.button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.initSummernote = function() {
            const editor = $('#summernote');
            if (!editor.length) return;
            
            // Destroy if already initialized
            try {
                if (editor.summernote && typeof editor.summernote === 'function') {
                    const code = editor.summernote('code');
                    if (code !== undefined && code !== null) {
                        editor.summernote('destroy');
                    }
                }
            } catch(e) {
                // Ignore
            }
            
            // Get initial content from textarea value
            const initialContent = editor.val() || '';
            
            // Initialize Summernote
            editor.summernote({
                height: 400,
                lang: 'ar-AR',
                direction: 'rtl',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('formData.content', contents);
                    },
                    onInit: function() {
                        if (initialContent) {
                            editor.summernote('code', initialContent);
                        }
                    }
                }
            });
        };

        window.destroySummernote = function() {
            const editor = $('#summernote');
            if (editor.length) {
                try {
                    if (editor.summernote) {
                        editor.summernote('destroy');
                    }
                } catch(e) {
                    // Ignore errors
                }
            }
        };

        // Listen for Livewire events
        document.addEventListener('livewire:init', () => {
            // Initialize when dialog opens
            Livewire.on('summernote-init', (data) => {
                setTimeout(() => {
                    if ($('#summernote').length && $('#summernote').is(':visible')) {
                        window.initSummernote();
                        if (data && data[0] && data[0].content) {
                            $('#summernote').summernote('code', data[0].content);
                        }
                    }
                }, 500);
            });
            
            // Update when component morphs
            Livewire.hook('morph.updated', () => {
                setTimeout(() => {
                    if ($('#summernote').length && $('#summernote').is(':visible')) {
                        if (!$('#summernote').next('.note-editor').length) {
                            window.initSummernote();
                        }
                    }
                }, 500);
            });
        });
    </script>
</div>
