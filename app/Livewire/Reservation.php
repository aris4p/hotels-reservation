<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Livewire\Component;

class Reservation extends Component
{
    public function render()
    {

        $data = Transaksi::with('kamar')->get();
        return view('livewire.reservation', compact('data'))
        ->title('Reservasi')
        ->layout('components.layouts.reservation'); ;;
    }
}
