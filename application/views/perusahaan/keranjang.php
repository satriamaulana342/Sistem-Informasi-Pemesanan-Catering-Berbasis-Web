<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">keranjang belanja</h2>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (!empty($keranjang)) : ?>
                    <?= $this->session->flashdata('pesan'); ?>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr align="center">
                                        <th scope="col">Nama Paket</th>
                                        <th scope="col" width="17%">Menu</th>
                                        <th scope="col" width="17%">Item Custom</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subtotal = 0;
                                    foreach ($keranjang as $item) :
                                        $total = $item['jumlah'] * $item['harga'];
                                        $subtotal += $total;
                                    ?>
                                        <tr align="center">
                                            <td><?= ucwords($item['nama_paket']); ?></td>
                                            <td><?= ucwords($item['menu_paket']); ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <?php
                                                    if (!empty($item['custom_item'])) {
                                                        $custom_items = explode(',', $item['custom_item']);
                                                        $custom_items_string = implode(', ', array_map('trim', array_map('ucwords', $custom_items)));
                                                        echo $custom_items_string;
                                                    } else {
                                                        echo "<span class='text-muted'>-</span>";
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td><?= number_format($item['jumlah']); ?></td>
                                            <td>Rp <?= number_format($item['harga']); ?></td>
                                            <td>Rp <?= number_format($total); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $item['id_keranjang']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <a href="<?= base_url('perusahaan/hapusKeranjang/' . $item['id_keranjang']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr align="center">
                                        <th colspan="4">Total</th>
                                        <th colspan="21">Rp <?= number_format($subtotal); ?></th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-2">
                                <a href="<?= base_url('perusahaan/checkout'); ?>" class="btn btn-hijau px-3">Checkout</a>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        Keranjang belanja Anda kosong.
                    </div>
                    <a href="<?= base_url('perusahaan'); ?>" class="btn btn-hijau px-3">Lanjutkan Belanja</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<?php foreach ($keranjang as $item) : ?>
    <div class="modal fade" id="edit<?= $item['id_keranjang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('perusahaan/editKeranjang'); ?>
                <?= form_hidden('id_keranjang', $item['id_keranjang']) ?>
                <div class="modal-body">
                    <?php if ($item['custom_item'] !== null) : ?>
                        <?php
                        $custom_items = explode(', ', $item['custom_item']);
                        $menu_items = $this->Model_user->getMenuItemsByPaketId($item['id_paket']);
                        foreach ($menu_items as $menu_id => $menu_name) :
                            $items = $this->Model_user->getCustomItemsByMenuId($menu_id);
                        ?>
                            <div class="mb-3">
                                <label for="custom_item_<?= $menu_id ?>" class="form-label">Custom <?= ucwords($menu_name) ?></label>
                                <select class="form-select" id="custom_item_<?= $menu_id ?>" name="custom_item[<?= $menu_id ?>]">
                                    <?php foreach ($items as $custom_item) : ?>
                                        <option value="<?= $custom_item['id_item'] ?>" <?= (in_array($custom_item['nama_item'], $custom_items)) ? 'selected' : '' ?>>
                                            <?= ucwords($custom_item['nama_item']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="<?= $item['minimal_pemesanan']; ?>" value="<?= $item['jumlah']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-hijau">Edit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>