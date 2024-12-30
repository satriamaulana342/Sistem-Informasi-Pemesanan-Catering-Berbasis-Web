<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <a href="<?= base_url('admin/tambah_paket_menu'); ?>" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="5%">No.</th>
                            <th>Nama Paket</th>
                            <th>Nama Menu</th>
                            <th width="30%">Deskripsi</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paket_menu as $key => $value) : ?>
                            <tr align="center">
                                <td><?= $key + 1 ?>.</td>
                                <td><?= ucwords($value['nama_paket']); ?></td>
                                <td><?= ucwords($value['nama_menu']); ?></td>
                                <td align="start">
                                    <ol>
                                        <?php foreach (preg_split('/\r\n|\r|\n/', $value['deskripsi']) as $item): ?>
                                            <?php if ($item = trim($item)): ?>
                                                <li class="text-start"><?= ucwords(strtolower($item)); ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ol>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/edit_paket_menu/' . $value['id_paket_menu']); ?>" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value['id_paket_menu']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus_paket_menu/' . $value['id_paket_menu']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')">
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
            <?= form_open('admin/tambah_paket_menu'); ?>
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
                    <select class="form-control" id="id_menu" name="id_menu" required oninvalid="this.setCustomValidity('Silakan Masukkan Nama Menu')" oninput="this.setCustomValidity('')">
                        <option selected disabled value="">Pilih</option>
                        <?php foreach ($menu as $value) : ?>
                            <option value="<?= $value['id_menu']; ?>" data-category="<?= $value['kategori']; ?>"><?= ucwords($value['nama_menu']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi"></textarea>
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
<?php foreach ($paket_menu as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_paket_menu']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('admin/edit_paket_menu/' . $value['id_paket_menu']) ?>
                <?= form_hidden('id_paket_menu', $value['id_paket_menu']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_paket">Nama Paket</label>
                        <select class="form-control" id="id_paket" name="id_paket" required oninvalid="this.setCustomValidity('Silakan Pilih Nama Paket')" oninput="this.setCustomValidity('')">
                            <option value="">Pilih</option>
                            <?php foreach ($paket as $data) : ?>
                                <option value="<?= $data['id_paket']; ?>" <?= ($data['id_paket'] == $value['id_paket']) ? 'selected' : '' ?>><?= ucwords($data['nama_paket']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_menu">Nama Menu</label>
                        <select class="form-control" id="id_menu" name="id_menu" required oninvalid="this.setCustomValidity('Silakan Pilih Nama Paket')" oninput="this.setCustomValidity('')">
                            <option value="">Pilih</option>
                            <?php foreach ($menu as $data) : ?>
                                <option value="<?= $data['id_menu']; ?>" <?= ($data['id_menu'] == $value['id_menu']) ? 'selected' : '' ?>><?= ucwords($data['nama_menu']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi"><?= $value['deskripsi']; ?></textarea>
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
    document.getElementById('id_paket').addEventListener('change', function() {
        var selectedCategory = this.options[this.selectedIndex].text.toLowerCase().includes('prasmanan') ? 'prasmanan' : '';
        var menuOptions = document.getElementById('id_menu').options;

        for (var i = 0; i < menuOptions.length; i++) {
            var option = menuOptions[i];
            if (selectedCategory === 'prasmanan') {
                option.style.display = option.getAttribute('data-category') === 'prasmanan' ? 'block' : 'none';
            } else {
                option.style.display = option.getAttribute('data-category') !== 'prasmanan' ? 'block' : 'none';
            }
        }

        document.getElementById('id_menu').value = ''; // Reset menu selection
    });
</script>