<?php
$db = Database::Instance();

$query = 'SELECT tbl_companies.*,tbl_companies_type.type_name FROM tbl_companies
LEFT JOIN tbl_companies_id ON tbl_companies.id=tbl_companies_id.company_id
LEFT JOIN tbl_companies_type ON tbl_companies_type.id=tbl_companies_id.company_type_id';

$companyData = $db->Select($query, []);


if (isset($_POST['delete-company'])) {
    $criteria = $_POST['criteria'];
    // find data

    $findData = $db->SelectByCriteria('tbl_companies', '', 'id=?', array($criteria));
    $findFileName = $findData->company_logo;
    $removePath = page_path('public/images/company/' . $findFileName);
    if (file_exists($removePath) && is_file($removePath)) {
        unlink($removePath);
    }

    $result = $db->Delete('tbl_companies', 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = 'data was successfully remove';
        redirect_to('admin/show-company');
    }


}

if (isset($_POST['update-company'])) {
    $criteria = $_POST['criteria'];
    $findCompanyData = $db->SelectByCriteria('tbl_companies', '', 'id=?', array($criteria));

}

if (isset($_POST['update-company-action'])) {
    $criteria = $_POST['criteria'];
    $data['company_name'] = $_POST['company_name'];
    $data['company_address'] = $_POST['company_address'];
    $data['company_contact'] = $_POST['company_contact'];
    $data['company_optional_contact_number'] = $_POST['company_optional_contact_number'];
    $data['company_email'] = $_POST['company_email'];
    $data['company_username'] = $_POST['company_username'];
    $data['company_password'] = md5($_POST['company_password']);
    $data['company_website'] = $_POST['company_website'];

    if (!empty($_FILES['company_logo']['name'])) {
        $findData = $db->SelectByCriteria('tbl_companies', '', 'id=?', array($criteria));
        $findFileName = $findData->company_logo;
        $removePath = page_path('public/images/company/' . $findFileName);
        if (file_exists($removePath) && is_file($removePath)) {
            unlink($removePath);
        }

        $target_dir = page_path('public/images/company/');
        $imageFileType = pathinfo($_FILES['company_logo']['name'], PATHINFO_EXTENSION);

        $imageName = md5(microtime()) . '.' . $imageFileType;
        $tpmName = $_FILES['company_logo']['tmp_name'];

        if (move_uploaded_file($tpmName, $target_dir . $imageName)) {
            $data['company_logo'] = $imageName;
        }

    }


    if ($db->Update('tbl_companies', $data, 'id=?', array($criteria))) {
        $_SESSION['success'] = 'data was successfully updated';
        redirect_to('admin/show-company');

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
                            <?php if (isset($_POST['update-company'])): ?>

                                <div class="col-md-12">
                                    <div class="col-md-10">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="criteria" value="<?= $findCompanyData->id ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_name">Company Name</label>
                                                        <input type="text" name="company_name"
                                                               value="<?= $findCompanyData->company_name ?>"
                                                               id="company_name"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_address">Company Address</label>
                                                        <input type="text" name="company_address"
                                                               value="<?= $findCompanyData->company_address ?>"
                                                               id="company_address"
                                                               class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_contact">Contact Number</label>
                                                        <input type="text" name="company_contact"
                                                               value="<?= $findCompanyData->company_contact ?>"
                                                               id="company_contact"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_optional_contact_number">Optional Contact
                                                            Number</label>
                                                        <input type="text" name="company_optional_contact_number"
                                                               value="<?= $findCompanyData->company_optional_contact_number ?>"
                                                               id="company_optional_contact_number"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_email">Email</label>
                                                        <input type="text"
                                                               value="<?= $findCompanyData->company_email ?>"
                                                               name="company_email"
                                                               id="company_email"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_username">User name</label>
                                                        <input type="text"
                                                               value="<?= $findCompanyData->company_username ?>"
                                                               name="company_username"
                                                               id="company_username"
                                                               class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_website">Website</label>
                                                        <input type="text"
                                                               value="<?= $findCompanyData->company_website ?>"
                                                               name="company_website"
                                                               id="company_website"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="change_image">Company logo</label>
                                                        <input type="file" name="company_logo"
                                                               id="change_image"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button name="update-company-action" class="btn btn-primary">
                                                            Update Company
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col-md-2">
                                        <img src="<?= URL('public/icons/not-found.png') ?>" id="target_image"
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
                                                <th>Company name</th>
                                                <th>Address</th>
                                                <th>Type</th>
                                                <th>Contact</th>
                                                <th>Optional Contact</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Website</th>
                                                <th>Logo</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($companyData as $key => $company): ?>
                                                <tr>
                                                    <td><?= ++$key ?></td>
                                                    <td><?= $company->company_name ?></td>
                                                    <td><?= $company->company_address ?></td>
                                                    <td><?= $company->type_name ?></td>
                                                    <td><?= $company->company_contact ?></td>
                                                    <td><?= $company->company_optional_contact_number ?></td>
                                                    <td><?= $company->company_email ?></td>
                                                    <td><?= $company->company_username ?></td>
                                                    <td><?= $company->company_website ?></td>
                                                    <td>
                                                        <img src="<?= URL('public/images/company/' . $company->company_logo) ?>"
                                                             width="20" alt="">
                                                    </td>
                                                    <td>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="criteria"
                                                                   value="<?= $company->id ?>">
                                                            <button name="update-company"
                                                                    class="btn btn-primary btn-xs">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button name="delete-company" class="btn btn-danger btn-xs">
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
