<div class="container-fluid">
    <div class="row">
        <div class="col-8 d-flex" style="gap: 10px;">
            <div>
                <img src=" <?= base_url('assets/img/logo/logo-toko.png'); ?>" class="img-fluid" alt="" width="100">
            </div>
            <div>
                <h1 class="fw-bold mb-0 text-dark">BAROKAH AMANAH CATERING</h1>
                <p class="mb-0">Jl. Raya Serang Km. 24 Balaraja</p>
                <p class="mb-0">Telp. : 021 - 5950710</p>
                <p class="mb-0">Fax. : 021 - 5950710</p>
            </div>
        </div>
        <div class="col-4">
            <?php
            date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu sesuai lokasi Anda
            ?>

            <div class="row">
                <div class="6">
                    <p>Tanggal Cetak</p>
                    <p>Penanggung Jawab</p>
                </div>
                <div class="6">
                    <p>: <?= date('d-m-Y'); ?></p>
                    <p>: Staff Administrasi Umum</p>
                </div>
            </div>

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <h4 class="text-center text-uppercase fw-bold my-5 text-dark">laporan transaksi</h4>
            <p class="text-dark">Laporan dari tanggal: <?= date('d-m-Y', strtotime($tanggal_awal)); ?> sampai dengan <?= date('d-m-Y', strtotime($tanggal_akhir)); ?></p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr align="center">
                        <th scope="col">No.</th>
                        <th scope="col">Kode Pesanan</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Paket</th>
                        <th scope="col">Tanggal Pemesanan</th>
                        <th scope="col">Tanggal Pengiriman</th>
                        <th scope="col">Status Pengiriman</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $key => $value) : ?>
                        <tr align="center">
                            <th scope="row"><?= $key + 1; ?>.</th>
                            <td><?= ucwords($value['kode_pesanan']); ?></td>
                            <td><?= ucwords($value['nama_lengkap']); ?></td>
                            <td align="start">
    <ol>
        <?php foreach ($value['paket'] as $paket) : ?>
            <li>
                <?= ucwords($paket['nama_paket']); ?> - <?= $paket['jumlah']; ?> Box = 
                Rp <?= number_format($paket['jumlah'] * $paket['harga'], 0, ',', '.'); ?>
            </li>
        <?php endforeach; ?>
    </ol>
</td>
                            <td><?= tanggalIndonesia($value['tanggal_pemesanan']); ?></td>
                            <td><?= tanggalIndonesia($value['tanggal_pengiriman']); ?></td>
                            <td><?= ucwords($value['status_pengiriman']); ?></td>
                            <td>Rp <?= number_format($value['total']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    window.print();
</script>