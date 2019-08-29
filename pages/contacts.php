<?php
$db = Database::Instance();

$contactData = $db->SelectAll('tbl_contacts');


?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Contact page</h2>
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
                            <?=Messages(); ?>

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($contactData as $key => $contact) : ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= $contact->name ?></td>
                                        <td><?= $contact->email ?></td>
                                        <td><?= $contact->subject ?></td>
                                        <td>
                                            <?= $contact->message; ?>
                                        </td>
                                        <td>
                                            <?= $contact->created_at ?>
                                        </td>
                                        <td>
                                            <a href="<?=URL('admin/contact-details?criteria='.$contact->id)?>"
                                               class="btn btn-primary btn-xs">
                                                <i class="fa fa-folder-open"></i>
                                            </a>
                                            <a href="<?=URL('admin/contact-delete?criteria='.$contact->id)?>"
                                               onclick="return confirm('are you sure delete')"
                                               class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
