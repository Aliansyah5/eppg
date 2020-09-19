<!-- sidebar menu -->
<?php
    $userinfo = Session::get('userinfo');
	$segment =  Request::segment(2);
    $sub_segment =  Request::segment(3);
?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <ul class="nav side-menu">
            <li class="{{ ($segment == 'dashboard' ? 'active' : '') }}">
                <a href="<?=url('backend/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
        </ul>
    </div>


    <div class="menu_section">
        <h3>MAINTENANCE</h3>
        <ul class="nav side-menu">

            <li>
                <a href="<?=url('backend/maintenance');?>"><i class="fa fa-wrench"></i> Master Maintenance</a>
            </li>
            <li class="{{ ($segment == 'change-password' ? 'active' : '') }}">
                <a href="<?=url('backend/change-password');?>"><i class="fa fa-ticket"></i> Change Password</a>
            </li>

            <li class="{{ ($segment == 'user-guide' ? 'active' : '') }}">
                <a href="<?=url('backend/user-guide');?>" target="_blank"><i class="fa fa-question"></i> User Guide</a>
            </li>

        </ul>
    </div>


    <div class="menu_section">
        <h3>MASTER</h3>
        <ul class="nav side-menu">
            <?php
    // SUPER ADMIN //
    if ($userinfo['priv'] == "VSUPER"):
    ?>
            <li class="{{ ($segment == 'user' ? 'active' : '') }}">
                <a href="<?=url('backend/user');?>"><i class="fa fa-user"></i> Master User</a>
            </li>


            <li>
                <a href="<?=url('backend/kategori');?>"><i class="fa fa-folder"></i> Master Kategori Maintenance</a>
            </li>
            <?php
    endif;
    ?>
            <li>
                <a href="<?=url('backend/pic');?>"><i class="fa fa-users"></i> Master PIC</a>
            </li>
            <li>
                <a href="<?=url('backend/asset');?>"><i class="fa fa-database"></i> Master Asset</a>
            </li>


            <li>
                <a href="<?=url('backend/hourmeter');?>"><i class="fa fa-tachometer"></i> Master Hour Meter</a>
            </li>

        </ul>
    </div>

    <div class="menu_section">
        <h3>Report</h3>
        <ul class="nav side-menu">

            <li>
                <a href="<?=url('backend/general-report');?>"><i class="fa fa-file"></i> Report</a>
            </li>
            <li>
                <a href="<?=url('reporting');?>"><i class="fa fa-bar-chart"></i> Report Forecast Biaya Maintenance</a>
            </li>

        </ul>
    </div>


    <?php
        // SUPER ADMIN //
        if ($userinfo['priv'] == "VSUPER"):
    ?>
    <div class="menu_section">
        <h3>GENERAL</h3>
        <ul class="nav side-menu">
            <li class="{{ ($segment == 'setting' ? 'active' : '') }}">
                <a href="<?=url('backend/setting');?>"><i class="fa fa-cog"></i> Setting</a>
            </li>
        </ul>
    </div>
    <?php
        endif;
    ?>
</div>
