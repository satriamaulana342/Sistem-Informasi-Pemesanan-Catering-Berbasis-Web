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
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Rincian Pemesanan</h6>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
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

            <div class="col-12 text-center mt-5">
                <div class="text-center mt-2">
                    <h5 class="fw-semibold mb-3">Harap diperhatikan bahwa setiap pesanan yang telah dibayar tidak dapat dikembalikan.</h5>
                    <p>Kami menghargai pemahaman Anda mengenai kebijakan ini. Pastikan terlebih dahulu <br> sebelum melakukan pembatalan pesanan. Jika ada pertanyaan silakan hubungi kontak kami. <br> Terima kasih atas pengertian dan kerja samanya.</p>
                    <div class="row mt-5">
                        <div class="col-12 d-flex justify-content-center align-items-center gap-2">
                            <form action="<?= base_url('user/batalkanPesanan'); ?>" method="post">
                                <input type="hidden" name="kode_pesanan" value="<?= $kode_pesanan; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk membatalkan pesanan?')">Batalkan Pesanan</button>
                            </form>
                            <a href="<?= base_url('transaksi'); ?>" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>