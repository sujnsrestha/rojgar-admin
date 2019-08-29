<?php
$db = Database::Instance();
$privilegeData = $db->SelectAll('tbl_admin_privileges');

if (!empty($_POST)) {

    $data['name'] = $_POST['name'];
    $data['username'] = $_POST['username'];
    $data['email'] = $_POST['email'];
    $data['status'] = $_POST['status'];
    $data['password'] = md5($_POST['password']);

    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');

    $target_dir = page_path('public/images/admins/');
    $imageFileType = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);

    $imageName = md5(microtime()) . '.' . $imageFileType;
    $tpmName = $_FILES['upload']['tmp_name'];

    if (move_uploaded_file($tpmName, $target_dir . $imageName)) {
        $data['image'] = $imageName;
    }
    $privilegeId = $_POST['privilege'];

    if ($lastInsertId = $db->Insert('tbl_admins', $data)) {

        foreach ($privilegeId as $id) {
            $priData['admin_id'] = $lastInsertId;
            $priData['privilege_id'] = $id;
            $db->Insert('tbl_admin_privilege', $priData);

        }

        $_SESSION['success'] = 'user was successfully add';
        redirect_to('admin/show-users');

    }
}


?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>laravel11am : : add-user</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">
                                <?= Messages(); ?>
                                <div class="col-md-8">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" value="" id="name"
                                                           class="form-control">
                                                    <a href="" style="color: red;"></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" name="username" id="username"
                                                           class="form-control">
                                                    <a href="" style="color: red;"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-grouop">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control">
                                            <a href="" style="color: red;"></a>
                                        </div>
                                        <div class="form-group">
                                            <label for="privilege">Privilege</label>
                                            <select name="privilege[]" id="privilege" multiple="multiple"
                                                    class="form-control">
                                                <?php foreach ($privilegeData as $privilege) : ?>
                                                    <option value="<?= $privilege->id ?>"><?= $privilege->privilege_name ?></option>

                                                <?php endforeach; ?>

                                            </select>
                                            <a href="" style="color: red;"></a>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option disabled selected>--select--</option>
                                                        <option value="0">Inactive</option>
                                                        <option value="1">Active</option>
                                                    </select>
                                                    <a href="" style="color: red;"></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="change_image">Profile Picture</label>
                                                    <input type="file" name="upload" id="change_image"
                                                           class="btn btn-default">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password"
                                                   class="form-control">
                                            <a href="" style="color: red;"></a>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Password Confirm</label>
                                            <input type="password" name="password_confirmation"
                                                   id="password_confirmation" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Record
                                            </button>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-md-4">
                                    <img src="<?= URL('public/icons/not-found.png') ?>" id="target_image"
                                         alt="image not select"
                                         class="img-responsive thumbnail" style="margin-top: 23px">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

