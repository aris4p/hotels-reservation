<?php

namespace App\Livewire;

use App\Models\Kamar as ModelKamar;
use Livewire\Component;
use Livewire\WithPagination;

class Kamar extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $title = 'Kamar';
    public $nama;
    public $tipe;
    public $harga;
    public $pesan = '';
    public $updateData = false;
    public $kamarID;
    public $query;

    public function simpan()
    {
        $rules = [
            'nama' => 'required',
            'tipe' => 'required',
            'harga' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Wajib Diisi',
            'tipe.required' => 'Tipe Wajib Diisi',
            'harga.required' => 'Harga Wajib Diisi',
        ];

        $validate = $this->validate($rules,$pesan);

        ModelKamar::create($validate);

        session()->flash('message', 'Data Berhasil Ditambahkan');
        $this->clear();
 
    }

    public function edit($id)
    {
        $data = ModelKamar::find($id);

        $this->nama = $data->nama;
        $this->tipe = $data->tipe;
        $this->harga = $data->harga;

        $this->updateData = true;
        $this->kamarID = $id;
    }

    public function update()
    {
        $rules = [
            'nama' => 'required',
            'tipe' => 'required',
            'harga' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Wajib Diisi',
            'tipe.required' => 'Tipe Wajib Diisi',
            'harga.required' => 'Harga Wajib Diisi',
        ];

        $validate = $this->validate($rules,$pesan);
        $data = ModelKamar::find($this->kamarID);
        $data->update($validate);

        session()->flash('message', 'Data Berhasil Diupdate');
        $this->clear();
    }

    public function confirm_delete($id)
    {
        $this->kamarID = $id;
    }

    public function delete()
    {
        $id =  $this->kamarID;
       $data = ModelKamar::find($id);
       $data->delete();
       session()->flash('message', 'Data Berhasil Dihapus');
       $this->clear();
    }

    public function clear()
    {
        $this->nama ='';
        $this->tipe = '';
        $this->harga = '';

        $this->updateData = false;
        $this->kamarID = '';
    }

    public function render()
    {
        if($this->query != null){
            $data = ModelKamar::where('nama','like','%'.$this->query.'%')
            ->orWhere('tipe','like','%'.$this->query.'%')
            ->orderBy('nama', 'asc')->paginate(5);
        }else{
            $data = ModelKamar::orderBy('nama', 'asc')->paginate(5);
        }

        return view('livewire.kamar',compact('data'))
        ->title('Kamar')
        ->layout('components.layouts.kamar'); 
; 
    }
}
