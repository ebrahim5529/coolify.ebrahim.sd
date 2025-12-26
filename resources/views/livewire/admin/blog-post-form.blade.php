<div>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-foreground mb-2">
                    {{ $postId ? 'تعديل المقال' : 'إضافة مقال جديد' }}
                </h1>
                <p class="text-muted-foreground">
                    {{ $postId ? 'قم بتعديل بيانات المقال' : 'املأ البيانات التالية لإضافة مقال جديد' }}
                </p>
            </div>
            <x-ui.button variant="outline" onclick="window.location.href='{{ route('admin.blog') }}'">
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                العودة إلى القائمة
            </x-ui.button>
        </div>

        <!-- Form -->
        <x-ui.card class="border-2">
            <form wire:submit="save" class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="title">العنوان <span class="text-destructive">*</span></x-ui.label>
                        <x-ui.input id="title" wire:model="formData.title" placeholder="عنوان المقال" required />
                        @error('formData.title') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="slug">الرابط (Slug) <span class="text-destructive">*</span></x-ui.label>
                        <x-ui.input id="slug" wire:model="formData.slug" placeholder="article-slug" dir="ltr" required />
                        @error('formData.slug') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <x-ui.label for="description">الوصف <span class="text-destructive">*</span></x-ui.label>
                    <x-ui.textarea id="description" wire:model="formData.description" placeholder="وصف مختصر للمقال" rows="3" required />
                    @error('formData.description') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <x-ui.label for="content">المحتوى <span class="text-destructive">*</span></x-ui.label>
                    <div wire:ignore>
                        <textarea id="summernote" class="summernote" wire:model="formData.content">{{ $formData['content'] ?? '' }}</textarea>
                    </div>
                    @error('formData.content') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="image">رابط الصورة</x-ui.label>
                        <x-ui.input id="image" wire:model="formData.image" placeholder="https://example.com/image.jpg" dir="ltr" />
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="category">الفئة <span class="text-destructive">*</span></x-ui.label>
                        <x-ui.input id="category" wire:model="formData.category" placeholder="تطوير الويب" required />
                        @error('formData.category') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="date">التاريخ <span class="text-destructive">*</span></x-ui.label>
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

                <div class="flex justify-end gap-2 pt-4 border-t border-border">
                    <x-ui.button type="button" variant="outline" onclick="window.location.href='{{ route('admin.blog') }}'">
                        إلغاء
                    </x-ui.button>
                    <x-ui.button type="submit">
                        {{ $postId ? 'تحديث المقال' : 'إضافة المقال' }}
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            function initSummernote() {
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
                
                // Get initial content from Livewire component
                const livewireComponent = @this;
                const initialContent = livewireComponent ? (livewireComponent.get('formData.content') || '') : '';
                
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
                            if (livewireComponent) {
                                livewireComponent.set('formData.content', contents);
                            }
                        },
                        onInit: function() {
                            if (initialContent) {
                                editor.summernote('code', initialContent);
                            }
                        }
                    }
                });
            }

            // Initialize on mount
            Livewire.hook('morph.updated', () => {
                setTimeout(() => {
                    if ($('#summernote').length && $('#summernote').is(':visible')) {
                        if (!$('#summernote').next('.note-editor').length) {
                            initSummernote();
                        }
                    }
                }, 500);
            });

            // Initialize immediately
            setTimeout(initSummernote, 500);
        });
    </script>
</div>




