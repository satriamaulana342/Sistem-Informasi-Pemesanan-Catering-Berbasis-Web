<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
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

    <!-- Nav Item - Dashboard -->
    <li class="nav-item<?= ($this->uri->segment(1) == 'admin') ? ' active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin'); ?>">
            <i class="fas fa-home fa-fw"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item<?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['menu', 'item', 'paket', 'paket_menu', 'paket_kategori', 'paket_custom'])) ? ' active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#satu" aria-expanded="true" aria-controls="satu">
            <i class="fas fa-database fa-fw"></i>
            <span>Data Master</span>
        </a>
        <div id="satu" class="collapse <?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['menu', 'menu_prasmanan', 'item', 'paket', 'paket_custom', 'paket_menu', 'paket_kategori', 'paket_prasmanan'])) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= ($this->uri->segment(2) == 'menu') ? ' active' : '' ?>" href="<?= base_url('admin/menu'); ?>">Menu</a>
                <!-- <a class="collapse-item<?= ($this->uri->segment(2) == 'menu_prasmanan') ? ' active' : '' ?>" href="<?= base_url('admin/menu_prasmanan'); ?>">Menu Prasmanan</a> -->
                <a class="collapse-item<?= ($this->uri->segment(2) == 'item') ? ' active' : '' ?>" href="<?= base_url('admin/item'); ?>">Menu Item</a>
                <a class="collapse-item<?= ($this->uri->segment(2) == 'paket') ? ' active' : '' ?>" href="<?= base_url('admin/paket'); ?>">Paket</a>
                <a class="collapse-item<?= ($this->uri->segment(2) == 'paket_menu') ? ' active' : '' ?>" href="<?= base_url('admin/paket_menu'); ?>">Paket Menu</a>
                <a class="collapse-item<?= ($this->uri->segment(2) == 'paket_kategori') ? ' active' : '' ?>" href="<?= base_url('admin/paket_kategori'); ?>">Paket Kategori</a>
                <a class="collapse-item<?= ($this->uri->segment(2) == 'paket_custom') ? ' active' : '' ?>" href="<?= base_url('admin/paket_custom'); ?>">Paket Custom</a>
                <!-- <a class="collapse-item<?= ($this->uri->segment(2) == 'paket_prasmanan') ? ' active' : '' ?>" href="<?= base_url('admin/paket_prasmanan'); ?>">Paket Prasmanan</a> -->
            </div>
        </div>
    </li>

    <li class="nav-item<?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['transaksi', 'transaksi_pembatalan'])) ? ' active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tiga" aria-expanded="true" aria-controls="tiga">
            <i class="fas fa-money-check-alt fa-fw"></i>
            <span>Data Transaksi</span>
        </a>
        <div id="tiga" class="collapse <?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['transaksi', 'transaksi_pembatalan'])) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= ($this->uri->segment(2) == 'transaksi') ? ' active' : '' ?>" href="<?= base_url('admin/transaksi'); ?>">Transaksi</a>
                <a class="collapse-item<?= ($this->uri->segment(2) == 'transaksi_pembatalan') ? ' active' : '' ?>" href="<?= base_url('admin/transaksi_pembatalan'); ?>">Transaksi Pembatalan</a>
            </div>
        </div>
    </li>

    <li class="nav-item<?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['transaksi_perusahaan', 'kontrak'])) ? ' active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#empat" aria-expanded="true" aria-controls="empat">
            <i class="fas fa-money-check-alt fa-fw"></i>
            <span>Catering Perusahaan</span>
        </a>
        <div id="empat" class="collapse <?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['transaksi_perusahaan', 'kontrak'])) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= ($this->uri->segment(2) == 'kontrak') ? ' active' : '' ?>" href="<?= base_url('admin/kontrak'); ?>">Kontrak Perusahaan</a>
                <a class="collapse-item<?= ($this->uri->segment(2) == 'transaksi_perusahaan') ? ' active' : '' ?>" href="<?= base_url('admin/transaksi_perusahaan'); ?>">Transaksi Perusahaan</a>
            </div>
        </div>
    </li>

    <li class="nav-item<?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['user', 'profile', 'feedback'])) ? ' active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lima" aria-expanded="true" aria-controls="lima">
            <i class="fas fa-users fa-fw"></i>
            <span>Data User</span>
        </a>
        <div id="lima" class="collapse <?= ($this->uri->segment(1) == 'admin' && in_array($this->uri->segment(2), ['user', 'profile', 'feedback'])) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= ($this->uri->segment(2) == 'user') ? ' active' : '' ?>" href="<?= base_url('admin/user'); ?>">User</a>
                <a class="collapse-item<?= ($this->uri->segment(2) == 'feedback') ? ' active' : '' ?>" href="<?= base_url('admin/feedback'); ?>">Feedback</a>
                <a class="collapse-item<?= ($this->uri->segment(2) == 'profile') ? ' active' : '' ?>" href="<?= base_url('admin/profile'); ?>">Profile</a>
            </div>
        </div>
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