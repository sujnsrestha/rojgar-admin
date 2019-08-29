<?php
$db = Database::Instance();

$criteria = $_GET['criteria'];
$getResult = $db->Select("SELECT tbl_job_apply.*,tbl_job_apply.id 
as apply_id,tbl_job_seekers.*,
tbl_job_categories.category_name,tbl_companies.company_name
 as cmp_name FROM tbl_job_apply
LEFT JOIN tbl_manage_job_apply ON tbl_job_apply.id=tbl_manage_job_apply.apply_id
LEFT JOIN tbl_job_seekers on tbl_job_seekers.id=tbl_manage_job_apply.seeker_id
LEFT JOIN tbl_job_categories ON tbl_job_categories.id=tbl_manage_job_apply.category_id
LEFT JOIN tbl_companies ON tbl_companies.id=tbl_manage_job_apply.company_id
WHERE tbl_manage_job_apply.seeker_id='$criteria'
");

$applyData = array_shift($getResult);


if (isset($_POST['send_message']) && !empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['criteria'];
    $message = $_POST['message'];
    $result = sendEmail($email, '', $message);
    if ($result == true) {
        $_SESSION['success'] = "Message has been send";
        back();
    }
}


if (isset($_POST['medium'])) {
    $criteria = $_POST['criteria'];
    $data['top'] = 1;
    $result = $db->Update('tbl_job_apply', $data, 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "Excellent CV Thanks";
        back();
    }

}

if (isset($_POST['excellent'])) {
    $criteria = $_POST['criteria'];
    $data['top'] = 0;
    $result = $db->Update('tbl_job_apply', $data, 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = "Medium  CV Thanks";
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
                        <th>Name</th>
                        <td><?= $applyData->full_name ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $applyData->email ?></td>
                    </tr>
                    <tr>
                        <th>Mobile Number</th>
                        <td><?= $applyData->mobile_number ?></td>
                    </tr>
                    <tr>
                        <th>Telephone number</th>
                        <td><?= $applyData->telephone_number ?></td>
                    </tr>
                    <tr>
                        <th>Position</th>
                        <td><?= $applyData->postion ?></td>
                    </tr>
                    <tr>
                        <th>Experience</th>
                        <td><?= $applyData->experience ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?= $applyData->gender ?></td>
                    </tr>
                    <tr>
                        <th>Married Status</th>
                        <td><?= $applyData->married_status ?></td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td><?= $applyData->level ?></td>
                    </tr>
                    <tr>
                        <th>Document name</th>
                        <td>
                            <a href="<?= URL('public/images/document/' . $applyData->document_name) ?>" download>
                                <i class="fa fa-file-pdf-o"></i>Download</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="criteria" value="<?= $applyData->apply_id ?>">
                                <?php if ($applyData->top == 1) : ?>
                                    <button name="excellent" class="btn btn-success btn-xs">excellent</button>

                                <?php else: ?>
                                    <button name="medium" class="btn btn-warning btn-xs">medium</button>

                                <?php endif; ?>
                            </form>

                        </td>
                    </tr>


                </table>

                <div class="col-md-12">
                    <h5 class="btn btn-primary btn-xs"><i class="fa fa-reply"></i> Reply</h5>

                    <form action="" method="post">
                        <input type="hidden" name="criteria" value="<?= $applyData->email ?>">
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