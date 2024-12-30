<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">checkout pemesanan</h2>
            </div>
        </div>
    </div>
</section>

<section style="padding: 50px 0px;">
    <div class="container">
        <?= $this->session->flashdata('pesan'); ?>
        <div class="row">
            <?= form_open('user/checkout_pesanan') ?>
            <!-- RINCIAN PESANAN -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="fw-semibold">Rincian Pesanan</h6>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr align="center">
                                        <th scope="col">Nama Paket</th>
                                        <th scope="col" width="17%">Komposisi</th>
                                        <th scope="col" width="17%">Item Custom</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
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
                                            <td><?= ucwords($item['nama_menu']); ?></td>
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
                                            <td><?= $item['jumlah']; ?></td>
                                            <td>Rp <?= number_format($item['harga']); ?></td>
                                            <td>Rp <?= number_format($total); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr align="center">
                                        <th colspan="5">Total</th>
                                        <?= form_hidden('total', $subtotal); ?>
                                        <th>Rp <?= number_format($subtotal); ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- INFORMASI PESANAN -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="fw-semibold">Informasi Pesanan</h6>
                        <hr>
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Pelanggan</label>
                            <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" value="<?= ucwords($this->session->userdata('nama_lengkap')) ?>" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pengiriman" class="form-label">Tanggal Pengiriman</label>
                            <input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" required 
                                oninvalid="this.setCustomValidity('Silakan Pilih Tanggal Pengiriman')" 
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="waktu_pengiriman" class="form-label">Waktu Pengiriman</label>
                            <input type="time" class="form-control" id="waktu_pengiriman" name="waktu_pengiriman" required oninvalid="this.setCustomValidity('Silakan Pilih Waktu Pengiriman')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="kota_tujuan" class="form-label">Kota</label>
                            <input class="form-control" type="text" id="kota_tujuan" name="kota_tujuan" value="Tangerang" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan" class="form-select" required oninvalid="this.setCustomValidity('Silakan Pilih Kecamatan')" oninput="this.setCustomValidity('')">
                                <option disabled selected value="">Pilih</option>
                                <option value="batu ceper">Batu Ceper</option>
                                <option value="benda">Benda</option>
                                <option value="cibodas">Cibodas</option>
                                <option value="ciledug">Ciledug</option>
                                <option value="cipondoh">Cipondoh</option>
                                <option value="jatiuwung">Jatiuwung</option>
                                <option value="karangtengah">Karangtengah</option>
                                <option value="karawaci">Karawaci</option>
                                <option value="larangan">Larangan</option>
                                <option value="neglasari">Neglasari</option>
                                <option value="periuk">Periuk</option>
                                <option value="pinang">Pinang</option>
                                <option value="tangerang">Tangerang</option>
                                <option value="balaraja">Balaraja</option>
                                <option value="cikupa">Cikupa</option>
                                <option value="cisauk">Cisauk</option>
                                <option value="curug">Curug</option>
                                <option value="gunung kaler">Gunung Kaler</option>
                                <option value="jambe">Jambe</option>
                                <option value="jayanti">Jayanti</option>
                                <option value="kelapa dua">Kelapa Dua</option>
                                <option value="kemiri">Kemiri</option>
                                <option value="kresek">Kresek</option>
                                <option value="kronjo">Kronjo</option>
                                <option value="kosambi">Kosambi</option>
                                <option value="legok">Legok</option>
                                <option value="mauk">Mauk</option>
                                <option value="mekarbaru">Mekarbaru</option>
                                <option value="pakuhaji">Pakuhaji</option>
                                <option value="panongan">Panongan</option>
                                <option value="pagedangan">Pagedangan</option>
                                <option value="pasar kemis">Pasar Kemis</option>
                                <option value="rajeg">Rajeg</option>
                                <option value="sepatan">Sepatan</option>
                                <option value="cisoka">Tangerang</option>
                                <option value="curug">Curug</option>
                                <option value="sepatan timur">Sepatan Timur</option>
                                <option value="sindang jaya">Sindang Jaya</option>
                                <option value="solear">Solear</option>
                                <option value="sukadiri">Sukadiri</option>
                                <option value="sukamulya">Sukamulya</option>
                                <option value="teluknaga">Teluknaga</option>
                                <option value="tigaraksa">Tigaraksa</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap" required oninvalid="this.setCustomValidity('Alamat Tidak Boleh Kosong')" oninput="this.setCustomValidity('')"></textarea>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="nomor telepon" required oninvalid="this.setCustomValidity('Nomor Telepon Tidak Boleh Kosong')" oninput="this.setCustomValidity('')"></input>
                        </div> -->
                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                            <select id="metode_pembayaran" name="metode_pembayaran" class="form-select" required oninvalid="this.setCustomValidity('Silakan Pilih Metode Pembayaran Anda')" oninput="this.setCustomValidity('')">
                                <option disabled selected value="">Pilih</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                            <div id="emailHelp" class="form-text text-danger">*Metode pembayaran yang telah dipilih tidak dapat diubah. Harap pastikan pilihan Anda sebelum melanjutkan.</div>
                        </div>
                        <div class="mb-3">
                            <label for="opsi_pembayaran" class="form-label">Opsi Pembayaran</label>
                            <select id="opsi_pembayaran" name="opsi_pembayaran" class="form-select opsi_pembayaran" required oninvalid="this.setCustomValidity('Silakan Pilih Opsi Pembayaran Anda')" oninput="this.setCustomValidity('')">
                                <option disabled selected value="">Pilih</option>
                                <option value="dp">DP</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>
                        <div class="mb-3 jumlahDpAwal" style="display: none;">
                            <label for="uang_muka" class="form-label">Uang Muka</label>
                            <input class="form-control uang_muka" type="number" id="uang_muka" name="uang_muka" placeholder="Masukkan Uang Muka" required oninvalid="this.setCustomValidity('Uang Muka Tidak boleh Kosong')" oninput="this.setCustomValidity('')">
                            <div id="emailHelp" class="form-text text-danger">*Minimal Uang Muka 50% dari total harga</div>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan ini bersifat opsional"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" id="total" name="total" value="<?= $subtotal ?>">
                            <button type="submit" class="btn btn-hijau">Konfirmasi</button>
                            <a href="<?= base_url('keranjang'); ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var opsiPembayaran = document.getElementById('opsi_pembayaran');
        var jumlahDpAwal = document.querySelector('.jumlahDpAwal');
        var uangMuka = document.getElementById('uang_muka');
        var totalHarga = parseFloat(document.getElementById('total').value);

        opsiPembayaran.addEventListener('change', function() {
            if (this.value === 'dp') {
                jumlahDpAwal.style.display = 'block';
                uangMuka.setAttribute('required', 'required');
                // Set placeholder untuk Uang Muka menjadi 50% dari total harga
                uangMuka.setAttribute('placeholder', 'Uang Muka Minimal: Rp ' + (totalHarga * 0.5).toFixed(0));
            } else {
                jumlahDpAwal.style.display = 'none';
                uangMuka.removeAttribute('required');
                uangMuka.setAttribute('placeholder', 'Masukkan Uang Muka');
                uangMuka.value = '';
            }
        });
    });
</script>