<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;
use Livewire\Attributes\Validate;

class Contact extends Component
{
    #[Validate('required|min:3')]
    public $name = '';
    
    #[Validate('required|email')]
    public $email = '';
    
    #[Validate('required|min:10')]
    public $message = '';
    
    public $isSubmitting = false;

    public function submit()
    {
        $this->validate();
        
        $this->isSubmitting = true;
        
        try {
            ContactMessage::create([
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
            ]);
            
            session()->flash('success', 'شكراً لتواصلك! سأرد عليك في أقرب وقت.');
            
            $this->reset(['name', 'email', 'message']);
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء إرسال الرسالة: ' . $e->getMessage());
        } finally {
            $this->isSubmitting = false;
        }
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
