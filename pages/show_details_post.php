<?php
$db = Database::Instance();

$criteria = $_GET['criteria'];
$getResult = $db->Select("
SELECT tbl_job_post.*,tbl_job_categories.category_name,tbl_companies.* FROM tbl_job_post
JOIN tbl_manage_job_post on tbl_manage_job_post.job_post_id=tbl_job_post.id
JOIN tbl_job_categories ON tbl_job_categories.id=tbl_manage_job_post.job_category_id
JOIN tbl_companies ON tbl_companies.id=tbl_manage_job_post.company_id
WHERE tbl_manage_job_post.job_post_id='$criteria'
");

$postData = array_shift($getResult);


if (isset($_POST['send_message']) && !empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['criteria'];
    $message = $_POST['message'];
    $result = sendEmail($email, '', $message);
    if ($result == true) {
        $_SESSION['success'] = "Message has been send";
        back();
    }
}


?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <?= Messages(); ?>
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>company name</th>
                        <td><?= $postData->company_name ?></td>
                    </tr>
                    <tr>
                        <th>contact_number</th>
                        <td><?= $postData->contact_number ?></td>
                    </tr>
                    <tr>
                        <th>company_email</th>
                        <td><?= $postData->company_email ?></td>
                    </tr>
                    <tr>
                        <th>company_website</th>
                        <td><?= $postData->company_website ?></td>
                    </tr>
                    <tr>
                        <th>address</th>
                        <td><?= $postData->address ?></td>
                    </tr>
                    <tr>
                        <th>category_name</th>
                        <td><?= $postData->category_name ?></td>
                    </tr>
                    <tr>
                        <th>post_date</th>
                        <td><?= $postData->post_date ?></td>
                    </tr>


                </table>

                <div class="col-md-12">
                    <h5 class="btn btn-primary btn-xs"><i class="fa fa-reply"></i> Reply</h5>

                    <form action="" method="post">
                        <input type="hidden" name="criteria" value="<?= $applyData->company_email ?>">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control" id="message" style="resize: none;"
                                      rows="8"></textarea>
                        </div>
                        <div class="form-group">
                            <button name="send_message" class="btn btn-primary">
                                <i class="fa fa-envelope"></i> Send
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>