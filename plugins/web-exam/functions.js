function waktu() {
    var waktu = new Date();
    setTimeout("waktu()", 1000);

    let h = waktu.getHours();
    let m = waktu.getMinutes();
    let s = waktu.getSeconds();

    m = puluhan(m);
    s = puluhan(s);
    $('#jam').text(h + ":" + m + ":" + s);
}

function puluhan(i) {
    if (i < 10) {
        i = "0" + i
    };
    return i;
}

function tombolMasuk() {
    $('#tombolMasuk').html('<div class="spinner-border spinner-border-sm" role="status">',
        '<span class="visually-hidden">Loading...</span>',
        '</div>');

    const keywordElement = $('#keyword');
    if (keywordElement.val() == '') {
        fireNotif('error', 'Keyword harus diisi!');
        $('#keyword').addClass('is-invalid');
        $('#tombolMasuk').text('Masuk');
    } else {
        var data = new FormData();
        data.append('keyword', keywordElement.val());
        $.ajax({
            url: 'auth/clogin',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: 'POST',
            dataType: 'JSON',
            success: function(respone) {
                $('#keyword').removeClass('is-invalid');
                $('#tombolMasuk').addClass('bg-success').removeClass('bg-primary').attr('disabled', true).html('<div class="spinner-border spinner-border-sm me-2" role="status"><span class="visually-hidden">Loading...</span></div>Please wait');
                if (respone.levelUser == 'admin') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Selamat datang admin',
                        text: 'Sebelum mengakses halaman admin silahkan masukkan password pada input di bawah ini',
                        input: 'password',
                        inputPlaceholder: 'Masukkan password',
                        showDenyButton: true,
                        showCancelButton: false,
                        denyButtonText: 'Batal',
                        confirmButtonText: 'Masuk',
                        footer: 'Lupa password? Hubungi developer',
                        allowOutsideClick: () => {
                            const popup = Swal.getPopup()
                            popup.classList.remove('swal2-show')
                            setTimeout(() => {
                                popup.classList.add('animate__animated', 'animate__headShake')
                            })
                            setTimeout(() => {
                                popup.classList.remove('animate__animated', 'animate__headShake')
                            }, 500)
                            return false
                        },
                        preConfirm: (password) => {
                            return {
                                password: password
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('auth/cAdminLogin', {
                                username: keywordElement.val(),
                                password: result.value.password
                            }, function(data, status) {
                                if (data.status == true) {
                                    fireNotif('success', 'Selamat datang ' + data.namaUser + ' anda akan diarahkan ke halaman ' + data.levelUser);
                                    setTimeout(function() {
                                        document.location.href = data.levelUser;
                                    }, 5000);
                                } else {
                                    fireNotif('error', 'Password yang anda masukkan tidak sesuai!');
                                    $('#tombolMasuk').text('Masuk').addClass('bg-primary').removeClass('bg-success').attr('disabled', false);
                                    $.get('auth/logout');
                                }
                            }, 'JSON').fail(function() {
                                $('#tombolMasuk').text('Masuk').addClass('bg-primary').removeClass('bg-success').attr('disabled', false);
                                $.get('auth/logout');
                            })
                        } else if (result.isDenied) {
                            $('#tombolMasuk').text('Masuk').addClass('bg-primary').removeClass('bg-success').attr('disabled', false);
                            fireNotif('error', 'Login dibatalkan');
                            $.get('auth/logout');
                        }
                    })
                } else if (respone.levelUser == 'siswa') {
                    if (respone.isActive == 1) {
                        fireNotif('error', 'Akun ini sudah login ke dalam aplikasi. Silahkan hubungi pengawas untuk reset login.');
                        $('#tombolMasuk').text('Masuk').addClass('bg-primary').removeClass('bg-success').attr('disabled', false);
                        $('#keyword').addClass('is-invalid');
                        $.get('auth/logout');
                    } else {
                        fireNotif('success', 'Selamat datang ' + respone.namaUser + ' anda akan diarahkan ke halaman ' + respone.levelUser);
                        setTimeout(function() {
                            document.location.href = respone.levelUser;
                        }, 5000);
                    }
                } else {
                    fireNotif('success', 'Selamat datang ' + respone.namaUser + ' anda akan diarahkan ke halaman ' + respone.levelUser);
                    setTimeout(function() {
                        document.location.href = respone.levelUser;
                    }, 5000);
                }
            },
            error: function(errorMessage) {
                fireNotif('error', 'Akun tidak ditemukan!');
                $('#tombolMasuk').text('Masuk').addClass('bg-primary').removeClass('bg-success').attr('disabled', false);
                $('#keyword').addClass('is-invalid');
            }
        });
    }
}

function fireNotif(icon, title) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: icon,
        title: title
    })
}