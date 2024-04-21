<?php

namespace App\Livewire;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Kamar;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pelanggan as ModelPelanggan;
use App\Models\Transaksi as ModelsTransaksi;

class Transaksi extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $title = 'Transaksi';
    public $query;
    public $querys;
    public $transaksi;
    public $idpelanggan;
    public $idkamar;
    public $harga;
    public $jumlah;
    public $checkin;
    public $checkout;
    public $pelanggan;
    public $namakamar;
    public $hargakamar;
    public $pelanggan_id;

    public $searchpelanggan = '';
    public $searchkamar = '';
    public $selisihHari;
    
    public $noTrx;
    
    public function mount()
    {
        $currentDate = Carbon::now()->format('Ymd');
        $uniqueId = uniqid();
        $this->noTrx = 'TRX' . $currentDate . $uniqueId;
    }
    
    public function cariPelanggan()
    {
        $hasilPencarian = $this->searchpelanggan;

        // Lakukan pencarian dengan menggunakan 'like' untuk mencari substring yang cocok
        $data = ModelPelanggan::where('nik', 'like', '%' . $hasilPencarian . '%')->first();
        
        // Jika ada hasil pencarian, isi bidang 'pelanggan'
        if ($data) {
            $this->pelanggan_id = $data->id;
            $this->pelanggan = $data->nama; // Sesuaikan dengan struktur data Anda
        }
        
    }
    public function cariKamar()
    {
        $hasilPencarian = $this->searchkamar;



        // Lakukan pencarian dengan menggunakan 'like' untuk mencari substring yang cocok
        $data = Kamar::where('id', 'like', '%' . $hasilPencarian . '%')->first();
        
        // Jika ada hasil pencarian, isi bidang 'pelanggan'
        if ($data) {
            $this->namakamar = $data->nama; // Sesuaikan dengan struktur data Anda
            $this->hargakamar = $data->harga; // Sesuaikan dengan struktur data Anda
             // Set nilai searchkamar ke id kamar yang dipilih
            $this->searchkamar = $data->id;
        }
        
    }

    public function hitungTotalHarga()
{
    // Hitung selisih hari antara tanggal check-in dan check-out
    $selisihHari = \Carbon\Carbon::parse($this->checkin)->diffInDays(\Carbon\Carbon::parse($this->checkout));
    
    $id = $this->searchkamar;
    // Ambil harga kamar per hari dari database berdasarkan id kamar
    $kamar = Kamar::find($id);
    $hargaPerHari = $kamar->harga;
    
    // Hitung total jumlah harga
    $totalHarga = $selisihHari * $hargaPerHari;
    
    // Isi properti jumlah dengan total jumlah harga
    $this->jumlah = $totalHarga;
    $this->selisihHari = $selisihHari;
}


public function simpan()
{
    $rules = [
        'noTrx' => 'required',
        'pelanggan' => 'required',
        'hargakamar' => 'required',
    ];


    $validate = $this->validate($rules);

    $transaksi = new \App\Models\Transaksi;
    $transaksi->notrx = $this->noTrx; 
    $transaksi->pelanggan_id = $this->pelanggan_id; 
    $transaksi->kamar_id = $this->searchkamar;
    $transaksi->harga = $this->jumlah;
    $transaksi->jumlah = $this->selisihHari; 
    $transaksi->tglCheckin = $this->checkin; 
    $transaksi->tglCheckout = $this->checkout; 
    $transaksi->save();


    session()->flash('message', 'Data Berhasil Ditambahkan');

}

public function exportPdf()
    {
      // Ambil data yang ingin diekspor (misalnya dari model)
      $data = ModelsTransaksi::all();

      $options = new Options();
      $options->set('isHtml5ParserEnabled', true);
      $options->set('isRemoteEnabled', true);
      $options->set('isPhpEnabled', true);
      $options->set('defaultFont', 'Arial');
      $options->set('orientation', 'landscape'); // Set orientasi ke landscape
      $dompdf = new Dompdf($options);

      // Buat HTML untuk dokumen PDF
      $html = view('livewire.cetak_transaksi', compact('data'))->render();

      // Muat HTML ke Dompdf
      $dompdf->loadHtml($html);

      // Render PDF
      $dompdf->render();

      // Simpan PDF ke server
      $output = $dompdf->output();
      $file = 'data.pdf';
      file_put_contents($file, $output);

      // Berikan tautan unduh ke pengguna
      return response()->download($file)->deleteFileAfterSend(true);
    }

    
    public function render()
    {
        
        
        if($this->querys != null){
            $data = ModelsTransaksi::where('notrx','like','%'.$this->querys.'%')
            ->orWhere('tipe','like','%'.$this->querys.'%')
            ->orderBy('notrx', 'asc')->paginate(5);
        }else{
            $data = ModelsTransaksi::orderBy('notrx', 'asc')->paginate(5);
        }
        return view('livewire.transaksi',compact('data'))
        ->title('Transaksi')
        ->layout('components.layouts.transaksi'); ;;
    }
}
