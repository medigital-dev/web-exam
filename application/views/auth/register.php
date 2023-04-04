    <!-- login card -->
    <section id="form-registrasi" class="container">
        <div class="row pt-5 mt-5 mb-2 pb-5 justify-content-center">
            <div class="col col-md-5">
                <div class="card shadow-lg border-primary border-4 mx-auto">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?= base_url('assets/images/Web-eXam-lg.png'); ?>" class="card-img-top mb-1" style="width: 100px;" alt="Logo Web-eXam">
                        </div>
                        <h5 class="card-title mb-3 text-center">Web-eXam</h5>
                        <h6 class="card-subtitle mb-3 text-center">Registrasi Admin Web-Based Exam System</h6>
                        <form action="" class="row g-3" method="POST">
                            <div class="col-md-12">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control <?php if (form_error('nama')) {
                                                                                echo 'is-invalid';
                                                                            } ?>" id="nama" name="nama" placeholder="Nama" aria-describedby="validationNamaFeedback" value="<?= set_value('nama'); ?>">
                                    <label for="nama">Input nama anda</label>
                                    <div id="validationNamaFeedback" class="invalid-feedback">
                                        <?= form_error('nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control <?php if (form_error('email')) {
                                                                                echo 'is-invalid';
                                                                            } ?>" id="email" name="email" aria-describedby="validationEmailFeedback" placeholder="Email" value="<?= set_value('email'); ?>">
                                    <label for="email">Input Email anda</label>
                                    <div id="validationEmailFeedback" class="invalid-feedback">
                                        <?= form_error('email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control <?php if (form_error('username')) {
                                                                                echo 'is-invalid';
                                                                            } ?>" id="username" name="username" aria-describedby="validationUsernameFeedback" placeholder="Username" value="<?= set_value('username'); ?>">
                                    <label for="username">Input username anda</label>
                                    <div id="validationUsernameFeedback" class="invalid-feedback">
                                        <?= form_error('username'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-1">
                                    <input type="password" class="form-control form-password <?php if (form_error('password')) {
                                                                                                    echo 'is-invalid';
                                                                                                } ?>" id="password" name="password" aria-describedby="validationPasswordFeedback" placeholder="Password" value="<?= set_value('password'); ?>">
                                    <label for="password">Input password anda</label>
                                    <div id="validationPasswordFeedback" class="invalid-feedback">
                                        <?= form_error('password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-1">
                                    <input type="password" class="form-control form-password <?php if (form_error('password2')) {
                                                                                                    echo 'is-invalid';
                                                                                                } ?>" id="password2" name="password2" aria-describedby="validationPassword2Feedback" placeholder="Password2" value="<?= set_value('password2'); ?>">
                                    <label for="password2">Ulangi password anda</label>
                                    <div id="validationPassword2Feedback" class="invalid-feedback">
                                        <?= form_error('password2'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="showPassword">
                                    <label class="form-check-label" for="showPassword">Lihat Password</label>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mb-1">
                                <button class="btn btn-primary w-100" type="submit" id="tombolRegister">Register</button>
                            </div>
                            <a href="<?= base_url('auth'); ?>" class="small text-decoration-none text-center">Halaman Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>