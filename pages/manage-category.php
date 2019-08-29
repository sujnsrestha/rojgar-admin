<?php
$db = Database::Instance();

$manageData = $db->SelectAll('tbl_job_categories');

if (isset($_POST['add-category']) && !empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['category_name'])) {
        $_SESSION['error'] = 'category name filed is required';
        redirect_to('admin/manage-category');
    }
    $data['category_name'] = $_POST['category_name'];
    $result = $db->Insert('tbl_job_categories', $data);
    if ($result == true) {
        $_SESSION['success'] = "data was successfully inserted ";
        redirect_to('admin/manage-category');

    }
}

if (isset($_POST['active'])) {
    $data['status'] = 0;
    $criteria = $_POST['criteria'];
    $result = $db->Update('tbl_job_categories', $data, 'id=?',array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully updated ";
        redirect_to('admin/manage-category');

    }
}

if (isset($_POST['inactive'])) {
    $data['status'] = 1;
    $criteria = $_POST['criteria'];
    $result = $db->Update('tbl_job_categories', $data, 'id=?',array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully update ";
        redirect_to('admin/manage-category');

    }
}

if (isset($_POST['delete-category'])) {
    $criteria = $_POST['criteria'];
    $result = $db->Delete('tbl_job_categories', 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully remove ";
        redirect_to('admin/manage-category');

    }
}


if (isset($_POST['update-category'])) {
    $criteria = $_POST['criteria'];
    $catData = $db->SelectByCriteria('tbl_job_categories', '', 'id=?', array($criteria));

}

if (isset($_POST['update-category-action'])) {
    $data['category_name'] = $_POST['category_name'];
    $criteria = $_POST['criteria'];
    $result = $db->Update('tbl_job_categories', $data, 'id=?',array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully update ";
        redirect_to('admin/manage-category');

    }
}


?>

<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= ucfirst($title) ?></h2>
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
                                <?= Messages() ?>
                                <?php if (isset($_POST['update-category'])) : ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="criteria" value="<?= $catData->id ?>">
                                        <div class="form-group">
                                            <label for="name">Update Name</label>
                                            <input type="text" name="category_name"
                                                   value="<?= $catData->category_name ?>" placeholder="category name"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button name="update-category-action" class="btn btn-primary btn-sm">Update
                                                Category
                                            </button>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="name">Category Name</label>
                                            <input type="text" name="category_name" placeholder="category name"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button name="add-category" class="btn btn-primary btn-sm">Add Category
                                            </button>
                                        </div>
                                    </form>
                                <?php endif; ?>


                            </div>
                            <div class="col-md-12">
                                <h4>Show Category</h4>
                                <div id="datatable_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($manageData as $key => $cat): ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $cat->category_name ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="criteria" value="<?= $cat->id ?>">
                                                        <?php if ($cat->status == 1): ?>
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
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="criteria" value="<?= $cat->id ?>">
                                                        <button name="update-category" class="btn btn-primary btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button name="delete-category" class="btn btn-danger btn-xs">
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



