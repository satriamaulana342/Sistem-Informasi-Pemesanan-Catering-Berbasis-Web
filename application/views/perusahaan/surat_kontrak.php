<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">surat kontrak</h2>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr align="center">
                                        <th scope="col">Nama Perusahaan</th>
                                        <th scope="col">Tanggal Awal Kontrak</th>
                                        <th scope="col">Tanggal Akhir Kontrak</th>
                                        <th scope="col">Paket Harga</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr align="center">
                                            <td><?= ucwords($kontrak['nama_lengkap']); ?></td>
                                            <td><?= tanggalIndonesia($kontrak['tanggal_awal']); ?></td>
                                            <td><?= tanggalIndonesia($kontrak['tanggal_akhir']); ?></td>
                                            <td>Rp <?= number_format($kontrak['harga_paket']); ?>,-</td>
                                            <td>
                                                <?php
                                                $status_kontrak = [
                                                    'belum kontrak'   => 'text-bg-secondary',
                                                    'habis kontrak'    => 'text-bg-danger',
                                                    'kontrak'   => 'text-bg-success',
                                                ];

                                                $statusClass = isset($status_kontrak[$kontrak['status_kontrak']]) ? $status_kontrak[$kontrak['status_kontrak']] : '';
                                                ?>

                                                <span class="badge rounded-pill <?= $statusClass; ?> fw-normal">
                                                    <?= ucwords($kontrak['status_kontrak']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($kontrak['status_kontrak'] == 'kontrak') : ?>
                                                    <a href="<?= base_url('admin/surat_kontrak/' . $kontrak['id_kontrak']); ?>" class="btn btn-sm btn-primary" target="_blank">Download</a>
                                                <?php else : ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <!-- <td>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $item['id_keranjang']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <a href="<?= base_url('perusahaan/hapusKeranjang/' . $item['id_keranjang']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td> -->
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
