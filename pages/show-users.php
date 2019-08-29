<?php
$db = Database::Instance();

$query = "SELECT tbl_admins.*,
GROUP_CONCAT(tbl_admin_privileges.privilege_name SEPARATOR ',')
as user_privilege FROM tbl_admins
LEFT JOIN tbl_admin_privilege ON tbl_admin_privilege.admin_id=tbl_admins.id
LEFT JOIN tbl_admin_privileges ON tbl_admin_privilege.privilege_id=tbl_admin_privileges.id
GROUP BY tbl_admin_privilege.admin_id ORDER BY tbl_admins.id DESC";

$userData = $db->Select($query, []);

if (isset($_POST['delete-admins'])) {
    $criteria = $_POST['criteria'];
    // find data
    $res = $db->Delete('tbl_admin_privilege', 'admin_id=?', array($criteria));
    if ($res == true) {
        $findData = $db->SelectByCriteria('tbl_admins', '', 'id=?', array($criteria));
        $findFileName = $findData->image;
        $removePath = page_path('public/images/admins/' . $findFileName);
        if (file_exists($removePath) && is_file($removePath)) {
            unlink($removePath);
        }

        $result = $db->Delete('tbl_admins', 'id=?', array($criteria));
        if ($result == true) {
            $_SESSION['success'] = 'user was successfully add';
            redirect_to('admin/show-users');
        }

    }


}

if (isset($_POST['update-admins'])) {
    $criteria = $_POST['criteria'];
    $findAdminData = $db->SelectByCriteria('tbl_admins', '', 'id=?', array($criteria));

}

if (isset($_POST['update-admin-action'])) {
    $criteria = $_POST['criteria'];
    $data['name'] = $_POST['name'];
    $data['username'] = $_POST['username'];
    $data['email'] = $_POST['email'];
    $data['updated_at'] = date('Y-m-d H:i:s');

    if (!empty($_FILES['upload']['name'])) {
        $findData = $db->SelectByCriteria('tbl_admins', '', 'id=?', array($criteria));
        $findFileName = $findData->image;
        $removePath = page_path('public/images/admins/' . $findFileName);
        if (file_exists($removePath) && is_file($removePath)) {
            unlink($removePath);
        }

        $target_dir = page_path('public/images/admins/');
        $imageFileType = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);

        $imageName = md5(microtime()) . '.' . $imageFileType;
        $tpmName = $_FILES['upload']['tmp_name'];

        if (move_uploaded_file($tpmName, $target_dir . $imageName)) {
            $data['image'] = $imageName;
        }

    }


    if ($db->Update('tbl_admins', $data, 'id=?', array($criteria))) {
        $_SESSION['success'] = 'user was successfully updated';
        redirect_to('admin/show-users');

    }

}

if (isset($_POST['active'])) {
    $data['status'] = 0;
    $criteria = $_POST['criteria'];
    $result = $db->Update('tbl_admins', $data, 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully updated ";
        redirect_to('admin/show-users');

    }
}

if (isset($_POST['inactive'])) {
    $data['status'] = 1;
    $criteria = $_POST['criteria'];
    $result = $db->Update('tbl_admins', $data, 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully update ";
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
                        <h2><?= $title ?></h2>
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
                        <?= Messages(); ?>
                        <div class="row">
                            <?php if (isset($_POST['update-admins'])): ?>

                                <div class="col-md-12">
                                    <?= Messages(); ?>
                                    <div class="col-md-8">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="criteria" value="<?= $findAdminData->id ?>">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name"
                                                       value="<?= $findAdminData->name ?>" id="name"
                                                       class="form-control">
                                                <a href="" style="color: red;"></a>
                                            </div>

                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username"
                                                       value="<?= $findAdminData->username ?>" id="username"
                                                       class="form-control">
                                                <a href="" style="color: red;"></a>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" value="<?= $findAdminData->email ?>"
                                                       id="email" class="form-control">
                                                <a href="" style="color: red;"></a>
                                            </div>


                                            <div class="form-group">
                                                <label for="change_image">Profile Picture</label>
                                                <input type="file" name="upload" id="change_image"
                                                       class="btn btn-default">
                                            </div>


                                            <div class="form-group">
                                                <button name="update-admin-action" class="btn btn-primary"><i
                                                            class="fa fa-plus"></i> Updated Record
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col-md-4">
                                        <img src="<?= URL('public/images/admins/' . $findAdminData->image) ?>"
                                             id="target_image"
                                             alt="image not select"
                                             class="img-responsive thumbnail" style="margin-top: 23px">

                                    </div>

                                </div>

                            <?php else: ?>

                                <div class="col-md-12">
                                    <div id="datatable_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>S.n</th>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Privilege</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($userData as $key => $users) : ?>
                                                <tr>
                                                    <td><?= ++$key; ?></td>
                                                    <td><?= $users->name ?></td>
                                                    <td><?= $users->username ?></td>
                                                    <td><?= $users->email ?></td>
                                                    <td>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="criteria" value="<?= $users->id ?>">
                                                            <?php if ($users->status == 1): ?>
                                                                <button name="active" class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-check"></i>
                                                                </button>
                                                            <?php else: ?>
                                                                <button name="inactive" class="btn btn-danger btn-xs">
                                                                    <i class="fa fa-times"></i>
                                                                </button>

                                                            <?php endif; ?>
                                                        </form>
                                                    </td>
                                                    <td><?= $users->user_privilege ?></td>
                                                    <td>
                                                        <img src="<?= URL('public/images/admins/' . $users->image) ?>"
                                                             alt="img not found" width="30">
                                                    </td>
                                                    <td>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="criteria"
                                                                   value="<?= $users->id ?>">
                                                            <button name="update-admins" class="btn btn-primary btn-xs">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button name="delete-admins" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
