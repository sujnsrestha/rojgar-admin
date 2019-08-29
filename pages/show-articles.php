<?php
$db = Database::Instance();

$query = "SELECT tbl_articles.*,tbl_job_categories.category_name FROM tbl_articles
LEFT JOIN tbl_manage_articles ON tbl_articles.id=tbl_manage_articles.article_id
LEFT JOIN tbl_job_categories ON tbl_job_categories.id=tbl_manage_articles.category_id ORDER BY tbl_manage_articles.id DESC";

$articleData = $db->Select($query, []);


if (isset($_POST['delete-article'])) {
    $criteria = $_POST['criteria'];
    // find data

    $findData = $db->SelectByCriteria('tbl_articles', '', 'id=?', array($criteria));
    $findFileName = $findData->image;
    $removePath = page_path('public/images/articles/' . $findFileName);
    if (file_exists($removePath) && is_file($removePath)) {
        unlink($removePath);
    }

    $result = $db->Delete('tbl_articles', 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = 'data was successfully remove';
        redirect_to('admin/show-articles');
    }


}

if (isset($_POST['update-articles'])) {
    $criteria = $_POST['criteria'];
    $findArticleData = $db->SelectByCriteria('tbl_articles', '', 'id=?', array($criteria));

}

if (isset($_POST['update-article-action'])) {
    $criteria = $_POST['criteria'];
    $data['title'] = $_POST['title'];
    $data['description'] = $_POST['description'];
    $data['updated_at'] = $_POST['post_date'];

    if (!empty($_FILES['upload']['name'])) {
        $findData = $db->SelectByCriteria('tbl_articles', '', 'id=?', array($criteria));
        $findFileName = $findData->image;
        $removePath = page_path('public/images/articles/' . $findFileName);
        if (file_exists($removePath) && is_file($removePath)) {
            unlink($removePath);
        }

        $target_dir = page_path('public/images/articles/');
        $imageFileType = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);

        $imageName = md5(microtime()) . '.' . $imageFileType;
        $tpmName = $_FILES['upload']['tmp_name'];

        if (move_uploaded_file($tpmName, $target_dir . $imageName)) {
            $data['image'] = $imageName;
        }

    }


    if ($db->Update('tbl_articles', $data, 'id=?', array($criteria))) {
        $_SESSION['success'] = 'data was successfully updated';
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
                            <?php if (isset($_POST['update-articles'])): ?>

                            <div class="col-md-12">
                                <?= Messages(); ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="criteria" value="<?=$findArticleData->id?>" >
                                    <div class="from-group">
                                        <label for="title">Title</label>
                                        <textarea name="title" id="title" class="form-control">
                                            <?=$findArticleData->title?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="create">Updated At</label>
                                        <div class="input-group date" id="myDatepicker">
                                            <input type="text" name="post_date"  class="form-control">
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                             </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="upload" class="btn btn-default">
                                    </div>


                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" class="form-control"
                                                  name="description">
                                            <?= $findArticleData->description ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <button name="update-article-action" class="btn btn-primary">Update Article</button>
                                    </div>
                                </form>
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
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($articleData as $key => $article): ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $article->title ?></td>
                                            <td><?= $article->category_name ?></td>
                                            <td><?= substr($article->description, 0, 50) ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="criteria"
                                                           value="<?= $article->id ?>">
                                                    <button name="update-articles"
                                                            class="btn btn-primary btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button name="delete-article" class="btn btn-danger btn-xs">
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
