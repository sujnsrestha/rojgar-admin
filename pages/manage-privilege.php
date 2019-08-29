<?php
$db = Database::Instance();

$privilegeData = $db->SelectAll('tbl_admin_privileges');
if (isset($_POST['add-privilege'])) {
    $data['privilege_name'] = $_POST['privilege_name'];
    $data['created_at'] = date('Y-m-d H:i:s');
    $result = $db->Insert('tbl_admin_privileges', $data);
    if ($result == true) {
        $_SESSION['success'] = 'privileges was successfully add';
        redirect_to('admin/manage-privilege');

    } else {
        redirect_to('admin/manage-privilege');
    }

}


if (isset($_POST['delete-privilege'])) {
    $criteria = $_POST['criteria'];
    $result = $db->Delete('tbl_admin_privileges', 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully remove ";
        redirect_to('admin/manage-privilege');

    }
}


if (isset($_POST['update-privilege'])) {
    $criteria = $_POST['criteria'];
    $priData = $db->SelectByCriteria('tbl_admin_privileges', '', 'id=?', array($criteria));

}

if (isset($_POST['update-privilege-action'])) {
    $data['privilege_name'] = $_POST['privilege_name'];
    $criteria = $_POST['criteria'];
    $result = $db->Update('tbl_admin_privileges', $data, 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully update ";
        redirect_to('admin/manage-privilege');

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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <?= Messages(); ?>
                                    <?php if (isset($_POST['update-privilege'])) : ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="criteria" value="<?=$priData->id?>">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="privilege_name" value="<?=$priData->privilege_name?>"
                                                           placeholder="enter privilege position" class="form-control">

                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button name="update-privilege-action" class="btn btn-primary">Update Privileges
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <form action="" method="post">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="privilege_name"
                                                           placeholder="enter privilege position" class="form-control">

                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button name="add-privilege" class="btn btn-primary">Add Privileges
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Show Privileges</h4>
                                <div id="datatable_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Privilege Name</th>
                                            <th>Created at</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($privilegeData as $key => $privilege): ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $privilege->privilege_name ?></td>
                                                <td><?= $privilege->created_at ?></td>

                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="criteria"
                                                               value="<?= $privilege->id ?>">
                                                        <button name="update-privilege" class="btn btn-primary btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button name="delete-privilege" class="btn btn-danger btn-xs">
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

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
