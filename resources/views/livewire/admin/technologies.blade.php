<div>
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-foreground mb-2">إدارة التقنيات</h1>
                <p class="text-muted-foreground">إدارة وعرض جميع التقنيات المستخدمة</p>
            </div>
            <x-ui.button wire:click="openDialog">
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                إضافة تقنية جديدة
            </x-ui.button>
        </div>

        <x-ui.card class="border-2">
            <x-ui.table>
                <x-ui.table-header>
                    <x-ui.table-row>
                        <x-ui.table-head>الترتيب</x-ui.table-head>
                        <x-ui.table-head>الأيقونة</x-ui.table-head>
                        <x-ui.table-head>الاسم</x-ui.table-head>
                        <x-ui.table-head>الفئة</x-ui.table-head>
                        <x-ui.table-head>اللون</x-ui.table-head>
                        <x-ui.table-head class="text-left">الإجراءات</x-ui.table-head>
                    </x-ui.table-row>
                </x-ui.table-header>
                <x-ui.table-body>
                    @if(empty($technologies))
                        <x-ui.table-row>
                            <x-ui.table-cell colspan="6" class="text-center py-8 text-muted-foreground">
                                لا توجد تقنيات
                            </x-ui.table-cell>
                        </x-ui.table-row>
                    @else
                        @foreach($technologies as $tech)
                            <x-ui.table-row>
                                <x-ui.table-cell>{{ $tech['order'] ?? 0 }}</x-ui.table-cell>
                                <x-ui.table-cell>
                                    @if(!empty($tech['icon']))
                                        <img src="{{ $tech['icon'] }}" alt="{{ $tech['name'] }}" class="w-8 h-8 object-contain">
                                    @else
                                        <svg class="h-8 w-8 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                        </svg>
                                    @endif
                                </x-ui.table-cell>
                                <x-ui.table-cell class="font-medium">{{ $tech['name'] }}</x-ui.table-cell>
                                <x-ui.table-cell>{{ $tech['category'] ?? '-' }}</x-ui.table-cell>
                                <x-ui.table-cell>
                                    <div class="w-6 h-6 rounded-full border border-border" style="background-color: {{ $tech['color'] ?? '#000000' }}"></div>
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <div class="flex items-center gap-2">
                                        <x-ui.button variant="outline" size="sm" wire:click="openDialog({{ $tech['id'] }})">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </x-ui.button>
                                        <x-ui.button variant="destructive" size="sm" wire:click="delete({{ $tech['id'] }})" wire:confirm="هل أنت متأكد من حذف هذه التقنية؟">
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
            class="relative z-50 w-full max-w-2xl bg-card rounded-lg shadow-lg border border-border p-6"
        >
            <x-ui.dialog-header>
                <x-ui.dialog-title>
                    {{ $editingTech ? 'تعديل التقنية' : 'إضافة تقنية جديدة' }}
                </x-ui.dialog-title>
                <x-ui.dialog-description>
                    {{ $editingTech ? 'قم بتعديل بيانات التقنية' : 'املأ البيانات التالية لإضافة تقنية جديدة' }}
                </x-ui.dialog-description>
            </x-ui.dialog-header>
            <form wire:submit="save" class="space-y-4 mt-4">
                <div class="space-y-2">
                    <x-ui.label for="name">الاسم</x-ui.label>
                    <x-ui.input id="name" wire:model="formData.name" placeholder="React" required />
                    @error('formData.name') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <x-ui.label for="icon">رابط الأيقونة</x-ui.label>
                    <x-ui.input id="icon" wire:model="formData.icon" placeholder="https://example.com/icon.svg" dir="ltr" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <x-ui.label for="category">الفئة</x-ui.label>
                        <x-ui.input id="category" wire:model="formData.category" placeholder="Frontend" />
                    </div>
                    <div class="space-y-2">
                        <x-ui.label for="color">اللون</x-ui.label>
                        <div class="flex gap-2">
                            <input type="color" id="color" wire:model="formData.color" class="w-20 h-10 rounded border border-input">
                            <x-ui.input wire:model="formData.color" placeholder="#000000" dir="ltr" />
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-ui.label for="order">الترتيب</x-ui.label>
                    <x-ui.input id="order" type="number" wire:model="formData.order" placeholder="0" />
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <x-ui.button type="button" variant="outline" wire:click="closeDialog">إلغاء</x-ui.button>
                    <x-ui.button type="submit">{{ $editingTech ? 'تحديث' : 'إضافة' }}</x-ui.button>
                </div>
            </form>
        </div>
    </div>
</div>
