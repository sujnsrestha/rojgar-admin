<?php

$db = Database::Instance();

if (!empty($_GET['criteria'])) {
    $criteria = $_GET['criteria'];

    $messageDetails = $db->SelectByCriteria('tbl_contacts', '',
        'id=?', array($criteria));

}


if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['criteria'];
    $message = $_POST['message'];
    $result = sendEmail($email, '', $message);
    if ($result == true) {
        $_SESSION['success'] = "Message has been send";
        back();
    }


}


?>


<div class="right_col" role="main">
    <div class="">


        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-envelope"></i> Message Details</h2>
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

                        <div class="col-md-12">
                            <?= Messages() ?>

                            <ul class="stats-overview">
                                <li>
                                    <span class="name"> <?= strtoupper($messageDetails->name) ?> </span>

                                </li>
                                <li>
                                    <span class="name">  <?= $messageDetails->email ?> </span>

                                </li>
                                <li class="hidden-phone">
                                    <span class="name">  <?= $messageDetails->created_at ?> </span>
                                </li>
                            </ul>
                            <br/>

                            <div id="mainb" style="min-height: 150px;">
                                <strong><?= $messageDetails->subject ?></strong>
                                <hr>

                                <?= $messageDetails->message ?>
                            </div>

                            <div>

                                <h5 class="btn btn-primary btn-xs"><i class="fa fa-reply"></i> Reply</h5>

                                <form action="" method="post">
                                    <input type="hidden" name="criteria" value="<?= $messageDetails->email ?>">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" class="form-control" id="message" style="resize: none;"
                                                  rows="8"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-envelope"></i> Send
                                        </button>
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

