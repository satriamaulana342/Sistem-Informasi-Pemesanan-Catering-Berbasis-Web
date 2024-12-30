<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('direktur'); ?>">
        <div class="sidebar-brand-icon rotate-n-0">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Catering <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        menu
    </div>

    <li class="nav-item<?= ($this->uri->segment(1) == 'direktur' && $this->uri->segment(2) == '') ? ' active' : '' ?>">
        <a class="nav-link" href="<?= base_url('direktur'); ?>">
            <i class="fas fa-home fa-fw"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item<?= ($this->uri->segment(1) == 'direktur' && $this->uri->segment(2) == 'laporan_transaksi') ? ' active' : '' ?>">
        <a class="nav-link" href="<?= base_url('direktur/laporan_transaksi'); ?>">
            <i class="fas fa-money-check-alt fa-fw"></i>
            <span>Laporan Transaksi</span></a>
    </li>

    <li class="nav-item<?= ($this->uri->segment(1) == 'direktur' && $this->uri->segment(2) == 'laporan_transaksi_perusahaan') ? ' active' : '' ?>">
        <a class="nav-link" href="<?= base_url('direktur/laporan_transaksi_perusahaan'); ?>">
            <i class="fas fa-money-check-alt fa-fw"></i>
            <span>Laporan Transaksi PT</span></a>
    </li>

    <li class="nav-item<?= ($this->uri->segment(1) == 'direktur' && $this->uri->segment(2) == 'profile') ? ' active' : '' ?>">
        <a class="nav-link" href="<?= base_url('direktur/profile'); ?>">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Profile</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout'); ?>">
            <i class="fas fa-sign-out-alt fa-fw"></i>
            <span>Keluar</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">