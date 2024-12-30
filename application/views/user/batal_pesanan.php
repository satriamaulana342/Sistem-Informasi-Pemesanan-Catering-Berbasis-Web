<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">pembatalan pesanan</h2>
            </div>
        </div>
    </div>
</section>

<section style="padding: 50px 0px;">
    <div class="container">
        <?= $this->session->flashdata('pesan'); ?>
        <div class="row">

            <!-- SYARAT DAN KETENTUAN -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Syarat dan Ketentuan</h6>
                        <hr>
                    </div>
                </div>
            </div>

            <!-- RINCIAN PEMESANAN -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Rincian Pemesanan</h6>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Paket</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesanan_detail as $key => $data) : ?>
                                    <tr align="center">
                                        <th scope="row"><?= $key + 1; ?>.</th>
                                        <td><?= ucwords($data['nama_paket']); ?></td>
                                        <td><?= number_format($data['jumlah']); ?></td>
                                        <td>Rp <?= number_format($data['harga']); ?></td>
                                        <td>Rp <?= number_format($data['harga'] * $data['jumlah']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr align="center">
                                    <th colspan="4">Total Bayar</th>
                                    <th colspan="21">Rp <?= number_format($data['sub_total']); ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center mt-5">
                <div class="text-center mt-2">

                    <!-- METODE PEMBAYARAN CASH, OPSI PEMBAYARAN DP -->
                    <?php if ($data['metode_pembayaran'] == 'cash' && $data['opsi_pembayaran'] == 'dp') : ?>
                        <p>Untuk melakukan proses pesanan Anda, silahkan melakukan pembayaran <br> dengan cara datang langsung ke Toko kami.</p>
                        <div class="my-5">
                            <p>Jumlah DP yang harus Anda bayar sebesar :</p>
                            <h4 class="fw-semibold">Rp <?= number_format($data['sub_total'] / 2); ?>,-</h4>
                        </div>
                        <div>
                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-hijau shadow-sm">Cek Status Pembayaran</a>
                        </div>

                        <!-- METODE PEMBAYARAN CASH, OPSI PEMBAYARAN LUNAS -->
                    <?php elseif ($data['metode_pembayaran'] == 'cash' && $data['opsi_pembayaran'] == 'lunas') : ?>
                        <p>Untuk melakukan proses pesanan Anda, silahkan melakukan pembayaran <br> dengan cara datang langsung ke Toko kami.</p>
                        <div class="my-5">
                            <p>Jumlah yang harus Anda bayar sebesar :</p>
                            <h4 class="fw-semibold">Rp <?= number_format($data['sub_total']); ?>,-</h4>
                        </div>
                        <div>
                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-hijau shadow-sm">Cek Status Pembayaran</a>
                        </div>

                        <!-- METODE PEMBAYARAN TRANSFER, OPSI PEMBAYARAN DP -->
                    <?php elseif ($data['metode_pembayaran'] == 'transfer' && $data['opsi_pembayaran'] == 'dp') : ?>
                        <p>Untuk melakukan proses pembatalan pemesanan, silahkan upload bukti bahwa <br> Anda pernah transfer ke nomor rekening dibawah ini :</p>
                        <div class="row d-flex justify-content-center align-items-center mt-5">
                            <div class="col-12 col-md-4 pt-1">
                                <img src="<?= base_url('assets/img/logo/Bank-BCA.png'); ?>" alt="" class="img-fluid" width="200">
                                <p class="fw-medium mt-3">7111-612-777 a/n Barokah Amanah Catering</p>
                            </div>
                            <div class="col-12 col-md-4">
                                <img src="<?= base_url('assets/img/logo/Bank-Mandiri.png'); ?>" alt="" class="img-fluid" width="250">
                                <p class="fw-medium mt-3">176-000-235-2894 a/n Sugewa Adlian</p>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center my-5">
                            <div class="col-12 col-md-6">
                                <?= form_open_multipart('user/dp_awal') ?>
                                <?= form_hidden('id_pesanan', $data['id_pesanan']) ?>
                                <?= form_hidden('id_pembatalan_pesanan', $id_pembatalan_pesanan) ?>
                                <div class="mb-3">
                                    <label for="dp_awal" class="form-label">Silahkan upload bukti DP awal dibawah ini :</label>
                                    <input class="form-control" type="file" id="dp_awal" name="dp_awal" required>
                                </div>
                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-hijau rounded-5 shadow-sm">
                                        <?= empty($dp_awal) ? 'Upload Bukti DP Awal' : 'Upload Ulang Bukti DP Awal' ?>
                                    </button>
                                    <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary">Nanti</a>
                                    <?php if (!empty($dp_awal)) : ?>
                                        <button type="button" class="btn btn-shijau" data-bs-toggle="modal" data-bs-target="#bukti_dp_awal">Lihat Bukti DP Awal
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <?= form_close() ?>

                                <?php if (!empty($dp_awal)) : ?>
                                    <?= form_open_multipart('user/dp_akhir') ?>
                                    <?= form_hidden('id_pesanan', $data['id_pesanan']) ?>
                                    <?= form_hidden('id_pembatalan_pesanan', $id_pembatalan_pesanan) ?>
                                    <div class="mt-5">
                                        <div class="mb-3">
                                            <label for="dp_akhir" class="form-label">Silahkan upload bukti pembayaran DP akhir dibawah ini :</label>
                                            <input class="form-control" type="file" id="dp_akhir" name="dp_akhir" required>
                                        </div>
                                        <div class="d-grid gap-2 mt-4">
                                            <button class="btn btn-hijau shadow-sm">
                                                Upload Bukti DP Akhir
                                            </button>
                                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary">Nanti</a>
                                            <?php if (!empty($dp_akhir)) : ?>
                                                <button type="button" class="btn btn-hijau" data-bs-toggle="modal" data-bs-target="#bukti_dp_akhir">Lihat Bukti DP Akhir
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?= form_close() ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- METODE PEMBAYARAN TRANSFER, OPSI PEMBAYARAN LUNAS -->
                    <?php elseif ($data['metode_pembayaran'] == 'transfer' && $data['opsi_pembayaran'] == 'lunas') : ?>
                        <p>Untuk melakukan proses pembatalan pemesanan, silahkan upload bukti bahwa <br> Anda pernah transfer ke nomor rekening dibawah ini :</p>
                        <div class="row d-flex justify-content-center align-items-center mt-5">
                            <div class="col-12 col-md-4 pt-1">
                                <img src="<?= base_url('assets/img/logo/Bank-BCA.png'); ?>" alt="" class="img-fluid" width="200">
                                <p class="fw-medium mt-3">7111-612-777 a/n Barokah Amanah Catering</p>
                            </div>
                            <div class="col-12 col-md-4">
                                <img src="<?= base_url('assets/img/logo/Bank-Mandiri.png'); ?>" alt="" class="img-fluid" width="250">
                                <p class="fw-medium mt-3">176-000-235-2894 a/n Sugewa Adlian</p>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center my-5">
                            <div class="col-12 col-md-6">
                                <?= form_open_multipart('user/lunas') ?>
                                <?= form_hidden('id_pesanan', $data['id_pesanan']) ?>
                                <?= form_hidden('id_pembatalan_pesanan', $id_pembatalan_pesanan) ?>
                                <div class="mb-3">
                                    <label for="lunas" class="form-label">Silahkan upload bukti pembayaran Lunas dibawah ini :</label>
                                    <input class="form-control" type="file" id="lunas" name="lunas" required>
                                </div>
                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-hijau shadow-sm">
                                        <?= empty($lunas) ? 'Upload Bukti' : 'Upload Ulang Bukti' ?>
                                    </button>
                                    <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary">Nanti</a>
                                    <?php if (!empty($lunas)) : ?>
                                        <button type="button" class="btn btn-hijau" data-bs-toggle="modal" data-bs-target="#bukti_lunas">Lihat Bukti Transfer
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL LIHAT BUKTI TRANSFER LUNAS -->
<div class="modal fade" id="bukti_lunas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer Lunas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/img/bukti_pembatalan/lunas/' . $lunas); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIHAT BUKTI DP AWAL -->
<div class="modal fade" id="bukti_dp_awal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer DP Awal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/img/bukti_pembatalan/dp_awal/' . $dp_awal); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIHAT BUKTI DP AKHIR -->
<div class="modal fade" id="bukti_dp_akhir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer DP Akhir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/img/bukti_pembatalan/dp_akhir/' . $dp_akhir); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>