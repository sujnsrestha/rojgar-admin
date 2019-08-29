<?php
$db = Database::Instance();

$paymentData = $db->Select("SELECT tbl_payments.*,tbl_payments.id as payment_id,tbl_job_categories.category_name,tbl_companies.* FROM tbl_payments
LEFT JOIN tbl_manage_payment ON tbl_payments.id=tbl_manage_payment.payment_id
LEFT JOIN tbl_job_categories ON tbl_job_categories.id=tbl_manage_payment.category_id
LEFT JOIN tbl_companies ON tbl_companies.id=tbl_manage_payment.company_id
ORDER BY tbl_manage_payment.payment_id DESC");


if (isset($_POST['delete-payments'])) {
    $criteria = $_POST['criteria'];
    // find data

    $result = $db->Delete('tbl_payments', 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = 'data was successfully remove';
        redirect_to('admin/manage-payment');
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

                            <div class="col-md-12">
                                <div id="datatable_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S.n</th>
                                            <th>Company name</th>
                                            <th>Paid Amount</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($paymentData as $key => $payment): ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $payment->company_name ?></td>
                                                <td><?= $payment->amount ?></td>
                                                <td><?= $payment->category_name ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="criteria" value="<?=$payment->payment_id?>">
                                                        <button name="delete-payments" class="btn btn-danger btn-xs">
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
