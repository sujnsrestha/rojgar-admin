<?php
$db = Database::Instance();


$jobData = $db->Select("SELECT tbl_job_post.*,tbl_job_post.id as job_id,tbl_job_categories.category_name FROM tbl_job_post
LEFT JOIN tbl_manage_job_post ON tbl_job_post.id=tbl_manage_job_post.job_post_id
LEFT JOIN tbl_job_categories ON tbl_manage_job_post.job_category_id=tbl_job_categories.id");


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
                                            <th>Address</th>
                                            <td>Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($jobData as $key => $jobs): ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $jobs->company_name ?></td>
                                                <td><?= $jobs->category_name ?></td>
                                                <td><?= $jobs->address ?></td>
                                                <td><a href="<?=URL('admin/show_details_post?criteria='.$jobs->job_id)?>" class="btn btn-primary btn-xs">Details</a></td>

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
