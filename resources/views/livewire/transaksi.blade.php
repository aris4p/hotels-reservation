<div>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ $title }}</span></h4>
                    @include('layout.partials_admin.pesanerror')
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    
                    @endif
                    {{-- <div class="row">
                        <!-- Form controls -->
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Kamar</label>
                                        <input type="text" class="form-control" id="namaKamar" wire:model="nama" placeholder="Nama Kamar" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tipe Kamar</label>
                                        <input type="text" class="form-control" id="tipeKamar" wire:model="tipe" placeholder="Tipe Kamar" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Harga Kamar</label>
                                        <input type="number" class="form-control" id="hargaKamar" wire:model="harga" placeholder="Harga Kamar" />
                                    </div>
                                    <div class="mb-3">
                                        @if ($updateData == false)
                                        <button type="button" wire:click="simpan()" class="btn btn-primary">Simpan</button>
                                        @else
                                        <button type="button" wire:click="update()" class="btn btn-primary">Update</button>
                                        @endif
                                        <button type="button" wire:click="clear()" class="btn btn-info">koreksi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card">
                        <h5 class="card-header">Daftar {{ $title }}</h5>
                        <div class="pb-3 pt-3">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTransaksi" >Buat Transaksi Baru</button>
                            <button class="btn btn-success" wire:click="exportPdf" >Cetak Transaksi</button>
                        </div>
                        <div class="pb-3 pt-3">
                            <input type="text" class="form-control mb-3 w-25" placeholder="Cari.." name="search" wire:model.live="query">
                        </div>


                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-sortable">
                                <thead>
                                    <tr>
                                        <th class="sort">No</th>
                                        <th class="sort">No Transaksi</th>
                                        <th class="sort">Nama Pelanggan</th>
                                        <th class="sort">Kamar</th>
                                        <th class="sort">Harga</th>
                                        <th class="sort">Jumlah</th>
                                        <th class="sort">Checkin</th>
                                        <th class="sort">Checkout</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data as $key => $value)
                                    <tr>
                                        <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>{{ $data->firstItem() + $key}}</strong></td>
                                        <td>{{ $value->notrx }}</td>
                                        <td>{{ $value->pelanggan->nama }}</span></td>
                                        <td>{{ $value->kamar->nama }}</span></td>
                                        <td>{{ $value->harga }}</span></td>
                                        <td>{{ $value->jumlah }}</span></td>
                                        <td>{{ $value->tglCheckin }}</span></td>
                                        <td>{{ $value->tglCheckout }}</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item" wire:click="edit({{  $value->id}})"><i class="bx bx-edit-alt me-2"></i> Edit</button>
                                                    <button class="dropdown-item" wire:click="confirm_delete({{  $value->id}})" data-bs-toggle="modal" data-bs-target="#modalToggle"><i class="bx bx-trash me-2"></i> Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <div wire:ignore.self class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">Konfirmasi Hapus</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Yakin Menghapus data???</div>
            <div class="modal-footer">
                <button  class="btn btn-info type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tidak
                </button>
              <button wire:click="delete()" class="btn btn-danger" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                Hapus
              </button>
            </div>
          </div>
        </div>
      </div>
    <div wire:ignore.self class="modal fade" id="modalTransaksi" aria-labelledby="modalToggleTransaksi" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleTransaksi">Transaksi Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modalTrx" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card mb-4">
                      <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlReadOnlyInput1" class="form-label">No Transaksi</label>
                            <input wire:model="noTrx" class="form-control" type="text" id="notrx" placeholder="Notrx"  readonly="">
                          </div>
                        <div class="m5-3">
                            <label for="exampleFormControlReadOnlyInput1" class="form-label">Cari Pelanggan</label>
                            <input wire:model="searchpelanggan" class="form-control" type="text" id="searchpelanggan" placeholder="nik">
                            <button wire:click="cariPelanggan">Cari</button>
                          </div>
                          <div class="mb-3">
                            <label for="namapelanggan" class=" col-form-label">Nama Pelanggan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Nama Pelanggan" wire:model="pelanggan" readonly="">
                            </div>
                            
                          </div>

                          <div class="mt-3">
                            <label for="exampleFormControlReadOnlyInput1" class="form-label">Cari Kamar</label>
                            <input wire:model="searchkamar" class="form-control" type="text" id="searchkamar" placeholder="id Kamar">
                            <button wire:click="cariKamar">Cari</button>
                          </div>
                          <div class="mb-3">
                            <label for="kamar" class=" col-form-label">Kamar</label>
                            <div class="col-md-12">
                              <input wire:model="namakamar" class="form-control" type="search" placeholder="Cari" id="kamar" readonly="">
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlReadOnlyInput1" class="form-label">Harga</label>
                            <input wire:model="hargakamar"  class="form-control" type="text" id="harga" placeholder="harga" readonly="">
                          </div>
                          <div class="mb-3">
                              <label for="checkin" class="form-label">Check In</label>
                              <input wire:model="checkin" wire:change="hitungTotalHarga" class="form-control" type="datetime-local" id="checkin">

                            </div>
                            <div class="mb-3">
                                <label for="checkout" class="form-label">Check Out</label>
                                <input wire:model="checkout" wire:change="hitungTotalHarga" class="form-control" type="datetime-local" id="checkout">
                            </div>
                            <div class="mb-3">
                              <label for="exampleFormControlReadOnlyInput1" class="form-label">Jumlah</label>
                              <input wire:model="jumlah" class="form-control" type="number" id="jumlah" placeholder="jumlah"  readonly="">
                            </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-info type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
              <button wire:click="simpan()" class="btn btn-danger" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                Simpan
              </button>
            </div>
          </div>
        </div>
      </div>
    
</div>

