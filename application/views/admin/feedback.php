<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th width="5%">No.</th>
                            <th width="20%">Nama Lengkap</th>
                            <th width="20%">Email</th>
                            <th width="50%">Pesan</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($feedback as $key => $value) : ?>
                            <tr align="center">
                                <td><?= $key + 1 ?>.</td>
                                <td><?= ucwords($value['nama_lengkap']); ?></td>
                                <td><?= ucwords($value['email']); ?></td>
                                <td>"<?= ucwords($value['pesan']); ?>."</td>
                                <td>
                                    <a href="<?= base_url('admin/hapus_feedback/' . $value['id_feedback']); ?>" class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>