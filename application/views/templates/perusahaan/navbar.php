<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('perusahaan'); ?>">
            <img src="<?= base_url('assets/img/logo/logo-toko.png'); ?>" alt="Logo" width="70">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item px-0 px-md-3">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'perusahaan' && $this->uri->segment(2) == '') ? ' active' : '' ?>" aria-current="page" href="<?= base_url('perusahaan'); ?>">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'perusahaan' && $this->uri->segment(2) == 'nasi_box' || $this->uri->segment(2) == 'prasmanan' || $this->uri->segment(2) == 'detail' || $this->uri->segment(2) == 'detail_custom' || $this->uri->segment(2) == 'detail_prasmanan' || $this->uri->segment(2) == 'detail_custom_prasmanan') ? ' active' : '' ?> dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Paket
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('perusahaan/nasi_box'); ?>">Nasi Box</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('perusahaan/prasmanan'); ?>">Prasmanan</a></li>
                    </ul>
                </li>
                <li class="nav-item px-0 px-md-3">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'perusahaan' && $this->uri->segment(2) == 'tentang_kami') ? ' active' : '' ?>" href="<?= base_url('perusahaan/tentang_kami'); ?>">Tentang Kami</a>
                </li>
                <li class="nav-item px-0 px-md-3">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'perusahaan' && $this->uri->segment(2) == 'faq') ? ' active' : '' ?>" href="<?= base_url('perusahaan/faq'); ?>">FAQ</a>
                </li>
                <li class="nav-item px-0 px-md-3">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'perusahaan' && $this->uri->segment(2) == 'kontak') ? ' active' : '' ?>" href="<?= base_url('perusahaan/kontak'); ?>">Kontak</a>
                </li>
            </ul>
            <ul class="navbar-nav d-lg-flex justify-content-lg-center align-items-lg-center">
                <?php if (isset($id_user)) : ?>
                    <!-- jika user sudah login -->
                    <li class="nav-item">
                        <a href="<?= base_url('perusahaan/keranjang'); ?>" class="position-relative fs-5">
                            <i class="bi bi-cart3 icon-white" id="cart-icon">
                                <?php if ($cekJumlah > 0) { ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-1" style="font-size: 10px;">
                                        <?= $cekJumlah; ?>
                                    </span>
                                <?php } ?>
                            </i>
                        </a>
                    </li>
                    <li class="nav-item px-0 px-md-3 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- <?= ucwords($this->session->userdata('nama_lengkap')); ?> -->
                            <?= ucwords($user['nama_lengkap']); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('perusahaan/profile'); ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('perusahaan/transaksi'); ?>">Transaksi</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('perusahaan/surat_kontrak'); ?>">Surat Kontrak</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">Keluar</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <!-- jika user belum login -->
                    <li class="nav-item">
                        <a class="btn btn-hijau rounded-5 px-4" href="<?= base_url('login'); ?>">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>