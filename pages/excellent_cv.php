<?php
$db = Database::Instance();

$applyData = $db->Select("SELECT tbl_job_apply.*,tbl_job_seekers.username,
tbl_job_seekers.id as seeker_id,tbl_job_categories.category_name,
tbl_companies.company_name as cmp_name FROM tbl_job_apply LEFT JOIN tbl_manage_job_apply 
ON tbl_job_apply.id=tbl_manage_job_apply.apply_id LEFT JOIN tbl_job_seekers 
on tbl_job_seekers.id=tbl_manage_job_apply.seeker_id LEFT JOIN tbl_job_categories ON 
tbl_job_categories.id=tbl_manage_job_apply.category_id LEFT JOIN tbl_companies ON
 tbl_companies.id=tbl_manage_job_apply.company_id WHERE tbl_job_apply.top=1
");


if (isset($_POST['delete-job-apply'])) {
    $criteria = $_POST['criteria'];
    // find data
    $result = $db->Delete('tbl_job_apply', 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = 'data was successfully remove';
        redirect_to('admin/show_apply_jobs');
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
                                            <th>Category Name</th>
                                            <th>Position</th>
                                            <th>Level</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($applyData as $key => $apply): ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $apply->cmp_name ?></td>
                                                <td><?= $apply->category_name ?></td>
                                                <td><?= $apply->postion ?></td>
                                                <td><?= $apply->level ?></td>
                                                <td><?= $apply->email ?></td>

                                                <td>

                                                    <a class="btn btn-primary btn-xs pull-right"
                                                       href="<?=URL('admin/view_details_apply?criteria='.$apply->seeker_id)?>">Details </a>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="criteria"
                                                               value="<?= $apply->id ?>">
                                                        <button name="delete-job-apply" class="btn btn-danger btn-xs">
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
