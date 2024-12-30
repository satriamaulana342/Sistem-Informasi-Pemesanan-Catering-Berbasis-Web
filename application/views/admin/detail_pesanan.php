<div class="container-fluid">
    <h1 class="h3 text-gray-800 mb-2"><?= $title; ?></h1>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="5%">Kode Pesanan</th>
                            <th width="15%">Nama Paket</th>
                            <th>Komposisi</th>
                            <th>Item Custom</th>
                            <th width="10%">Harga</th>
                            <th width="5%">Jumlah</th>
                            <th width="12%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detail_pesanan as $key => $value) : ?>
                            <tr align="center">
                                <td><?= ucwords($value['id_pesanan']); ?></td>
                                <td><?= ucwords($value['nama_paket']); ?></td>
                                <td><?= ucwords($value['nama_menu']); ?></td>
                                <td>
                                    <?php if ($value['custom_item'] != null) : ?>
                                        <?= ucwords($value['custom_item']); ?>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>Rp <?= number_format($value['harga']); ?></td>
                                <td><?= ucwords($value['jumlah']); ?> Box</td>
                                <td>Rp <?= number_format($value['harga'] * $value['jumlah']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>