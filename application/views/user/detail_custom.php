<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">detail menu paket</h2>
            </div>
        </div>
    </div>
</section>

<section style="padding: 150px 0px;">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="col-12 col-md-6">
                <img src="<?= base_url('assets/img/upload_paket/' . $paket['foto']); ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-12 col-md-6 mt-4 mt-md-0">
                <div class="card">
                    <div class="card-body">
                        <?= form_open('user/addToCartCustom/' . $paket['id_paket']); ?>
                        <div class="row mb-2">
                            <div class="col-5">Nama Paket</div>
                            <div class="col-7">: <?= ucwords($paket['nama_paket']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">Harga</div>
                            <div class="col-7">: Rp <?= number_format($paket['harga']); ?>/Porsi</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">Minimal Pemesanan</div>
                            <div class="col-7">: <?= ucwords($paket['minimal_pemesanan']); ?> Box</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">Menu</div>
                            <div class="col-7">
                                : <?php foreach ($menu as $data) : ?>
                                    <?php if ($data != end($menu)) : ?>
                                        <?= ucwords($data['nama_menu']); ?>,
                                    <?php else : ?>
                                        <?= ucwords($data['nama_menu']); ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col-5">Jumlah</div>
                            <div class="col-7 d-flex align-items-center gap-1">
                                : <input type="number" min="<?= $paket['minimal_pemesanan'];?>" class="form-control" id="jumlah" name="jumlah" placeholder="Min. <?= $paket['minimal_pemesanan'];?>" required 
                                    oninvalid="if(this.value === '') this.setCustomValidity('Jumlah tidak boleh kosong') 
                                                else if(this.value < <?= $paket['minimal_pemesanan'];?>) this.setCustomValidity('Jumlah tidak boleh kurang dari <?= $paket['minimal_pemesanan'];?>')" 
                                    oninput="this.setCustomValidity('')"> 
                            </div>
                        </div>
                        <?php
                        $grouped_menu = [];
                        foreach ($custom_menu as $item) {
                            $grouped_menu[$item['id_menu']][] = $item;
                        }

                        foreach ($grouped_menu as $menu_id => $items) :
                            $first_item = $items[0];
                        ?>
                            <div class="row mb-2 align-items-center">
                                <div class="col-5">Custom <?= ucwords($first_item['nama_menu']); ?></div>
                                <div class="col-7 d-flex align-items-center gap-1">
                                    :
                                    <select class="form-select" name="custom_item[<?= $menu_id; ?>]" required oninvalid="this.setCustomValidity('Silakan Pilih Menu Custom Anda')" oninput="this.setCustomValidity('')">
                                        <option selected disabled value="">Pilih</option>
                                        <?php foreach ($items as $item) : ?>
                                            <option value="<?= $item['id_item']; ?>"><?= ucwords($item['nama_item']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-hijau"><i class="bi bi-cart-fill"></i> Add To Cart</button>
                            <a href="<?= base_url('paket'); ?>" class="btn btn-secondary">Kembali</a>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>