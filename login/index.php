<?php
require_once '../../config/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Page </title>
    <!-- Bootstrap -->
    <link href="<?= URL('public/admin/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= URL('public/admin/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= URL('public/admin/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
    <link href="<?= URL('public/admin/vendors/animate.css/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= URL('public/admin/build/css/custom.min.css') ?>" rel="stylesheet">
    <style>
        .my-class {
            text-align: left;

        }

    </style>

</head>

<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="post" action="">
                    <h1>Login to dashboard</h1>
                    <div class="form-group my-class">
                        <input type="text" id="username" name="username"
                               class="form-control" placeholder="Username">
                        <div id="my-username"></div>
                    </div>
                    <div class="form-group my-class">
                        <input type="password" id="password" name="password"
                               class="form-control" placeholder="Password">
                        <div id="my-password"></div>
                    </div>
                    <div>
                        <button id="admin-login" type="submit" class="btn btn-primary submit pull-left">
                            <i class="fa fa-unlock"></i> Log in
                        </button>
                    </div>

                </form>
            </section>
        </div>


    </div>
</div>
<script src="<?= URL('public/admin/vendors/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?= URL('public/admin/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

<script>
    $(document).ready(function () {

        $('#username').keyup(function () {
            let username = $(this).val();
            $.ajax({
                method: "POST",
                url: "<?=URL('admin/login/check.php')?>",
                data: {username: username},
                success: function (res) {
                    $('#my-username').html(res)
                }
            })
        });

        $('#password').keyup(function () {
            let pass = $(this).val();
            $.ajax({
                method: "POST",
                url: "<?=URL('admin/login/check.php')?>",
                data: {password: pass},
                success: function (res) {
                    $('#my-password').html(res)
                }
            })
        });

        $('#admin-login').on('click', function (event) {
            event.preventDefault();
            let username = $('#username').val();
            let password = $('#password').val();
            if (username == '') {
                $('#my-username').html('username field is required');
                return false;
            }
            if (password == '') {
                $('#my-password').html('password field is required');
                return false;
            }

            $.ajax({
                method: "POST",
                url: "<?=URL('admin/login/check.php')?>",
                data: {username: username, password: password, admin_login: true},
                success: function (res) {
                    window.location.replace('/rojgar/admin');
                }
            })

        });


    });
</script>

</body>
</html>
