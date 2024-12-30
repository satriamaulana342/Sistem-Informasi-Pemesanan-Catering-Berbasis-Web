<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">detail menu paket</h2>
            </div>
        </div>
    </div>
</section>

<section class="detail" style="padding: 50px 0px;">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="col-12 col-md-6">
            <img src="<?= base_url('assets/img/upload_paket/' . $paket['foto']); ?>" class="img-fluid rounded-start" style="width: 100%; height: auto; max-height: 500px; object-fit: cover; margin-bottom: 15px;" alt="...">
            </div>
            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-body">
                        <?= form_open('perusahaan/addToCartPrasmanan/' . $paket['id_paket']); ?>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Nama Paket</strong></div>
                            <div class="col-7">: <?= ucwords($paket['nama_paket']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Harga</strong></div>
                            <div class="col-7">: Rp <?= number_format($paket['harga']); ?>/PAX</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"><strong>Minimal Pemesanan</strong></div>
                            <div class="col-7">: <?= ucwords($paket['minimal_pemesanan']); ?> PAX</div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col-5"><strong>Jumlah</strong></div>
                            <div class="col-7 d-flex align-items-center gap-1">
                                : <input type="number" min="<?= $paket['minimal_pemesanan']; ?>" class="form-control" id="jumlah" name="jumlah" placeholder="Min. <?= $paket['minimal_pemesanan']; ?>" required
                                    oninvalid="if(this.value === '') this.setCustomValidity('Jumlah tidak boleh kosong') 
                                                else if(this.value < <?= $paket['minimal_pemesanan']; ?>) this.setCustomValidity('Jumlah tidak boleh kurang dari <?= $paket['minimal_pemesanan']; ?>')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                        <?php foreach ($menu as $data) : ?>
                            <div class="row mb-2 d-block">
                                <div class="col-12"><strong><?= ucwords($data['nama_menu']); ?></strong> : </div>
                                <div class="col-12">
                                    <ol>
                                        <?php
                                        // Pecah string berdasarkan baris baru
                                        $deskripsi = preg_split('/\r\n|\r|\n/', $data['deskripsi']);

                                        // Iterasi dan tampilkan setiap kalimat sebagai item daftar
                                        foreach ($deskripsi as $item):
                                            $item = trim($item); // Hapus spasi di awal dan akhir
                                            if (!empty($item)): // Hanya tampilkan item yang tidak kosong
                                        ?>
                                                <li><?= ucwords(strtolower($item)); ?></li>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </ol>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-hijau"><i class="bi bi-cart-fill"></i> Add To Cart</button>
                            <a href="<?= base_url('perusahaan/prasmanan'); ?>" class="btn btn-secondary">Kembali</a>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="text-white" style="background-color: #095B34;">
    <div class="container pt-4 pb-2">
        <div class="row d-flex justify-content-between">
            <div class="col-12 col-md-6">
                <h1 class="text-uppercase text-cream-tua">barokah amanah catering</h1>
                <p style="font-size: 16px; font-weight: 300; text-align: justify;">PT. Barokah Amanah Catering adalah sebuah perusahaan yang bergerak di bidang jasa boga yang telah berdiri sejak tahun 1997 oleh Ibu Hj. Rasmawati sebagai pemilik. Diawal berdirinya, Barokah Catering berkerjasama dengan PT. Dharma Polimetal dengan order 50 Porsi hingga 1.250 Porsi.</p>
            </div>
            <div class="col-12 col-md-3 mt-5 mt-md-0">
                <h5 class="text-capitalize text-cream-tua mb-4">Link Tautan</h5>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li>
                        <a href="<?= base_url('home'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> Beranda</a>
                    </li>
                    <li>
                        <a href="<?= base_url('paket'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> Paket</a>
                    </li>
                    <li>
                        <a href="<?= base_url('about'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> Tentang Kami</a>
                    </li>
                    <li>
                        <a href="<?= base_url('faq'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> FAQ</a>
                    </li>
                    <li>
                        <a href="<?= base_url('kontak'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> Kontak</a>
                    </li>
                </ul>
            </div>
            <p class="text-center text-white" style="font-size: 15px; font-weight: 300; padding: 50PX 0 0 0;">Copyright &copy; <?= date('Y'); ?> Barokah Amanah Catering</p>
        </div>
    </div>
</footer>