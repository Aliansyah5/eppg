<!-- sidebar menu -->
<?php
    $userinfo = Session::get('userinfo');
	$segment =  Request::segment(2);
    $sub_segment =  Request::segment(3);
?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>Data Master</h3>
        <ul class="nav side-menu">

            <li class="{{ ($segment == 'dashboard' ? 'active' : '') }}">
                <a href="<?=url('backend/dashboard');?>"><i class="fa fa-bar-chart"></i> Dashboard </a>
            </li>

            <li class="{{ ($segment == 'absensi' ? 'active' : '') }}">
                <a href="<?=url('backend/absensi');?>"><i class="fa fa-users"></i> Absensi </a>
            </li>

            <li class="{{ ($segment == 'siswa' ? 'active' : '') }}">
                <a href="<?=url('backend/siswa');?>"><i class="fa fa-user-plus"></i> Database Murid</a>
            </li>
            <?php
            // SUPER ADMIN //
            if ($userinfo['priv'] == "VSUPER"):
            ?>
            <li class="active"><a><i class="fa fa-database"></i>Data Master <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: block;">
                    <li class="{{ ($segment == 'alquran' ? 'active' : '') }}">
                        <a href="<?=url('backend/alquran');?>"> Master Al-Quran</a>
                    </li>
                    <li class="{{ ($segment == 'hadist' ? 'active' : '') }}">
                        <a href="<?=url('backend/hadist');?>"> Master Al-Hadist</a>
                    </li>
                    <li class="{{ ($segment == 'kelompok' ? 'active' : '') }}">
                        <a href="<?=url('backend/kelompok');?>"> Master Kelompok</a>
                    </li>
                    <li class="{{ ($segment == 'desa' ? 'active' : '') }}">
                        <a href="<?=url('backend/desa');?>"> Master Desa</a>
                    </li>
                    <li class="{{ ($segment == 'pengajian' ? 'active' : '') }}">
                        <a href="<?=url('backend/pengajian');?>"> Master Pengajian</a>
                    </li>
                    <li class="{{ ($segment == 'daerah' ? 'active' : '') }}">
                        <a href="<?=url('backend/daerah');?>"> Master Daerah</a>
                    </li>
                    <li class="{{ ($segment == 'masjid' ? 'active' : '') }}">
                        <a href="<?=url('backend/masjid');?>"> Master Masjid</a>
                    </li>
                    <li class="{{ ($segment == 'kategori' ? 'active' : '') }}">
                        <a href="<?=url('backend/kategori');?>"> Master Kategori</a>
                    </li>
                    <li class="{{ ($segment == 'dapukan' ? 'active' : '') }}">
                        <a href="<?=url('backend/dapukan');?>"> Master Dapukan</a>
                    </li>
                    <li class="{{ ($segment == 'user' ? 'active' : '') }}">
                        <a href="<?=url('backend/user');?>"> Master User</a>
                    </li>
                    <li>
                        <a href="<?=url('backend/pic');?>"> Master PIC</a>
                    </li>

                </ul>
            </li>

            <?php
                endif;
                ?>

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
