<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
    </div>

    <?= $this->session->flashdata('pesan'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="10%">No.</th>
                            <th>Nama Paket</th>
                            <th>Nama Menu</th>
                            <th>Nama Item</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paket_custom as $key => $value) : ?>
                            <tr align="center">
                                <td><?= $key + 1 ?>.</td>
                                <td><?= ucwords($value['nama_paket']); ?></td>
                                <td><?= ucwords($value['nama_menu']); ?></td>
                                <td><?= ucwords($value['nama_item']); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit_paket_custom/' . $value['id_paket_custom']); ?>" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_paket_custom']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus_paket_custom/' . $value['id_paket_custom']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('admin/tambah_paket_custom'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_paket">Nama Paket</label>
                    <select class="form-control" id="id_paket" name="id_paket" required oninvalid="this.setCustomValidity('Silakan Pilih Nama Paket')" oninput="this.setCustomValidity('')">
                        <option selected disabled value="">Pilih</option>
                        <?php foreach ($paket as $value) : ?>
                            <option value="<?= $value['id_paket']; ?>"><?= ucwords($value['nama_paket']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_menu">Nama Menu</label>
                    <select class="form-control" id="id_menu" name="id_menu" required oninvalid="this.setCustomValidity('Silakan pilih Nama Menu')" oninput="this.setCustomValidity('')">
                        <option selected disabled value="">Pilih</option>
                        <?php foreach ($menu as $value) : ?>
                            <option value="<?= $value['id_menu']; ?>"><?= ucwords($value['nama_menu']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_item">Nama Item</label>
                    <select class="form-control" id="id_item" name="id_item" required oninvalid="this.setCustomValidity('Silakan Pilih Nama Item')" oninput="this.setCustomValidity('')">
                        <option selected disabled value="">Pilih</option>
                        <?php foreach ($item as $value) : ?>
                            <option value="<?= $value['id_item']; ?>"><?= ucwords($value['nama_item']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<?php foreach ($paket_custom as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_paket_custom']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_paket_custom/' . $value['id_paket_custom']) ?>
                <?= form_hidden('id_paket_custom', $value['id_paket_custom']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_paket">Nama Paket</label>
                        <select class="form-control" id="id_paket_<?= $value['id_paket_custom']; ?>" name="id_paket" required oninvalid="this.setCustomValidity('Nama Paket Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                            <option value="">Pilih</option>
                            <?php foreach ($paket as $data) : ?>
                                <option value="<?= $data['id_paket']; ?>" <?= ($data['id_paket'] == $value['id_paket']) ? 'selected' : '' ?>><?= ucwords($data['nama_paket']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_menu">Nama Menu</label>
                        <select class="form-control" id="id_menu_<?= $value['id_paket_custom']; ?>" name="id_menu" required oninvalid="this.setCustomValidity('Nama Menu Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                            <option value="">Pilih</option>
                            <?php foreach ($menu as $data) : ?>
                                <option value="<?= $data['id_menu']; ?>" <?= ($data['id_menu'] == $value['id_menu']) ? 'selected' : '' ?>><?= ucwords($data['nama_menu']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_item">Nama Item</label>
                        <select class="form-control" id="id_item_<?= $value['id_paket_custom']; ?>" name="id_item" required oninvalid="this.setCustomValidity('Nama Item Tidak Boleh Kosong')" oninput="this.setCustomValidity('')">
                            <option value="">Pilih</option>
                            <?php foreach ($item as $data) : ?>
                                <option value="<?= $data['id_item']; ?>" data-menu-id="<?= $data['id_menu']; ?>" <?= ($data['id_item'] == $value['id_item']) ? 'selected' : '' ?>><?= ucwords($data['nama_item']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuSelect = document.getElementById('id_menu');
        var itemSelect = document.getElementById('id_item');

        menuSelect.addEventListener('change', function() {
            var selectedMenuId = menuSelect.value;

            // Reset opsi item
            itemSelect.innerHTML = '<option selected disabled value="">Pilih</option>';

            // Tampilkan opsi item yang sesuai dengan menu yang dipilih
            <?php foreach ($item as $value) : ?>
                if ('<?= $value['id_menu']; ?>' == selectedMenuId || selectedMenuId == '') {
                    var option = document.createElement('option');
                    option.value = '<?= $value['id_item']; ?>';
                    option.textContent = '<?= ucwords($value['nama_item']); ?>';
                    itemSelect.appendChild(option);
                }
            <?php endforeach; ?>
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($paket_custom as $value) : ?>
            var menuSelect_<?= $value['id_paket_custom']; ?> = document.getElementById('id_menu_<?= $value['id_paket_custom']; ?>');
            var itemSelect_<?= $value['id_paket_custom']; ?> = document.getElementById('id_item_<?= $value['id_paket_custom']; ?>');

            menuSelect_<?= $value['id_paket_custom']; ?>.addEventListener('change', function() {
                var selectedMenuId = menuSelect_<?= $value['id_paket_custom']; ?>.value;

                // Reset opsi item
                itemSelect_<?= $value['id_paket_custom']; ?>.innerHTML = '<option selected disabled value="">Pilih</option>';

                // Tampilkan opsi item yang sesuai dengan menu yang dipilih
                <?php foreach ($item as $data) : ?>
                    console.log('Selected Menu ID: ' + selectedMenuId);
                    console.log('Item Menu ID: ' + '<?= $data['id_menu']; ?>');
                    if ('<?= $data['id_menu']; ?>' == selectedMenuId || selectedMenuId == '') {
                        var option = document.createElement('option');
                        option.value = '<?= $data['id_item']; ?>';
                        option.textContent = '<?= ucwords($data['nama_item']); ?>';
                        itemSelect_<?= $value['id_paket_custom']; ?>.appendChild(option);
                    }
                <?php endforeach; ?>
            });

            // Panggil event change pertama kali untuk memastikan opsi item yang tepat ditampilkan saat halaman dimuat untuk mode edit
            menuSelect_<?= $value['id_paket_custom']; ?>.dispatchEvent(new Event('change'));
        <?php endforeach; ?>
    });
</script>