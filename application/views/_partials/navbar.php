      <nav class="navbar navbar-expand-lg main-navbar">
        <ul class="navbar-nav navbar-right ml-auto">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <!-- <img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> -->
            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo getUser('full_name') ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="<?php echo site_url('dashboard/setting/profile') ?>" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Setting
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo site_url('dashboard/logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>