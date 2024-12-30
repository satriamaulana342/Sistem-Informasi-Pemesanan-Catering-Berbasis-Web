<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">transaksi pemesanan</h2>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0px;">
    <div class="container">
        <?php if (!empty($pesanan)) : ?>
            <div class="row mt-5">
                <div class="col-12">
                    <?= $this->session->flashdata('pesan'); ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr align="center">
                                <th scope="col" width="5%">No.</th>
                                <th scope="col">Kode Pesanan</th>
                                <th scope="col">Tanggal Pemesanan</th>
                                <th scope="col">Tanggal Pengiriman</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status Pengiriman</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pesanan as $key => $value) : ?>
                                <tr align="center">
                                    <th scope="row"><?= $key + 1; ?>.</th>
                                    <td><?= $value['kode_pesanan']; ?></td>
                                    <td><?= tanggalIndonesia($value['tanggal_pemesanan']); ?></td>
                                    <td><?= tanggalIndonesia($value['tanggal_pengiriman']); ?></td>
                                    <td>Rp <?= number_format($value['total']); ?></td>
                                    <td>
                                        <?php
                                        $status_pengiriman = [
                                            'pending'   => 'text-bg-danger',
                                            'proses'    => 'text-bg-warning',
                                            'dikirim'   => 'text-bg-success',
                                            'selesai'   => 'text-bg-primary'
                                        ];

                                        $statusClass = isset($status_pengiriman[$value['status_pengiriman']]) ? $status_pengiriman[$value['status_pengiriman']] : '';
                                        ?>

                                        <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                            <?= ucwords($value['status_pengiriman']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('perusahaan/detail_pesanan/' . $value['id_pesanan_perusahaan']); ?>" class="btn btn-sm btn-secondary">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if ($value['status_pengiriman'] == 'pending') : ?>
                                            <a href="<?= base_url('perusahaan/hapusPesanan/' . $value['id_pesanan_perusahaan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')" title="Hapus Pesanan">
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>
                                        <?php elseif ($value['status_pengiriman'] == 'proses' || $value['status_pengiriman'] == 'dikirim' || $value['status_pengiriman'] == 'selesai') : ?>
                                            <a href="<?= base_url('perusahaan/nota/' . $value['id_pesanan_perusahaan']); ?>" class="btn btn-sm btn-success" target="_blank" title="Nota Pesanan">
                                                <i class="bi bi-receipt"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Data transaksi anda kosong.
            </div>
            <a href="<?= base_url('perusahaan'); ?>" class="btn btn-hijau">Lanjutkan Belanja</a>
        <?php endif; ?>
    </div>
</section>