<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">Detail Pemesanan</h2>
            </div>
        </div>
    </div>
</section>

<section style="padding: 50px 0px;">
    <div class="container">
        <?= $this->session->flashdata('pesan'); ?>
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6>Rincian Pemesanan</h6>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th scope="col">Kode Pesanan</th>
                                    <th scope="col">Nama Paket</th>
                                    <th scope="col">Komposisi</th>
                                    <th scope="col">Item Custom</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail_pesanan as $data) : ?>
                                    <tr align="center">
                                        <td><?= ucwords($data['kode_pesanan']); ?></td>
                                        <td><?= ucwords($data['nama_paket']); ?></td>
                                        <td><?= ucwords($data['nama_menu']); ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <?php
                                                if (!empty($data['custom_item'])) {
                                                    $custom_items = explode(',', $data['custom_item']);
                                                    $formatted_items = array_map(function ($item) {
                                                        return trim(ucwords($item));
                                                    }, $custom_items);
                                                    $items_string = implode(', ', $formatted_items);
                                                    echo "<span class='text-start'>" . $items_string . "</span>";
                                                } else {
                                                    echo "<span class='text-muted'>-</span>";
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td><?= number_format($data['jumlah']); ?></td>
                                        <td>Rp <?= number_format($data['harga']); ?></td>
                                        <td>Rp <?= number_format($data['harga'] * $data['jumlah']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr align="center">
                                    <th colspan="4">Total Bayar</th>
                                    <th colspan="21">Rp <?= number_format($data['total']); ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6>Informasi Pemesanan</h6>
                        <hr>
                        <div class="row">
                            <div class="col-6 col-md-3 text-capitalize">
                                <p>kode pesanan</p>
                                <p>nama pelanggan</p>
                                <p>tanggal pemesanan</p>
                                <p>tanggal pengiriman</p>
                                <p>kota tujuan</p>
                                <p>Kecamatan</p>
                                <p>alamat</p>
                                <p>metode pembayaran</p>
                                <p>opsi pembayaran</p>
                                <p>total</p>
                                <p>keterangan</p>
                            </div>
                            <div class="col-6 col-md-9">
                                <p>: <?= ucwords($data['kode_pesanan']); ?></p>
                                <p>: <?= ucwords($this->session->userdata('nama_lengkap')); ?></p>
                                <p>: <?= date('d F Y', strtotime($data['tanggal_pemesanan'])); ?></p>
                                <p>: <?= date('d F Y', strtotime($data['tanggal_pengiriman'])); ?></p>
                                <p>: <?= ucwords($data['kota_tujuan']); ?></p>
                                <p>: <?= ucwords($data['kecamatan']); ?></p>
                                <p>: <?= ucwords($data['alamat']); ?></p>
                                <p class="text-uppercase">: <?= ucwords($data['metode_pembayaran']); ?></p>
                                <p class="text-uppercase">: <?= ucwords($data['opsi_pembayaran']); ?></p>
                                <p>: Rp <?= number_format($data['total']); ?>,-</p>
                                <p class="text-uppercase">: <?= ucwords($data['keterangan']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary px-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</section>