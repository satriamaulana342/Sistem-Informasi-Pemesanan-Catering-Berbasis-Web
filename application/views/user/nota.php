<div class="container-fluid">
    <div class="row">
        <div class="col-7 d-flex justify-content-center align-items-center gap-3">
            <img src="<?= base_url('assets/img/logo/logo-toko.png'); ?>" class="img-fluid" alt="" width="100">
            <div>
                <p class="fw-semibold mb-0">PT. BAROKAH AMANAH CATERING</p>
                <p class="mb-0" style="font-size: 15px;">Kp. Talaga RT 005/002 Desa Talagasari</p>
                <p class="mb-0" style="font-size: 15px;">Kec. Balaraja, Kab. Tangerang - Banten (15610)</p>
            </div>
        </div>
        <div class="col-5 d-flex justify-content-center align-items-center">
            <h1>I N V O I C E</h1>
        </div>
    </div>
    <hr>
    <?php foreach ($pesanan as $key => $data) : ?>
        <div class="row my-5">
            <div class="col-3">
                <p class="mb-1" style="font-size: 13px;">Nama Pelanggan</p>
                <p class="mb-1" style="font-size: 13px;">Tanggal Pemesanan</p>
                <p class="mb-1" style="font-size: 13px;">Tanggal Pengiriman</p>
                <p class="mb-1" style="font-size: 13px;">Kota Tujuan</p>
                <p class="mb-1" style="font-size: 13px;">Metode Pembayaran</p>
                <p class="mb-1" style="font-size: 13px;">Opsi Pembayaran</p>
                <p class="mb-1" style="font-size: 13px;">Alamat Lengkap</p>
            </div>
            <div class="col-9">
                <p class="mb-1" style="font-size: 13px;">: <?= ucwords($this->session->userdata('nama_lengkap')) ?></p>
                <p class="mb-1" style="font-size: 13px;">: <?= date('d F Y', strtotime($data['tanggal_pemesanan'])); ?></p>
                <p class="mb-1" style="font-size: 13px;">: <?= date('d F Y', strtotime($data['tanggal_pengiriman'])); ?></p>
                <p class="mb-1" style="font-size: 13px;">: <?= ucwords($data['kota_tujuan']); ?></p>
                <p class="text-uppercase mb-1" style="font-size: 13px;">: <?= ucwords($data['metode_pembayaran']); ?></p>
                <p class="text-uppercase mb-1" style="font-size: 13px;">: <?= ucwords($data['opsi_pembayaran']); ?></p>
                <p class="mb-1" style="font-size: 13px;">: <?= ucwords($data['alamat']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr align="center">
                        <th scope="col">No.</th>
                        <th scope="col">NAMA PAKET</th>
                        <th scope="col">QTY</th>
                        <th scope="col">HARGA</th>
                        <th scope="col">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detail_pesanan as $key => $data) : ?>
                        <tr align="center">
                            <th scope="row"><?= $key + 1; ?>.</th>
                            <td><?= ucwords($data['nama_paket']); ?></td>
                            <td><?= number_format($data['jumlah']); ?></td>
                            <td>Rp <?= number_format($data['harga']); ?></td>
                            <td>Rp <?= number_format($data['harga'] * $data['jumlah']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr align="center">
                        <th colspan="4">TOTAL BAYAR</th>
                        <th colspan="21">Rp <?= number_format($data['total']); ?></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    window.print();
</script>