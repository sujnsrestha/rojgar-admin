<?php
$db = Database::Instance();

$selectData = $db->SelectAll('tbl_companies_type');

if (isset($_POST['add-company-type']) && !empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['type_name'])) {
        $_SESSION['error'] = 'company name filed is required';
        redirect_to('admin/company-type');
    }
    $data['type_name'] = $_POST['type_name'];
    $result = $db->Insert('tbl_companies_type', $data);
    if ($result == true) {
        $_SESSION['success'] = "data was successfully inserted ";
        redirect_to('admin/company-type');

    }
}


if (isset($_POST['delete-company-type'])) {
    $criteria = $_POST['criteria'];
    $result = $db->Delete('tbl_companies_type', 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully remove ";
        redirect_to('admin/company-type');

    }
}


if (isset($_POST['update-company-type'])) {
    $criteria = $_POST['criteria'];
    $typeData = $db->SelectByCriteria('tbl_companies_type', '', 'id=?', array($criteria));

}

if (isset($_POST['update-company-type-action'])) {
    $data['type_name'] = $_POST['type_name'];
    $criteria = $_POST['criteria'];
    $result = $db->Update('tbl_companies_type', $data, 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "data was successfully update ";
        redirect_to('admin/company-type');

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
                                <?php if (isset($_POST['update-company-type'])) : ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="criteria" value="<?= $typeData->id ?>">
                                        <div class="form-group">
                                            <label for="name">Types Name</label>
                                            <input type="text" name="type_name"
                                                   value="<?= $typeData->type_name ?>" placeholder="category name"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button name="update-company-type-action" class="btn btn-primary btn-sm">Update
                                                Category
                                            </button>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="type_company">Type of Company </label>
                                            <input type="text" name="type_name" placeholder="category name"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button name="add-company-type" class="btn btn-primary btn-sm">Add Company Type
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
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($selectData as $key => $value): ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $value->type_name ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="criteria" value="<?= $value->id ?>">
                                                        <button name="update-company-type" class="btn btn-primary btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button name="delete-company-type" class="btn btn-danger btn-xs">
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



