<?php
$db = Database::Instance();
$jobCategory = $db->SelectAll('tbl_job_categories');

if (!empty($_POST)) {
    $data['title'] = $_POST['title'];
    $data['description'] = $_POST['description'];
    $data['created_at'] = $_POST['post_date'];


    $target_dir = page_path('public/images/articles/');
    $imageFileType = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);

    $docName = md5(microtime()) . '.' . $imageFileType;
    $tpmName = $_FILES['upload']['tmp_name'];

    if (move_uploaded_file($tpmName, $target_dir . $docName)) {
        $data['image'] = $docName;
    }


    $jobType = $_POST['job_type'];
    if ($lastInsertId = $db->Insert('tbl_articles', $data)) {
        if ($lastInsertId) {
            $dbs = Database::Instance();
            $cmpType['article_id'] = $lastInsertId;
            $cmpType['category_id'] = $jobType;
            $dbs->Insert('tbl_manage_articles', $cmpType);
        }

        $_SESSION['success'] = 'data was successfully inserted';
        redirect_to('admin/show-articles');

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
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="from-group">
                                        <label for="title">Title</label>
                                        <textarea name="title" id="title" class="form-control"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="job-type">Job types</label>
                                                <select name="job_type" id="job-type"
                                                        class="form-control">
                                                    <?php foreach ($jobCategory as $jobCat) : ?>
                                                        <option value="<?= $jobCat->id ?>"><?= $jobCat->category_name ?></option>

                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="create">Created At</label>
                                                <div class="input-group date" id="myDatepicker">
                                                    <input type="text" name="post_date" class="form-control">
                                                    <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                             </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input type="file" name="upload" class="btn btn-default">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" class="form-control"
                                                  name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Post Job</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

