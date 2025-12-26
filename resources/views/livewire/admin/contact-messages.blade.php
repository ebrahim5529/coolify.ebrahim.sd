<div>
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-foreground mb-2">الرسائل الواردة</h1>
                <p class="text-muted-foreground">
                    إدارة وعرض جميع الرسائل الواردة
                    @if($unreadCount > 0)
                        <x-ui.badge variant="destructive" class="mr-2">{{ $unreadCount }} غير مقروءة</x-ui.badge>
                    @endif
                </p>
            </div>
        </div>

        <x-ui.card class="border-2">
            <x-ui.table>
                <x-ui.table-header>
                    <x-ui.table-row>
                        <x-ui.table-head>الاسم</x-ui.table-head>
                        <x-ui.table-head>البريد الإلكتروني</x-ui.table-head>
                        <x-ui.table-head>الرسالة</x-ui.table-head>
                        <x-ui.table-head>التاريخ</x-ui.table-head>
                        <x-ui.table-head>الحالة</x-ui.table-head>
                        <x-ui.table-head class="text-left">الإجراءات</x-ui.table-head>
                    </x-ui.table-row>
                </x-ui.table-header>
                <x-ui.table-body>
                    @if(empty($messages))
                        <x-ui.table-row>
                            <x-ui.table-cell colspan="6" class="text-center py-8 text-muted-foreground">
                                لا توجد رسائل
                            </x-ui.table-cell>
                        </x-ui.table-row>
                    @else
                        @foreach($messages as $message)
                            <x-ui.table-row class="{{ !$message['read'] ? 'bg-accent/50' : '' }}">
                                <x-ui.table-cell class="font-medium">{{ $message['name'] }}</x-ui.table-cell>
                                <x-ui.table-cell>
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $message['email'] }}</span>
                                    </div>
                                </x-ui.table-cell>
                                <x-ui.table-cell class="max-w-md truncate">{{ $message['message'] }}</x-ui.table-cell>
                                <x-ui.table-cell class="text-sm text-muted-foreground">
                                    {{ \Carbon\Carbon::parse($message['created_at'])->locale('ar')->format('Y-m-d H:i') }}
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <x-ui.badge variant="{{ $message['read'] ? 'secondary' : 'default' }}">
                                        {{ $message['read'] ? 'مقروءة' : 'جديدة' }}
                                    </x-ui.badge>
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <div class="flex items-center gap-2">
                                        <x-ui.button variant="outline" size="sm" wire:click="viewMessage({{ $message['id'] }})">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </x-ui.button>
                                        <x-ui.button variant="destructive" size="sm" wire:click="delete({{ $message['id'] }})" wire:confirm="هل أنت متأكد من حذف هذه الرسالة؟">
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
                <x-ui.dialog-title>تفاصيل الرسالة</x-ui.dialog-title>
                <x-ui.dialog-description>معلومات الرسالة الواردة</x-ui.dialog-description>
            </x-ui.dialog-header>
            @if($selectedMessage)
                <div class="space-y-4 mt-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-semibold text-muted-foreground mb-1">الاسم</p>
                            <p class="text-foreground">{{ $selectedMessage->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-muted-foreground mb-1">البريد الإلكتروني</p>
                            <p class="text-foreground">{{ $selectedMessage->email }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-muted-foreground mb-1">التاريخ</p>
                        <p class="text-foreground">{{ \Carbon\Carbon::parse($selectedMessage->created_at)->locale('ar')->format('Y-m-d H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-muted-foreground mb-1">الرسالة</p>
                        <p class="text-foreground whitespace-pre-wrap bg-accent p-4 rounded-lg">{{ $selectedMessage->message }}</p>
                    </div>
                    @if(!$selectedMessage->read)
                        <x-ui.button wire:click="markAsRead({{ $selectedMessage->id }})" class="w-full">
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            تحديد كمقروءة
                        </x-ui.button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
