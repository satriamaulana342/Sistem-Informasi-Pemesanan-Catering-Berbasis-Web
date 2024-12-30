<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase fw-semibold">informasi pembayaran</h2>
            </div>
        </div>
    </div>
</section>

<section style="padding: 50px 0px;">
    <div class="container">
        <?= $this->session->flashdata('pesan'); ?>
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Rincian Pemesanan</h6>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th scope="col">Nama Paket</th>
                                    <th scope="col">Komposisi</th>
                                    <th scope="col">Item Custom</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail_pesanan as $data) : ?>
                                    <tr align="center">
                                        <td><?= ucwords($data['nama_paket']); ?></td>
                                        <td><?= ucwords($data['nama_menu']); ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <?php
                                                if (!empty($data['custom_item'])) {
                                                    $custom_items = explode(',', $data['custom_item']);
                                                    $formatted_items = array_map(function ($item) {
                                                        return trim(ucwords($item));
                                                    }, $custom_items);
                                                    $items_string = implode(', ', $formatted_items);
                                                    echo "<span class='text-start'>" . $items_string . "</span>";
                                                } else {
                                                    echo "<span class='text-muted'>-</span>";
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td><?= number_format($data['jumlah']); ?></td>
                                        <td>Rp <?= number_format($data['harga']); ?></td>
                                        <td>Rp <?= number_format($data['harga'] * $data['jumlah']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr align="center">
                                    <th colspan="4">Total Bayar</th>
                                    <th colspan="21">Rp <?= number_format($data['total']); ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- KONDISI WAKTU PEMBAYARAN -->
            <!-- JIKA METODE TRANSFER OPSI LUNAS -->
            <?php if ($data['metode_pembayaran'] == 'transfer' && $data['opsi_pembayaran'] == 'lunas') : ?>

                <!-- JIKA BELUM UPLOAD BUKTI TRANSFER LUNAS -->
                <?php if (empty($bukti_transfer_lunas)) : ?>
                    <div class="col-12 text-center mt-5">
                        <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan upload bukti pembayaran:</h5>
                        <div id="countdown" class="digital-clock mt-3"></div>
                        <div id="tombolKembali" style="display: none;" class="mt-4">
                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary shadow-sm">Kembali</a>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- JIKA METODE TRANSFER OPSI DP -->
            <?php elseif ($data['metode_pembayaran'] == 'transfer' && $data['opsi_pembayaran'] == 'dp') : ?>

                <!-- JIKA BELUM UPLOAD BUKTI TRANSFER DP AWAL -->
                <?php if (empty($bukti_transfer_dp_awal)) : ?>
                    <div class="col-12 text-center mt-5">
                        <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan upload bukti DP awal:</h5>
                        <div id="countdown" class="digital-clock mt-3"></div>
                        <div id="tombolKembali" style="display: none;" class="mt-4">
                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary shadow-sm">Kembali</a>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- JIKA SUDAH UPLOAD BUKTI TRANSFER DP AWAL, STATUS PEMBAYARAN DITERIMA DAN BELUM UPLOAD BUKTI DP AKHIR -->
                <?php if (!empty($bukti_transfer_dp_awal) && $data['status_pembayaran'] == 'diterima' && empty($bukti_transfer_dp_akhir)) : ?>
                    <div class="col-12 text-center mt-5">
                        <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan upload bukti DP akhir:</h5>
                        <div id="waktu_dp_akhir" class="digital-clock mt-3"></div>
                    </div>
                <?php endif; ?>


                <!-- JIKA CASH TRANSFER OPSI LUNAS -->
            <?php elseif ($data['metode_pembayaran'] == 'cash' && $data['opsi_pembayaran'] == 'lunas') : ?>

                <!-- JIKA BELUM BAYAR CASH -->
                <?php if ($data['status_pembayaran'] == 'belum diterima') : ?>
                    <div class="col-12 text-center mt-5">
                        <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan pembayaran cash:</h5>
                        <div id="countdown" class="digital-clock mt-3"></div>
                        <div id="tombolKembali" style="display: none;" class="mt-4">
                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary shadow-sm">Kembali</a>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- JIKA CASH TRANSFER OPSI DP -->
            <?php elseif ($data['metode_pembayaran'] == 'cash' && $data['opsi_pembayaran'] == 'dp') : ?>

                <!-- JIKA BELUM BAYAR DP AWAL -->
                <?php if ($data['status_pembayaran'] == 'belum diterima') : ?>
                    <div class="col-12 text-center mt-5">
                        <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan pembayaran DP Awal:</h5>
                        <div id="countdown" class="digital-clock mt-3"></div>
                        <div id="tombolKembali" style="display: none;" class="mt-4">
                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary shadow-sm">Kembali</a>
                        </div>
                    </div>

                    <!-- JIKA BELUM BAYAR DP AKHIR -->
                <?php elseif ($data['status_pembayaran'] == 'diterima') : ?>
                    <div class="col-12 text-center mt-5">
                        <h5 class="fw-semibold text-capitalize">Batas waktu untuk melakukan pembayaran DP Akhir:</h5>
                        <div id="waktu_dp_akhir" class="digital-clock mt-3"></div>
                    </div>
                <?php endif; ?>

            <?php endif; ?>


            <!-- UPLOAD BUKTI -->
            <div id="uploadSection" class="col-12 text-center mt-5">
                <div class="text-center mt-2">

                    <!-- METODE PEMBAYARAN CASH, OPSI PEMBAYARAN DP -->
                    <?php if ($data['metode_pembayaran'] == 'cash' && $data['opsi_pembayaran'] == 'dp') : ?>

                        <p class="fw-semibold">Untuk melakukan proses pesanan Anda, silahkan melakukan pembayaran <br> dengan cara datang langsung ke Toko kami.</p>

                        <!-- JIKA BELUM BAYAR DP AWAL -->
                        <?php if ($data['status_pembayaran'] == 'belum diterima') : ?>
                            <div class="my-5">
                                <p>Jumlah DP Awal yang harus Anda bayar sebesar :</p>
                                <h4 class="fw-semibold">Rp <?= number_format($data['uang_muka']); ?>,-</h4>
                            </div>

                            <!-- JIKA BELUM BAYAR DP AKHIR -->
                        <?php elseif ($data['status_pembayaran'] == 'diterima') : ?>
                            <div class="my-5">
                                <p>Jumlah DP Akhir yang harus Anda bayar sebesar :</p>
                                <h4 class="fw-semibold">Rp <?= number_format(max(0, $data['total'] - $data['uang_muka'])); ?>,-</h4>
                            </div>
                        <?php endif; ?>
                        <div>
                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-hijau shadow-sm">Cek Status Pembayaran</a>
                        </div>

                        <!-- METODE PEMBAYARAN CASH, OPSI PEMBAYARAN LUNAS -->
                    <?php elseif ($data['metode_pembayaran'] == 'cash' && $data['opsi_pembayaran'] == 'lunas') : ?>
                        <p class="fw-semibold">Untuk melakukan proses pesanan Anda, silahkan melakukan pembayaran <br> dengan cara datang langsung ke Toko kami.</p>
                        <div class="my-5">
                            <p>Jumlah yang harus Anda bayar sebesar :</p>
                            <h4 class="fw-semibold">Rp <?= number_format($data['total']); ?>,-</h4>
                        </div>
                        <div>
                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-hijau shadow-sm">Cek Status Pembayaran</a>
                        </div>

                        <!-- METODE PEMBAYARAN TRANSFER, OPSI PEMBAYARAN DP -->
                    <?php elseif ($data['metode_pembayaran'] == 'transfer' && $data['opsi_pembayaran'] == 'dp') : ?>

                        <!-- JIKA STATUS PEMBAYARAN DITOLAK -->
                        <?php if ($data['status_pembayaran'] == 'ditolak') : ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Pembayaran anda telah ditolak!</strong> <?= $data['keterangan_ditolak']; ?>.
                            </div>
                        <?php endif; ?>

                        <p class="fw-semibold">Untuk melakukan proses pesanan Anda, silahkan melakukan pembayaran <br> dengan cara Transfer ke nomor rekening dibawah ini :</p>
                        <div class="row d-flex justify-content-center align-items-center mt-5">
                            <div class="col-12 col-md-4 pt-1">
                                <img src="<?= base_url('assets/img/logo/Bank-BCA.png'); ?>" alt="" class="img-fluid" width="200">
                                <p class="fw-medium mt-3">7111-612-777 a/n Barokah Amanah Catering</p>
                            </div>
                            <div class="col-12 col-md-4">
                                <img src="<?= base_url('assets/img/logo/Bank-Mandiri.png'); ?>" alt="" class="img-fluid" width="250">
                                <p class="fw-medium mt-3">176-000-235-2894 a/n Sugewa Adlian</p>
                            </div>
                        </div>

                        <?php if ($data['status_pembayaran'] != 'diterima' && $data['status_pengiriman'] == 'pending') : ?>
                            <div class="my-5">
                                <p>Jumlah DP Awal yang harus Anda bayar sebesar :</p>
                                <h4 class="fw-semibold">Rp <?= number_format($data['uang_muka']); ?>,-</h4>
                            </div>
                        <?php endif; ?>

                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-md-6">
                                <?php if ($data['status_pembayaran'] != 'diterima' && $data['status_pengiriman'] == 'pending') : ?>
                                    <?= form_open_multipart('user/transfer_dp_awal') ?>
                                    <?= form_hidden('kode_pesanan', $data['kode_pesanan']) ?>
                                    <?= form_hidden('id_transaksi', $id_transaksi) ?>
                                    <div class="mb-3">
                                        <label for="bukti_transfer_dp_awal" class="form-label">Silahkan upload bukti DP awal dibawah ini :</label>
                                        <input class="form-control" type="file" id="bukti_transfer_dp_awal" name="bukti_transfer_dp_awal" required oninvalid="this.setCustomValidity('Silakan Upload Bukti Pembayaran Anda')" oninput="this.setCustomValidity('')">
                                    </div>
                                    <div class="d-grid gap-2 mt-4">
                                        <button class="btn btn-hijau shadow-sm">
                                            <?php
                                            if (empty($bukti_transfer_dp_awal)) {
                                                echo 'Upload Bukti DP Awal';
                                            } elseif ($data['status_pembayaran'] == 'ditolak') {
                                                echo 'Upload Ulang Bukti DP Awal';
                                            } else {
                                                echo 'Upload Ulang Bukti DP Awal';
                                            }
                                            ?>
                                        </button>
                                        <?php if (!empty($bukti_transfer_dp_awal)) : ?>
                                            <button type="button" class="btn btn-cream" data-bs-toggle="modal" data-bs-target="#bukti_dp_awal">Lihat Bukti DP Awal
                                            </button>
                                        <?php endif; ?>
                                        <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary">Nanti</a>
                                    </div>
                                    <?= form_close() ?>
                                <?php endif; ?>

                                <?php if (!empty($bukti_transfer_dp_awal) && $data['status_pengiriman'] == 'proses') : ?>
                                    <div class="my-5">
                                        <p>Jumlah DP Akhir yang harus Anda bayar sebesar :</p>
                                        <h4 class="fw-semibold">Rp <?= number_format(max(0, $data['total'] - $data['uang_muka'])); ?>,-</h4>
                                    </div>
                                    <?= form_open_multipart('user/transfer_dp_akhir') ?>
                                    <?= form_hidden('kode_pesanan', $data['kode_pesanan']) ?>
                                    <?= form_hidden('id_transaksi', $id_transaksi) ?>
                                    <div class="mt-5">
                                        <div class="mb-3">
                                            <label for="bukti_transfer_dp_akhir" class="form-label">Silahkan upload bukti pembayaran DP akhir dibawah ini :</label>
                                            <input class="form-control" type="file" id="bukti_transfer_dp_akhir" name="bukti_transfer_dp_akhir" required oninvalid="this.setCustomValidity('Silakan Upload Bukti Pembayaran Anda')" oninput="this.setCustomValidity('')">
                                        </div>
                                        <div class="d-grid gap-2 mt-4">
                                            <button class="btn btn-hijau shadow-sm">
                                                <?php
                                                if (empty($bukti_transfer_dp_akhir)) {
                                                    echo 'Upload Bukti DP Akhir';
                                                } elseif ($data['status_pembayaran'] == 'ditolak') {
                                                    echo 'Upload Ulang Bukti DP Akhir';
                                                } else {
                                                    echo 'Upload Ulang Bukti DP Akhir';
                                                }
                                                ?>
                                            </button>
                                            <?php if (!empty($bukti_transfer_dp_akhir)) : ?>
                                                <button type="button" class="btn btn-cream" data-bs-toggle="modal" data-bs-target="#bukti_dp_akhir">Lihat Bukti DP Akhir
                                                </button>
                                            <?php endif; ?>
                                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary">Nanti</a>
                                        </div>
                                    </div>
                                    <?= form_close() ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- METODE PEMBAYARAN TRANSFER, OPSI PEMBAYARAN LUNAS -->
                    <?php elseif ($data['metode_pembayaran'] == 'transfer' && $data['opsi_pembayaran'] == 'lunas') : ?>

                        <!-- JIKA STATUS PEMBAYARAN DITOLAK -->
                        <?php if ($data['status_pembayaran'] == 'ditolak') : ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Pembayaran anda telah ditolak!</strong> <?= $data['keterangan_ditolak']; ?>.
                            </div>
                        <?php endif; ?>

                        <p class="fw-semibold">Untuk melakukan proses pesanan Anda, silahkan melakukan pembayaran <br> dengan cara Transfer ke nomor rekening dibawah ini :</p>
                        <div class="row d-flex justify-content-center align-items-center mt-5">
                            <div class="col-12 col-md-4 pt-1">
                                <img src="<?= base_url('assets/img/logo/Bank-BCA.png'); ?>" alt="" class="img-fluid" width="200">
                                <p class="fw-medium mt-3">7111-612-777 a/n Barokah Amanah Catering</p>
                            </div>
                            <div class="col-12 col-md-4">
                                <img src="<?= base_url('assets/img/logo/Bank-Mandiri.png'); ?>" alt="" class="img-fluid" width="250">
                                <p class="fw-medium mt-3">176-000-235-2894 a/n Sugewa Adlian</p>
                            </div>
                        </div>
                        <div class="my-5">
                            <p>Jumlah yang harus Anda bayar sebesar :</p>
                            <h4 class="fw-semibold">Rp <?= number_format($data['total']); ?>,-</h4>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-md-6">
                                <?= form_open_multipart('user/transfer_lunas') ?>
                                <?= form_hidden('kode_pesanan', $data['kode_pesanan']) ?>
                                <?= form_hidden('id_transaksi', $id_transaksi) ?>
                                <div class="mb-3">
                                    <label for="bukti_transfer_lunas" class="form-label">Silahkan upload bukti pembayaran dibawah ini :</label>
                                    <input class="form-control" type="file" id="bukti_transfer_lunas" name="bukti_transfer_lunas" required oninvalid="this.setCustomValidity('Silakan Upload Bukti Pembayaran Anda')" oninput="this.setCustomValidity('')">
                                </div>
                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-hijau shadow-sm">
                                        <?php
                                        if (empty($bukti_transfer_lunas)) {
                                            echo 'Upload Bukti';
                                        } elseif ($data['status_pembayaran'] == 'ditolak') {
                                            echo 'Upload Ulang Bukti';
                                        } else {
                                            echo 'Upload Ulang Bukti';
                                        }
                                        ?>
                                    </button>
                                    <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-secondary">Nanti</a>
                                    <?php if (!empty($bukti_transfer_lunas)) : ?>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bukti_lunas">Lihat Bukti Transfer
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- MODAL LIHAT BUKTI TRANSFER LUNAS -->
<div class="modal fade" id="bukti_lunas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer Lunas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/img/bukti_transfer/lunas/' . $bukti_transfer_lunas); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIHAT BUKTI DP AWAL -->
<div class="modal fade" id="bukti_dp_awal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer DP Awal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/img/bukti_transfer/dp_awal/' . $bukti_transfer_dp_awal); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIHAT BUKTI DP AKHIR -->
<div class="modal fade" id="bukti_dp_akhir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer DP Akhir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/img/bukti_transfer/dp_akhir/' . $bukti_transfer_dp_akhir); ?>" alt="" class="img-fluid" style=" width: 100%; height: 450px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>


<!-- TRANSFER LUNAS DAN DP AWAL -->
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("<?= date('Y-m-d H:i:s', strtotime($data['batas_waktu_upload'])); ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="countdown"
        document.getElementById("countdown").innerHTML = `
                <span>${("0" + hours).slice(-2)}</span><span class="separator">:</span>
                <span>${("0" + minutes).slice(-2)}</span><span class="separator">:</span>
                <span>${("0" + seconds).slice(-2)}</span>
            `;

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
            document.getElementById("uploadSection").style.display = "none";
            document.getElementById("tombolKembali").style.display = "block";

            // Allow user to see the page for an additional 5 minutes before redirecting
            setTimeout(function() {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "<?= base_url('user/pembatalanOtomatis') ?>", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        window.location.href = "<?= base_url('user/transaksi') ?>";
                    }
                };
                xhr.send("kode_pesanan=<?= $data['kode_pesanan'] ?>");
            }, 30000); // 5 minutes in milliseconds
        }
    }, 1000);
</script>

<!-- DP AKHIR -->
<script>
    var countDownDate = new Date("<?= date('Y-m-d H:i:s', strtotime($data['batas_waktu_upload'])); ?>").getTime();

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("waktu_dp_akhir").innerHTML = `
        <span>${("0" + hours).slice(-2)}</span><span class="separator">:</span>
        <span>${("0" + minutes).slice(-2)}</span><span class="separator">:</span>
        <span>${("0" + seconds).slice(-2)}</span>
    `;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("waktu_dp_akhir").innerHTML = "EXPIRED";
            document.getElementById("uploadSection").style.display = "block";

            setTimeout(function() {
                fetch("<?= base_url('user/waktuDpAKhir') ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "kode_pesanan=<?= $data['kode_pesanan'] ?>"
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data) {
                            window.location.href = "<?= base_url('user/transaksi') ?>";
                        }
                    });
            }, 30000);
        }
    }, 1000);
</script>

<style>
    .digital-clock {
        color: #fff;
        font-size: 2.5rem;
        background: linear-gradient(45deg, #4CAF50, #2196F3);
        padding: 1rem 1.5rem;
        border-radius: 10px;
        display: inline-block;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        letter-spacing: 2px;
    }

    .digital-clock span {
        display: inline-block;
        min-width: 40px;
    }

    .digital-clock .separator {
        animation: blink 1s infinite;
    }

    @keyframes blink {
        50% {
            opacity: 0;
        }
    }

    @media (max-width: 576px) {
        .digital-clock {
            font-size: 2rem;
            padding: 0.8rem 1.2rem;
        }
    }
</style>