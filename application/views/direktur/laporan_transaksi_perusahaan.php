<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <?= form_open() ?>
        <div style="display: flex; align-items: flex-end; gap: 8px;">
            <div class="form-group">
                <label for="tanggal_awal">Tanggal Awal</label>
                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
            </div>
            <div class="form-group">
                <label for="tanggal_akhir">Tanggal Akhir</label>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
            </div>
            <div class="form-group">
                <button type="submit" formaction="<?= base_url('direktur/transaksi_perusahaan_excel') ?>" formtarget="_blank" class="btn btn-success text-white">Excel</button>
                <button type="submit" formaction="<?= base_url('direktur/transaksi_perusahaan_pdf') ?>" formtarget="_blank" class="btn btn-danger text-white">PDF</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Nama Pelanggan</th>
                            <th>Status Transaksi</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesanan as $key => $value) : ?>
                            <tr align="center">
                                <td><?= ucwords($value['nama_lengkap']); ?></td>
                                <td><?= ucwords($value['status_pengiriman']); ?></td>
                                <td>Rp <?= number_format($value['total']); ?>,-</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>