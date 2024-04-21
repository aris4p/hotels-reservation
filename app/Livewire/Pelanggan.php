<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pelanggan as ModelPelanggan;
use Livewire\WithPagination;

class Pelanggan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $title = 'Kamar';
    public $query;



    public function render()
    {
        if($this->query != null){
            $data = ModelPelanggan::where('nama','like','%'.$this->query.'%')
            ->orWhere('tipe','like','%'.$this->query.'%')
            ->orderBy('nama', 'asc')->paginate(5);
        }else{
            $data = ModelPelanggan::orderBy('nama', 'asc')->paginate(5);
        }
        return view('livewire.pelanggan',compact('data'))
        ->title('Pelanggan')
        ->layout('components.layouts.pelanggan'); ;
    }
}
