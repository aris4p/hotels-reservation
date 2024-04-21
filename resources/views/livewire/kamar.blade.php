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
                    <div class="row">
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
                    </div>
                    <div class="card">
                        <h5 class="card-header">Daftar Kamar</h5>
                        <div class="pb-3 pt-3">
                                <input type="text" class="form-control mb-3 w-25" placeholder="Cari.." name="search" wire:model.live="query">
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-sortable">
                                <thead>
                                    <tr>
                                        <th class="sort">No</th>
                                        <th class="sort">Nama Kamar</th>
                                        <th class="sort">Tipe</th>
                                        <th class="sort">Harga</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data as $key => $value)
                                    <tr>
                                        <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>{{ $data->firstItem() + $key}}</strong></td>
                                        <td>{{ $value->nama }}</td>
                                        <td>{{ $value->tipe }}</span></td>
                                        <td>{{ $value->harga }}</span></td>
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
    
</div>

