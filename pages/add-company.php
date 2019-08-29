<?php
$db = Database::Instance();
$companyType = $db->SelectAll('tbl_companies_type');

if (!empty($_POST)) {
    $data['company_name'] = $_POST['company_name'];
    $data['company_address'] = $_POST['company_address'];
    $data['company_contact'] = $_POST['company_contact'];
    $data['company_optional_contact_number'] = $_POST['company_optional_contact_number'];
    $data['company_email'] = $_POST['company_email'];
    $data['company_username'] = $_POST['company_username'];
    $data['company_password'] = md5($_POST['company_password']);
    $data['company_website'] = $_POST['company_website'];

    $target_dir = page_path('public/images/company/');
    $imageFileType = pathinfo($_FILES['company_logo']['name'], PATHINFO_EXTENSION);

    $imageName = md5(microtime()) . '.' . $imageFileType;
    $tpmName = $_FILES['company_logo']['tmp_name'];

    if (move_uploaded_file($tpmName, $target_dir . $imageName)) {
        $data['company_logo'] = $imageName;
    }

    $typeId = $_POST['company_type'];
    if ($lastInsertId = $db->Insert('tbl_companies', $data)) {
        if ($lastInsertId) {
            $dbs = Database::Instance();
            $cmpType['company_id'] =$lastInsertId;
            $cmpType['company_type_id'] = $typeId;
            $dbs->Insert('tbl_companies_id', $cmpType);
        }

        $_SESSION['success'] = 'data was successfully inserted';
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
                                <?= Messages(); ?>
                                <div class="col-md-10">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_name">Company Name</label>
                                                    <input type="text" name="company_name" value="" id="company_name"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_address">Company Address</label>
                                                    <input type="text" name="company_address" id="company_address"
                                                           class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_type">Company Type</label>
                                                    <select name="company_type" id="" class="form-control">
                                                        <option disabled selected>--select company type--</option>
                                                        <?php foreach ($companyType as $company) : ?>
                                                            <option value="<?= $company->id ?>"><?= $company->type_name ?></option>
                                                        <?php endforeach; ?>

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_contact">Contact Number</label>
                                                    <input type="text" name="company_contact" id="company_contact"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_optional_contact_number">Optional Contact
                                                        Number</label>
                                                    <input type="text" name="company_optional_contact_number"
                                                           id="company_optional_contact_number"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_email">Email</label>
                                                    <input type="text" name="company_email"
                                                           id="company_email"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_username">User name</label>
                                                    <input type="text" name="company_username"
                                                           id="company_username"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_password">Password</label>
                                                    <input type="password" name="company_password"
                                                           id="company_password"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_website">Website</label>
                                                    <input type="text" name="company_website"
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
                                                    <button class="btn btn-primary">Add Company</button>
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

