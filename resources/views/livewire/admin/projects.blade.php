<div>
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-foreground mb-2">إدارة المشاريع</h1>
                <p class="text-muted-foreground">إدارة وعرض جميع المشاريع</p>
            </div>
            <x-ui.button wire:click="openDialog">
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                إضافة مشروع جديد
            </x-ui.button>
        </div>

        <x-ui.card class="border-2">
            <x-ui.table>
                <x-ui.table-header>
                    <x-ui.table-row>
                        <x-ui.table-head>الترتيب</x-ui.table-head>
                        <x-ui.table-head>الصورة</x-ui.table-head>
                        <x-ui.table-head>العنوان</x-ui.table-head>
                        <x-ui.table-head>الوصف</x-ui.table-head>
                        <x-ui.table-head>التقنيات</x-ui.table-head>
                        <x-ui.table-head class="text-left">الإجراءات</x-ui.table-head>
                    </x-ui.table-row>
                </x-ui.table-header>
                <x-ui.table-body>
                    @if(empty($projects))
                        <x-ui.table-row>
                            <x-ui.table-cell colspan="6" class="text-center py-8 text-muted-foreground">
                                لا توجد مشاريع
                            </x-ui.table-cell>
                        </x-ui.table-row>
                    @else
                        @foreach($projects as $project)
                            <x-ui.table-row>
                                <x-ui.table-cell>{{ $project['order'] ?? 0 }}</x-ui.table-cell>
                                <x-ui.table-cell>
                                    @if(!empty($project['image']))
                                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <div class="w-16 h-16 bg-muted rounded"></div>
                                    @endif
                                </x-ui.table-cell>
                                <x-ui.table-cell class="font-medium">{{ $project['title'] }}</x-ui.table-cell>
                                <x-ui.table-cell class="max-w-md truncate">{{ $project['description'] }}</x-ui.table-cell>
                                <x-ui.table-cell>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($project['technologies'] ?? [], 0, 2) as $tech)
                                            <x-ui.badge variant="outline" class="text-xs">{{ $tech }}</x-ui.badge>
                                        @endforeach
                                        @if(count($project['technologies'] ?? []) > 2)
                                            <span class="text-xs text-muted-foreground">+{{ count($project['technologies']) - 2 }}</span>
                                        @endif
                                    </div>
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <div class="flex items-center gap-2">
                                        <x-ui.button variant="outline" size="sm" wire:click="openDialog({{ $project['id'] }})">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </x-ui.button>
                                        <x-ui.button variant="destructive" size="sm" wire:click="delete({{ $project['id'] }})" wire:confirm="هل أنت متأكد من حذف هذا المشروع؟">
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
        x-data="{ open: @entangle('isDialogOpen') }"
        x-show="open"
        x-cloak
        @keydown.escape.window="open = false"
        class="fixed inset-0 z-50 flex items-center justify-center"
        style="display: none;"
    >
        <div @click="open = false" class="fixed inset-0 bg-black/50"></div>
        <div 
            @click.away="open = false"
            class="relative z-50 w-full max-w-3xl max-h-[90vh] overflow-y-auto bg-card rounded-lg shadow-lg border border-border p-6"
        >
            <x-ui.dialog-header>
                <x-ui.dialog-title>
                    {{ $editingProject ? 'تعديل المشروع' : 'إضافة مشروع جديد' }}
                </x-ui.dialog-title>
                <x-ui.dialog-description>
                    {{ $editingProject ? 'قم بتعديل بيانات المشروع' : 'املأ البيانات التالية لإضافة مشروع جديد' }}
                </x-ui.dialog-description>
            </x-ui.dialog-header>
            <form wire:submit="save" class="space-y-4 mt-4">
                <div class="space-y-2">
                    <x-ui.label for="title">العنوان</x-ui.label>
                    <x-ui.input id="title" wire:model="formData.title" placeholder="عنوان المشروع" required />
                    @error('formData.title') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <x-ui.label for="description">الوصف</x-ui.label>
                    <x-ui.textarea id="description" wire:model="formData.description" placeholder="وصف المشروع" rows="4" required />
                    @error('formData.description') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <x-ui.label for="image">رابط الصورة</x-ui.label>
                    <x-ui.input id="image" wire:model="formData.image" placeholder="https://example.com/image.jpg" dir="ltr" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="demo_url">رابط العرض</x-ui.label>
                        <x-ui.input id="demo_url" wire:model="formData.demo_url" placeholder="https://demo.example.com" dir="ltr" />
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="github_url">رابط GitHub</x-ui.label>
                        <x-ui.input id="github_url" wire:model="formData.github_url" placeholder="https://github.com/user/repo" dir="ltr" />
                    </div>
                </div>

                <div class="space-y-2">
                    <x-ui.label>التقنيات المستخدمة</x-ui.label>
                    <div class="flex gap-2">
                        <x-ui.input wire:model="techInput" placeholder="أضف تقنية واضغط Enter" />
                        <x-ui.button type="button" wire:click="addTech">إضافة</x-ui.button>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($formData['technologies'] ?? [] as $index => $tech)
                            <x-ui.badge variant="outline" class="flex items-center gap-2">
                                {{ $tech }}
                                <button type="button" wire:click="removeTech({{ $index }})" class="text-muted-foreground hover:text-foreground">×</button>
                            </x-ui.badge>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-2">
                    <x-ui.label for="order">الترتيب</x-ui.label>
                    <x-ui.input id="order" type="number" wire:model="formData.order" placeholder="0" />
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <x-ui.button type="button" variant="outline" wire:click="closeDialog">إلغاء</x-ui.button>
                    <x-ui.button type="submit">{{ $editingProject ? 'تحديث' : 'إضافة' }}</x-ui.button>
                </div>
            </form>
        </div>
    </div>
</div>
