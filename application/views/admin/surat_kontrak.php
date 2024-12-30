<div class="container-fluid">
    <div class="row">
        <h4 class="text-center text-uppercase">Surat Perjanjian Kerjasama <br> PT Barokah Amanah Catering</h4>
        <hr style="border: 1px solid black;">

        <div class="row mt-5">
            <p class="mb-4">Yang bertanda tangan dibawah ini :</p>
            <div class="col-4 text-capitalize fw-semibold" style="font-size: 14px;">
                <p class="mb-2">nama perusahaan</p>
                <p class="mb-2">no. telp</p>
                <p class="mb-2">email</p>
                <p class="mb-2">nama perwakilan</p>
                <p class="mb-2">jabatan</p>
                <p class="mb-2">alamat</p>
            </div>
            <div class="col-8 text-capitalize fw-semibold" style="font-size: 14px;">
                <p class="mb-2">: barokah amanah catering</p>
                <p class="mb-2">: 082260909628</p>
                <p class="mb-2">: barokahamanahcatering@gmail.com</p>
                <p class="mb-2">: yanti susanti</p>
                <p class="mb-2">: staff administrasi umum</p>
                <p class="mb-2">: Jl. Raya Serang, Kp. Talagasari RT.005/02 Ds. Talagasari Kec. Balaraja Kab. Tangerang, Banten. 15610</p>
            </div>
        </div>

        <div class="row mt-5">
            <p class="mb-4">Selanjutnya disebut sebagai PIHAK PERTAMA:</p>
            <div class="col-4 text-capitalize fw-semibold" style="font-size: 14px;">
                <p class="mb-2">nama perusahaan klien</p>
                <p class="mb-2">no. telp</p>
                <p class="mb-2">email</p>
                <p class="mb-2">nama perwakilan</p>
                <p class="mb-2">jabatan</p>
                <p class="mb-2">alamat</p>
            </div>
            <div class="col-8 text-capitalize fw-semibold" style="font-size: 14px;">
                <p class="mb-2">: <?= $kontrak['nama_lengkap'] ?></p>
                <p class="mb-2">: <?= $kontrak['no_telp'] ?></p>
                <p class="mb-2">: <?= $kontrak['email'] ?></p>
                <p class="mb-2">: <?= $kontrak['nama_perwakilan'] ?></p>
                <p class="mb-2">: marketing</p>
                <p class="mb-2">: <?= $kontrak['alamat'] ?></p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <p>Selanjutnya disebut <b>PIHAK KEDUA.</b></p>
                <p>Kedua belah pihak sepakat bekerja sama dalam pengelolaan pengadaan catering untuk Hotel Aston Pasteur dengan ketentuan kesepakatan sebagai berikut :</p>
            </div>
        </div>
        
        <div class="row" style="margin-top: 250px;">
            <div class="col-12">
                <p class="text-center fw-semibold">Pasal 1</p>
                <p class="text-center text-uppercase fw-semibold">Maksud dan Tujuan</p>
                <p>Pihak Pertama dan Pihak Kedua sepakat untuk menjalin kerja sama dalam penyediaan jasa catering untuk kebutuhan Makan Karyawan yang diselenggarakan oleh Pihak Kedua.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <p class="text-center fw-semibold">Pasal 2</p>
                <p class="text-center text-uppercase fw-semibold">lingkup pekerjaan</p>
                <ol>
                    <li>
                        <p>Pihak Pertama akan menyediakan paket catering dengan harga Rp. <?= $kontrak['harga_paket'] ?> sesuai dengan permintaan Pihak Kedua.</p>
                    </li>
                    <li>
                        <p>Jumlah porsi yang disediakan adalah sebanyak 100 Porsi untuk setiap Hari</p>
                    </li>
                    <li>
                        <p>Pengiriman makanan akan dilakukan ke <?= $kontrak['nama_lengkap'] ?> pada waktu yang telah disepakati</p>
                    </li>
                </ol>
                
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <p class="text-center fw-semibold">Pasal 3</p>
                <p class="text-center text-uppercase fw-semibold">kewajiban dan tanggung jawab</p>
                <ol>
                    <li>
                        <p>Pihak Pertama bertanggung jawab atas kualitas makanan dan minuman yang disediakan serta tepat waktu dalam pengiriman.</p>
                    </li>
                    <li>
                        <p>Pihak Kedua bertanggung jawab atas pembayaran sesuai dengan ketentuan yang telah disepakati.</p>
                    </li>
                </ol>
                
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <p class="text-center fw-semibold">Pasal 4</p>
                <p class="text-center text-uppercase fw-semibold">jangka waktu</p>
                <p>Perjanjian ini berlaku sejak tanggal <?= tanggalIndonesia($kontrak['tanggal_awal']) ?> s/d <?= tanggalIndonesia($kontrak['tanggal_akhir']) ?>.</p>
            </div>
        </div>
        <div class="row" style="margin-top: 200px;">
            <div class="col-12">
                <p class="text-center fw-semibold">Pasal 5</p>
                <p class="text-center text-uppercase fw-semibold">penyelesaian perselisihan</p>
                        <p>Setiap perselisihan yang timbul dari pelaksanaan perjanjian ini akan diselesaikan secara musyawarah untuk mufakat.</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <p class="text-center fw-semibold">Pasal 6</p>
                <p class="text-center text-uppercase fw-semibold">penutup</p> 
                        <p>Surat kontrak kerja sama ini dibuat dalam rangkap dua, masing-masing pihak menerima satu rangkap dan mempunyai kekuatan hukum yang sama.</p>
            </div>
        </div>
        <div class="row" style="margin-top: 100px;">
        <div class="col-6 text-center">
            <p style="font-size: 15px;">Anto,</p>
            <p>(............................................)</p>
        </div>
        <div class="col-6 text-center">
            <p style="font-size: 15px;">Yanti Susanti,</p>
            <p>(............................................)</p>
        </div>
    </div>
</div>
    </div>
</div>

<script>
    window.print();
</script>