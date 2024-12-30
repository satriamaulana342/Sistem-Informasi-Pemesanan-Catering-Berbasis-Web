<div class="container-fluid">
    <div class="row d-flex justify-content-between align-items-end">
        <div class="col-6 d-flex justify-content-start align-items-center gap-3">
            <img src="<?= base_url('assets/img/logo/logo-toko.png'); ?>" class="img-fluid" alt="" width="100">
            <div>
                <h5 class="fw-semibold mb-0">BAROKAH AMANAH CATERING</h5>
                <p class="mb-0" style="font-size: 15px;">Jl. Raya Serang Km. 24 Balaraja</p>
                <p class="mb-0" style="font-size: 15px;">Telp. : 021 - 5950710</p>
                <p class="mb-0" style="font-size: 15px;">Fax. : 021 - 5950710</p>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <h1 class="fs-1 fw-bolder text-uppercase">surat jalan</h1>
        </div>
    </div>
    <hr>

    <p><strong>Kepada Yth,</strong></p>

    <div class="row d-flex justify-content-between align-items-start mt-4 mb-5">
        <div class="col-6">
            <div class="row">
                <div class="col-4 text-capitalize">
                    <p><strong>nama penerima</strong></p>
                    <p><strong>nomor telepon</strong></p>
                    <p><strong>alamat lengkap</strong></p>
                </div>
                <div class="col-8">
                    <p>: <?= ucwords($pesanan['nama_lengkap']) ?></p>
                    <p>: <?= $pesanan['no_telp']; ?></p>
                    <p>: <?= ucwords($pesanan['alamat']) ?></p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-5 text-capitalize">
                    <p><strong>tanggal pemesanan</strong></p>
                    <p><strong>tanggal pengiriman</strong></p>
                </div>
                <div class="col-7">
                    <p>: <?= tanggalIndonesia($pesanan['tanggal_pemesanan']) ?></p>
                    <p>: <?= tanggalIndonesia($pesanan['tanggal_pengiriman']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr align="center">
                        <th scope="col" width="10%">No.</th>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Waktu Pengiriman</th>
                        <th scope="col">Jumlah Pengiriman</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detail_pesanan as $key => $value) : ?>
                        <tr align="center">
                            <td><?= $key + 1; ?></td>
                            <td><?= ucwords($value['nama_paket']); ?></td>
                            <td><?= date('H:i', strtotime($value['waktu_pengiriman'])); ?> WIB</td>
                            <td><?= number_format($value['jumlah']); ?> Porsi</td>
                            <td><?= ucwords($value['keterangan']); ?></td>
                            <td>Rp <?= number_format($value['total']); ?>,-</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-6 text-center">
            <p style="font-size: 15px;">Yang menerima,</p>
            <p>(............................................)</p>
        </div>
        <div class="col-6 text-center">
            <p style="font-size: 15px;">Yanti Susanti,</p>
            <p>(............................................)</p>
        </div>
    </div>
</div>

<script>
    window.print();
</script>