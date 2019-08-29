<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-paw"></i>
                <span>Rogar</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <?php if (isset($_SESSION['image'])): ?>
                    <img src="<?= URL('public/images/admins/' . $_SESSION['image']) ?>" alt="..."
                         class="img-circle profile_img">
                <?php endif; ?>
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>
                    <?php if (isset($_SESSION['username'])): ?>
                        <?= $_SESSION['username'] ?>
                    <?php endif; ?>
                </h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Admin</h3>
                <ul class="nav side-menu">
                    <li><a href="<?= URL('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <li><a href="<?= URL('admin/manage-privilege') ?>"><i class="fa fa-folder"></i>Admin Privilege
                    <li><a><i class="fa fa-user"></i> Admins <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= URL('admin/add-user') ?>">Add User</a></li>
                            <li><a href="<?= URL('admin/show-users') ?>">Show Users</a></li>

                        </ul>
                    </li>
                    <li><a href="<?= URL('admin/manage-category') ?>"><i class="fa fa-folder">

                            </i> Manage Category
                        </a>
                    </li>
                    <li><a href="<?= URL('admin/show_apply_jobs') ?>"><i class="fa fa-folder">

                            </i> Show Apply Jobs
                        </a>
                    </li>
                    <li><a href="<?= URL('admin/excellent_cv') ?>"><i class="fa fa-folder">

                            </i> Excellent Seeker
                        </a>
                    </li>
                    <li><a href="<?= URL('admin/contacts') ?>"><i class="fa fa-phone"></i> People Contact</a>
                    <li><a href="<?= URL('admin/manage-payment') ?>"><i class="fa fa-dollar"></i> Mange Payment</a>
                    </li>
                    <li><a><i class="fa fa-folder"></i> Company <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= URL('admin/company-type') ?>">Company Type</a></li>
                            <li><a href="<?= URL('admin/add-company') ?>">Add Company</a></li>
                            <li><a href="<?= URL('admin/show-company') ?>">Show Company</a></li>

                        </ul>
                    </li>
                    <li><a><i class="fa fa-folder"></i> Mange Job post <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= URL('admin/post-job') ?>">Post Jobs</a></li>
                            <li><a href="<?= URL('admin/show-jobs') ?>">Show Jobs</a></li>

                        </ul>
                    </li>

                    <li><a><i class="fa fa-newspaper-o"></i> Mange Articles <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= URL('admin/add-article') ?>">Add Article</a></li>
                            <li><a href="<?= URL('admin/show-articles') ?>">Show Articles</a></li>

                        </ul>
                    </li>


                </ul>
            </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
