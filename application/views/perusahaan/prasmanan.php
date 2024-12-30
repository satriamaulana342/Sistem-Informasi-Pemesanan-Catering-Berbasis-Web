<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">prasmanan</h2>
            </div>
        </div>
    </div>
</section>

<section class="paket" style="padding: 150px 0;">
    <div class="container">
        <?php if ($status_kontrak === 'belum_kontrak') : ?>
            <div class="alert alert-danger" role="alert">
                <strong>Pemberitahuan :</strong> <br> Anda belum mempunyai kontrak. Silakan hubungi admin untuk informasi lebih lanjut.
            </div>
        <?php elseif ($status_kontrak === 'habis_kontrak') : ?>
            <div class="alert alert-danger" role="alert">
                <strong>Pemberitahuan :</strong> <br> Masa kontrak Anda sudah habis. Silakan hubungi admin untuk perpanjangan kontrak.
            </div>
        <?php elseif ($status_kontrak === 'belum_mulai') : ?>
            <div class="alert alert-danger" role="alert">
                <strong>Pemberitahuan :</strong> <br> Kontrak Anda belum dimulai. Silakan hubungi admin untuk informasi lebih lanjut.
            </div>
        <?php else : ?>
            <div class="row mt-5">
                <!-- <div class="text-center mb-4">
                <h3>Daftar Prasmanan</h3>
                <p>Porsinya pas, buat perut kenyang, aktifitas jadi lancar.</p>
            </div> -->
                <div class="col-12">
                    <div class="tab-content mt-5" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row px-3 px-md-0">
                                <?php foreach ($paket as $data) : ?>
                                    <div class="col-12 col-md-2 col-lg-3 mb-4">
                                        <div class="card">
                                            <img src="<?= base_url('assets/img/upload_paket/' . $data['foto']); ?>" class="card-img-top" alt="<?= ucwords($data['nama_paket']); ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= ucwords($data['nama_paket']); ?></h5>
                                                <p class="card-text">Rp <?= number_format($data['harga']); ?>/PAX</p>
                                                <a href="<?= base_url('perusahaan/detail_prasmanan/' . $data['id_paket']); ?>" class="btn btn-hijau">Add to Cart</a>
                                                <a href="<?= base_url('perusahaan/detail_custom_prasmanan/' . $data['id_paket']); ?>" class="btn btn-secondary">Custom</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
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