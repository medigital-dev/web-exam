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

<!-- fontawesome -->
<script src="<?= base_url('plugins/fontawesome/js/all.min.js'); ?>"></script>

<!-- sweetalert2 -->
<script src="<?= base_url('plugins/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>

<!-- web-exam -->
<script src="<?= base_url('plugins/web-exam/functions.js'); ?>"></script>

<script>
    $(document).ready(function() {

        window.setTimeout("waktu()", 10);
        const message = $('#flash-message').data('flashdata');
        if (message) {
            var fireMessage = message.split('|');
            fireNotif(fireMessage[0], fireMessage[1]);
        }

        if (navigator.onLine) {
            $('#inetStatus').html('<div class="spinner-grow spinner-grow-sm text-success me-1" role="status"><span class="visually-hidden">Loading...</span></div><span class="badge bg-success">Online</span>');
            $('#tombolReset').attr('disabled', false);
            $('#email').attr('disabled', false);
        } else {
            $('#inetStatus').html('<div class="spinner-grow spinner-grow-sm text-danger me-1" role="status"><span class="visually-hidden">Loading...</span></div><span class="badge bg-danger">Offline</span>')
            $('#tombolReset').attr('disabled', true);
            $('#email').attr('disabled', true);
        }

        $('#reloadPage').click(function() {
            location.reload();
        })

        $('#keyword').keyup(function(e) {
            if (e.key == 'Enter') {
                tombolMasuk();
            }
        })

        $('#tombolMasuk').click(function() {
            tombolMasuk();
        })
    });

    $('#showPassword').click(function() {
        if ($(this).is(':checked')) {
            $('.form-password').attr('type', 'text');
        } else {
            $('.form-password').attr('type', 'password');
        }
    });
</script>

</body>

</html>