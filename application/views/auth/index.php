    <!-- login card -->
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="card shadow-lg border-primary border-4 text-center" style="width: 20rem;">
            <div class="card-body">
                <img src="<?= base_url('assets/images/Web-eXam-lg.png'); ?>" class="card-img-top mb-3" style="width: 100px;" alt="Logo Web-eXam">
                <h5 class="card-title mb-3">Web-eXam</h5>
                <h6 class="card-subtitle mb-3 text-center">Welcome to Web-Based Exam System</h6>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="keyword" name="keyword" autofocus autocomplete="on" placeholder="Input NISN/NIP/Username" value="<?= $keyword; ?>">
                    <label for="keyword">Input NISN/NIP/Username</label>
                </div>
                <div class="d-grid gap-2 mb-2">
                    <button class="btn btn-primary w-100" type="button" id="tombolMasuk">Masuk</button>
                </div>
                <a href="#" class="small text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginInfoModal">Info Akun</a>
                <?php if (!$admin) : ?>
                    | <a href="<?= base_url('auth/register'); ?>" class="small text-decoration-none">Register Admin</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Info Login Modal -->
    <div class="modal fade" id="loginInfoModal" tabindex="-1" aria-labelledby="infoLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoLoginModalLabel">Informasi Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Untuk menggunakan aplikasi ini silahkan masuk dengan menggunakan akun:
                    <ul>
                        <li>NISN (Nomor Induk Siswa Nasional) untuk Peserta Didik yang akan melaksanakan Ujian.</li>
                        <li>NIP (Nomor Induk Pegawai) untuk Guru atau Pengawas Ruang Ujian.</li>
                        <li>Username (Nama Pengguna) untuk Admin Aplikasi ini.</li>
                    </ul>
                    Peserta didik yang tidak bisa masuk, silahkan menghubungi pengawas ruang dengan menyampaikan pesan kesalahan yang tampil. Untuk guru atau pengawas yang tidak bisa masuk maupun belum memiliki akun, silahkan menghubungi admin aplikasi ini.
                    </p>
                    <?php if (!$admin) : ?>
                        <p class="text-center">
                            <button class="btn text-center btn-primary">Registrasi Admin Aplikasi</button>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>