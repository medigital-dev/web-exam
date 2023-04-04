<div class="container-lg">
    <div class="content-header">
        <div class="card">
            <div class="card-body">
                <div class="d-flex jcustify-content-start">
                    <!-- <a class="text-black text-decoration-none m-0 ps-3 pe-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                        <i class="fa-solid fa-bars"></i>
                    </a> -->
                    <nav class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item" aria-current="page">Akun</li>
                            <li class="breadcrumb-item" aria-current="page">Akun Guru</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="card shadow w-100">
            <div class="card-header">
                <div class="btn-group mb-2" role="group">
                    <button class="btn btn-sm btn-primary" title="Tambah Akun" data-bs-toggle="modal" data-bs-target="#modalAddAkun">
                        <i class="fa-solid fa-circle-plus fa-fw"></i>
                    </button>
                    <button class="btn btn-sm btn-warning" title="Edit Akun Terpilih" id="tombolEditAkun">
                        <i class="fa-solid fa-pen fa-fw"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" title="Hapus Akun Terpilih" id="tombolHapusAkun">
                        <i class="fa-solid fa-trash fa-fw"></i>
                    </button>
                </div>
                <div class="btn-group mb-2" role="group">
                    <a href="<?= base_url('assets/download/format-import-guru.xlsx'); ?>" target="_blank" class="btn btn-sm btn-success" title="Download Format Import">
                        <i class="fa-solid fa-file-arrow-down fa-fw"></i>
                    </a>
                    <button class="btn btn-sm btn-success" title="Import Akun" data-bs-toggle="modal" data-bs-target="#modalImport">
                        <i class="fa-solid fa-cloud-arrow-up fa-fw"></i>
                    </button>
                    <!-- <div class="dropdown"> -->
                    <button class="btn btn-sm btn-success" title="Unduh" type="button" id="dropdownDownload" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-download fa-fw"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownDownload">
                        <li><a class="dropdown-item" href="#">Excel</a></li>
                        <li><a class="dropdown-item" href="#">PDF</a></li>
                    </ul>
                    <!-- </div> -->
                    <!-- <button class="btn btn-sm btn-success" title="Download Akun">
                        <i class="fa-solid fa-download fa-fw"></i>
                    </button> -->
                    <button class="btn btn-sm btn-success" title="Download Kartu Login">
                        <i class="fa-solid fa-address-card fa-fw"></i>
                    </button>
                </div>
                <div class="btn-group mb-2" role="group">
                    <button class="btn btn-sm btn-info" id="selectAll" title="Centang Semua">
                        <i class="fa-solid fa-check-double fa-fw"></i>
                    </button>
                    <button class="btn btn-sm btn-info" id="invertSelect" title="Invert Centangan">
                        <i class="fa-solid fa-circle-minus fa-fw"></i>
                    </button>
                    <button class="btn btn-sm btn-info" id="clearAllCheck" title="Bersihkan yang Tercentang">
                        <i class="fa-solid fa-xmark fa-fw"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Data Akun Guru</h5>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode Guru</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP</th>
                            <th>Nomor HP</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Akun Guru -->
<div class="modal fade" id="modalAddAkun" tabindex="-1" aria-labelledby="modalAddAkunLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddAkunLabel">Tambah Akun Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form-akun">
                    <input type="hidden" name="idGuru" id="idGuru">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                        <label for="nama">Nama Lengkap</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="email" name="email" placeholder="nama@example.com">
                        <label for="email">Alamat Email Anda</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="Nomor Induk Pegawai (NIP)">
                        <label for="nip">NIP (Nomor Induk Pegawai)</label>
                        <span class="small">Kosongi jika tidak memiliki, sistem akan meng-<i>generate</i> nomor otomatis</span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nomorHP" name="nomorHP" placeholder="Nomor HP">
                        <label for="nomorHP">Nomor HP</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="tombolSimpanAkun">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import Akun Guru -->
<div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalAddAkunLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddAkunLabel">Import Akun Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="file" class="form-control" id="fileImport" aria-describedby="tombolImport" aria-label="Upload">
                    <button class="btn btn-primary" type="button" id="tombolImport">Import</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <!-- <button type="button" class="btn btn-primary" id="tombolSimpanAkun">Simpan</button> -->
            </div>
        </div>
    </div>
</div>