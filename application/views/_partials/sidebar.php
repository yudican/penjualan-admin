<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo site_url('dashboard') ?>">Db</a>
    </div>
    <ul class="sidebar-menu">
      <li><a class="nav-link" href="<?php echo site_url('dashboard') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-fire"></i> <span>Master Produk</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?php echo site_url('kategori') ?>">List Kategori</a></li>
          <li><a class="nav-link" href="<?php echo site_url('product') ?>">List Produk</a></li>
          <li><a class="nav-link" href="<?php echo site_url('promo') ?>">List Promo</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-fire"></i> <span>Customer</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?php echo site_url('customer') ?>">List Customer</a></li>
        </ul>
      </li>
    </ul>
    </aside>
</div>