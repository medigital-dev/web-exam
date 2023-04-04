<section id="footer">
    <nav class="navbar navbar-dark fixed-bottom navbar-expand-lg p-1" style="background-color: #000080;">
        <div class="container">
            <span class="navbar-text small text-light mx-auto">
                &copy; 2022 | Web-eXam v1.0
            </span>
        </div>
    </nav>
</section>

<!-- jQuery -->
<script src="<?= base_url('plugins/jquery/jquery-3.6.0.js'); ?>"></script>

<!-- Bootstrap Bundle -->
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.js'); ?>"></script>

<!-- datatables -->
<script type="text/javascript" src="<?= base_url('plugins/datatables/datatables.min.js'); ?>"></script>

<!-- fontawesome -->
<script src="<?= base_url('plugins/fontawesome/js/all.min.js'); ?>"></script>

<!-- sweetalert2 -->
<script src="<?= base_url('plugins/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>

<!-- web-exam -->
<script src="<?= base_url('plugins/web-exam/functions.js'); ?>"></script>

<script>
    $(document).ready(function() {
        $('#tombolImport').click(function() {
            const inputFile = $('#fileImport');
            const fileUpload = inputFile[0].files;
            const ext = inputFile.val().split('.').pop().toLowerCase();
            if (ext == 'xlsx' || ext == 'xls') {
                const data = new FormData();
                data.append('file', fileUpload);
                $.ajax({
                    url: '<?= base_url("admin/importGuru"); ?>',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: 'POST',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == true)
                            fireNotif('success', result.message);
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
                // $.post('<?= base_url("admin/importGuru"); ?>', {
                //     file: fileUpload
                // }, function(result) {
                //     console.log(result);
                // })
            } else {
                fireNotif('error', 'File yang diupload harus excel (xls/xlsx)!');
            }
        });

        $('#tombolEditAkun').click(function() {
            const dataHapus = $('.table-active');

            if (dataHapus.length == 1) {
                const data = $('.table-active');
                const nama = data.find('td:eq(2)').text();
                // if (data.length > 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Edit Data?',
                    text: 'Edit data Akun guru mata pelajaran an ' + nama + '?',
                    focusConfirm: true,
                    allowEscapeKey: false,
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya',
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        var i = 0;
                        data.each(function() {
                            const data = $(this);
                            const id = data.find('td:eq(1)').text();
                            const nama = data.find('td:eq(2)').text();
                            const email = data.find('td:eq(3)').text();
                            const nip = data.find('td:eq(4)').text();
                            const noHP = data.find('td:eq(5)').text();
                            $('#modalAddAkun').modal('show');
                            $('#idGuru').val(id);
                            $('#nama').val(nama);
                            $('#email').val(email);
                            $('#nip').val(nip);
                            $('#nomorHP').val(noHP);
                        });
                    }
                });
                // }
            } else {
                fireNotif('error', 'Pilih <strong>satu baris</strong> yang akan diedit.');

            }
        });

        $('#tombolSimpanAkun').click(function() {
            $(this).attr('disabled', true).html('<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>');
            const namaLengkap = $('#nama');
            const email = $('#email');
            const nip = $('#nip');
            const nomorHP = $('#nomorHP');
            const idGuru = $('#idGuru');

            if (namaLengkap.val() == '') {
                fireNotif('error', 'Harus diisi!');
                namaLengkap.toggleClass('is-invalid');
            }
            if (email.val() == '') {
                fireNotif('error', 'Harus diisi!');
                email.toggleClass('is-invalid');
            }

            $('#tombolSimpanAkun').text('Simpan').attr('disabled', false);
            if (email.val() == '' || namaLengkap.val() == '') {
                return false;
            }

            $.post('<?= base_url("admin/setAkunGuru"); ?>', {
                idGuru: idGuru.val(),
                namaLengkap: namaLengkap.val(),
                email: email.val(),
                nip: nip.val(),
                nomorHP: nomorHP.val()
            }, function(result) {
                if (result.status == true) {
                    $('#tombolSimpanAkun').text('Simpan').attr('disabled', false);
                    fireNotif('success', result.message);
                    $("#modalAddAkun").removeClass('fade').modal('hide').find('input').val('').end();
                    datatable.draw(false);
                } else {
                    fireNotif('error', result.message);
                    if (result.error == 'nip') {
                        nip.toggleClass('is-invalid');
                    } else if (result.error == 'email') {
                        email.toggleClass('is-invalid');
                    }
                }
            }, 'json')
        });

        $('#modalAddAkun').on('hide.bs.modal', function() {
            const data = $(this);
            const isInvalid = $('.is-invalid');
            if (isInvalid.length > 0) {
                for (let i = 0; i < isInvalid.length; i++) {
                    isInvalid.removeClass('is-invalid');
                }
            }

            $('#form-akun').trigger('reset');
            // $('#idGuru').val('');
            // $('#nama').val('');
            // $('#email').val('');
            // $('#nip').val('');
            // $('#nomorHP').val('');
        })

        $('#tombolHapusAkun').click(function() {
            const dataHapus = $('.table-active');

            if (dataHapus.length == 0) {
                fireNotif('error', 'Tidak ada yang baris yang dipilih!');
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Hapus Akun?',
                    text: dataHapus.length + ' akun guru mata pelajaran akan dihapus permanen. Anda yakin?',
                    focusConfirm: true,
                    allowEscapeKey: false,
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya',
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        var i = 0;
                        dataHapus.each(function() {
                            i++;
                            let dataResult = $(this);
                            let id = dataResult.find('td:eq(1)').text();
                            $.post('<?= base_url("admin/deleteAkunGuru/"); ?>' + id, function(result) {
                                if (result.status == false) {
                                    fireNotif('error', nama + ' gagal dihapus');
                                }
                            }, 'json');
                        });

                        fireNotif('success', i + ' data akun guru berhasil dihapus.')
                        datatable.draw(false);
                    }
                });
            }
        });

        var datatable = $('#example').DataTable({
            scrollY: '50vh',
            scrollCollapse: true,
            paging: false,
            responsive: true,
            stateSave: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "../admin/get_ajax",
                type: "POST"
            },
            columnDefs: [{
                    targets: 0,
                    width: '10px',
                    className: 'text-center'
                },
                {
                    targets: 1,
                    width: '150px',
                    className: 'text-center'
                },
                {
                    targets: 3,
                    width: '200px'
                },
                {
                    targets: 4,
                    width: '150px',
                    className: 'text-center',
                }
            ]
        });


        $('#clearAllCheck').click(function() {
            const rowSelected = $('.table-active');
            if (rowSelected.length > 0) {
                $('tr').removeClass('table-active table-info');
            } else {
                fireNotif('error', 'Tidak ada baris yang dipilih!');
            }
        })

        $('#selectAll').click(function() {
            $('tbody tr').addClass('table-active table-info');
        })

        $('#example tbody').on('click', 'tr', function() {
            $(this).toggleClass('table-active table-info');
        });

        $('#invertSelect').click(function() {
            const row = $('tbody tr');
            row.each(function() {
                $(this).toggleClass('table-active table-info');
            });
        });

        window.setTimeout('waktu()', 10);

        const message = $('#flash-message').data('flashdata');
        if (message) {
            var fireMessage = message.split('|');
            fireNotif(fireMessage[0], fireMessage[1]);
        }

        $('#tombolLogout').click(function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            Swal.fire({
                icon: 'warning',
                title: 'Keluar dari Aplikasi?',
                text: 'Anda mengeklik tombol Keluar. Apakah anda yakin akan meninggalkan aplikasi ini?',
                focusConfirm: true,
                allowEscapeKey: false,
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
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
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            });
        })

        var arrayCode = [];
        window.setInterval(function() {
            $.post('<?= base_url("csession/cek"); ?>', function(reponse) {
                if (arrayCode.indexOf(reponse.code) == -1) {
                    arrayCode.push(reponse.code)
                    Swal.fire({
                        icon: 'error',
                        title: 'Sesi Login Berakhir',
                        text: 'Sesi login anda di aplikasi ini telah berakhir, silahkan login kembali.',
                        confirmButtonText: 'Ok',
                        focusConfirm: true,
                        allowEscapeKey: false,
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
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.location.href = '<?= base_url("auth"); ?>';
                        }
                    });
                }
            }, 'JSON');
        }, 1000);
    });
</script>

</body>

</html>