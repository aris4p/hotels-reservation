<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $title = 'Dashboard';

    public function render()
    {
       
        return view('livewire.dashboard')
        ->title('Dashboard')
        ->layout('components.layouts.dashboard'); 
; 
    }
}
