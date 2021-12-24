<!-- Sidebar -->
<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#17A6DB;">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Student Management</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- query menu-->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`,`menu`
                            FROM `user_menu` JOIN `user_acces_menu`
                            ON `user_menu`.`id` = `user_acces_menu`.`menu_id`
                            WHERE `user_acces_menu`.`role_id` = $role_id
                            ORDER BY `user_acces_menu`.`menu_id` ASC";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>
    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>
        <!-- sub menu -->
        <?php
        $menuID = $m['id'];
        $querySubMenu = "SELECT * FROM `user_sub_menu` 
                        WHERE `menu_id` = $menuID AND `is_active` = 1 ORDER BY id ASC";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>
        <?php foreach ($subMenu as $sm) : ?>
            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class=" <?= $sm['icon']; ?>"></i>
                    <?php if($sm['title']== 'Student Score'){ ?>
                        <span><?= $sm['title']; ?>&nbsp;<span class="badge badge-info right" style="margin-left:50px;"><?php echo $scorenotices; ?></span></span></a>
                   <?php }else{?>
                        <span><?= $sm['title']; ?></span></a>
                   <?php }?>
                    
                </li>
            <?php endforeach; ?>
            <hr class="sidebar-divider mt-3">
        <?php endforeach; ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->