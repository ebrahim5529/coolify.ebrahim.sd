<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ContactMessage;

class ContactMessages extends Component
{
    public $messages = [];
    public $isDialogOpen = false;
    public $selectedMessage = null;

    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = ContactMessage::latest()->get()->toArray();
    }

    public function viewMessage($messageId)
    {
        $this->selectedMessage = ContactMessage::find($messageId);
        if (!$this->selectedMessage->read) {
            $this->selectedMessage->update(['read' => true]);
            $this->loadMessages();
        }
        $this->isDialogOpen = true;
    }

    public function closeDialog()
    {
        $this->isDialogOpen = false;
        $this->selectedMessage = null;
    }

    public function markAsRead($id)
    {
        ContactMessage::findOrFail($id)->update(['read' => true]);
        $this->loadMessages();
        if ($this->selectedMessage && $this->selectedMessage->id == $id) {
            $this->selectedMessage->read = true;
        }
        session()->flash('message', 'تم تحديد الرسالة كمقروءة');
    }

    public function delete($id)
    {
        ContactMessage::findOrFail($id)->delete();
        $this->loadMessages();
        if ($this->selectedMessage && $this->selectedMessage->id == $id) {
            $this->closeDialog();
        }
        session()->flash('message', 'تم حذف الرسالة بنجاح');
    }

    public function render()
    {
        $unreadCount = ContactMessage::where('read', false)->count();
        
        return view('livewire.admin.contact-messages', [
            'unreadCount' => $unreadCount,
        ])->layout('layouts.admin', [
            'title' => 'الرسائل الواردة - لوحة التحكم',
        ]);
    }
}
