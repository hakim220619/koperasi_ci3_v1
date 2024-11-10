<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $aplikasi->title; ?> | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="assets/login/image/png" href="assets/login/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-5.5.0/css/all.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-4.3.0/css/all.min.css">

</head>

<body>


    <div class="limiter">
        <div class="container-login100" style="background: black;">
            <div class="wrap-login100 p-t-30 p-b-50">
                <div class="card" >
                    <div class="card-body">
                        <span class="login100-form-title p-b-41">
                            <a href="<?php echo base_url(); ?>">
                                <b>
                                    <?php
                                    echo $aplikasi->nama_aplikasi;
                                    ?>
                                </b></a>
                        </span>
                        <form class="login100-form validate-form p-b-33 p-t-5" action="" role="form" id="quickForm" method="post">
                            <div class="wrap-input100 validate-input" data-validate="Enter username">
                                <input class="input100" type="text" name="username" placeholder="User name" value="<?php echo set_value('username'); ?>">
                                <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="Enter password">
                                <input class="input100" type="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
                                <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                            </div>

                            <div class="container-login100-form-btn m-t-32">
                                <button class="btn btn-primary" type="button" id="login">
                                    Login
                                </button>
                            </div>

                        </form>
                        <?php
                        if (!empty($pesan)) {
                            echo $pesan;
                        } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/login/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="assets/login/js/main.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- jquery-validation -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script> -->

    <script>
        $("#login").on('click', function() {
            $.ajax({
                url: '<?php echo base_url('login/login') ?>',
                type: 'POST',
                data: $('#quickForm').serialize(),
                dataType: 'JSON',
                success: function(data) {
                    if (data.status) {
                        toastr.success('Login Berhasil!');
                        var url = '<?php echo base_url('dashboard') ?>';
                        window.location = url;
                    } else if (data.error) {
                        toastr.error(
                            data.pesan
                        );
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                            $('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
                            $('[name="' + data.inputerror[i] + '"]').next().next().text(data.error_string[i]).addClass('invalid-feedback');
                        }
                    }
                }
            });

        });
    </script>

</body>

</html>