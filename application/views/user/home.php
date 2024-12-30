<style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<section id="hero" class="hero">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center vh-100">
                <h1 class="text-center text-capitalize px-5" style="font-size: 40px; font-weight: 600;">"Catering enak, sehat, dan bergizi untuk memenuhi acara kalian"</h1>
            </div>
        </div>
    </div>
</section>

<section class="tentang_kami" style="padding: 150px 0px;">
    <div class="container">
        <h3 class="text-center text-capitalize mb-5">Tentang Kami</h3>
        <div class="row d-flex justify-content-center align-items-stretch">
            <div class="col-12 col-lg-6 d-flex align-items-center pe-5">
                <img src="<?= base_url('assets/img/logo/about.jpg'); ?>" class="img-fluid rounded-2 shadow" alt="" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-12 col-lg-6 mt-4 mt-md-0 d-flex align-items-center">
                <div style="text-align: justify;">
                    <p>PT. Barokah Amanah Catering adalah sebuah perusahaan yang bergerak di bidang jasa boga yang telah berdiri sejak tahun 1997 oleh Ibu Hj. Rasmawati sebagai pemilik. Diawal berdirinya, Barokah Catering berkerjasama dengan PT. Dharma Polimetal dengan order 50 Porsi hingga 1.250 Porsi. Dengan perkembangan peraturan pemerintah Tahun 2012, Barokah Catering merubah legalitasnya menjadi CV. Barokah. CV. Barokah berkerjasama dengan lebih dari 10 Perusahaan di wilayah Kabupaten Tangerang dengan order mencapai mencapai 8.000 porsi per-hari dan memiliki 60 orang karyawan.</p>
                    <p>Pada Agustus 2018, CV. Barokah meningkatkan legalitas usaha untuk mengikuti aturan perusahaan customer dan perkembangan secara global menjadi PT. Barokah Amanah Catering dengan memiliki tenaga kerja yang profesional dan berpengalaman di bidangnya yang saat ini jumlahnya lebih dari 100 orang, termasuk spesialisasi fungsi secara keseluruhan dan keahlian dalam penyajian makanan yang sehat dan higienis.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 150px 0px;">
    <div class="container">
        <h3 class="text-center text-capitalize mb-5">pertanyaan yang sering di ajukan</h3>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button btn-hijau" type="button" data-bs-toggle="collapse" data-bs-target="#satu" aria-expanded="true" aria-controls="satu">
                                1. Bagaimana cara memesan catering?
                            </button>
                        </h2>
                        <div id="satu" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                Anda dapat memesan catering dengan mengunjungi website kami, mendaftar atau login ke akun Anda, memilih paket catering yang diinginkan, mengisi formulir pemesanan, dan melakukan pembayaran.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dua" aria-expanded="false" aria-controls="dua">
                                2. Apa saja metode pembayaran yang tersedia?
                            </button>
                        </h2>
                        <div id="dua" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                Kami menerima berbagai metode pembayaran, termasuk transfer bank dan cash. Informasi lebih lanjut akan diberikan saat Anda melakukan pemesanan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tiga" aria-expanded="false" aria-controls="tiga">
                                3. Apakah saya bisa memesan catering untuk acara di luar kota?
                            </button>
                        </h2>
                        <div id="tiga" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                Layanan catering kami saat ini hanya tersedia untuk daerah tertentu, yaitu untuk kota Tangerang, Serang dan Cilegon.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#empat" aria-expanded="false" aria-controls="empat">
                                4. Berapa lama waktu pemesanan yang diperlukan sebelum acara?
                            </button>
                        </h2>
                        <div id="empat" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                Kami merekomendasikan untuk melakukan pemesanan setidaknya 3 hari sebelum acara untuk memastikan persiapan yang optimal.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lima" aria-expanded="false" aria-controls="lima">
                                5. Bagaimana cara mengetahui status pemesanan saya?
                            </button>
                        </h2>
                        <div id="lima" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                Anda dapat melihat status pemesanan pada halaman transaksi pesanan yang berada di akun anda.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#enam" aria-expanded="false" aria-controls="enam">
                                6. Bisakah saya mengubah atau membatalkan pesanan setelah konfirmasi?
                            </button>
                        </h2>
                        <div id="enam" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                Perubahan atau pembatalan pesanan dapat dilakukan sesuai dengan kebijakan kami. Harap hubungi kontak kami.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tujuh" aria-expanded="false" aria-controls="tujuh">
                                7. Apakah ada biaya tambahan untuk pengiriman?
                            </button>
                        </h2>
                        <div id="tujuh" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                Biaya pengiriman sudah termasuk pemesanan paket catering, jadi tidak ada tambahan biaya.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lokasi" style="padding: 150px 0px;">
    <div class="container">
        <h3 class="text-center text-capitalize mb-5">Lokasi Kami</h3>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5060523106185!2d106.45825117387652!3d-6.196764960705535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e42016746337845%3A0xf4e61edc0eca5ddc!2sBAROKAH%20AMANAH%20CATERING!5e0!3m2!1sid!2sid!4v1718629633373!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>

<section class="feedback" style="padding: 150px 0px; background-color: #fff;">
    <div class="container">
        <h3 class="text-center text-capitalize mb-5">feedback</h3>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="card">
                    <div class="card-body">
                        <?= form_open('user/tambah_feedback'); ?>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="rating" style="display: flex; flex-direction: row-reverse; justify-content: center;">
                                <input type="radio" id="star5" name="rating" value="1" required style="display: none;" />
                                <label for="star5" title="Sempurna" style="font-size: 2rem; color: #ddd; cursor: pointer; margin: 0 5px;">&#9733;</label>
                                <input type="radio" id="star4" name="rating" value="2" required style="display: none;" />
                                <label for="star4" title="Bagus" style="font-size: 2rem; color: #ddd; cursor: pointer; margin: 0 5px;">&#9733;</label>
                                <input type="radio" id="star3" name="rating" value="3" required style="display: none;" />
                                <label for="star3" title="Cukup" style="font-size: 2rem; color: #ddd; cursor: pointer; margin: 0 5px;">&#9733;</label>
                                <input type="radio" id="star2" name="rating" value="4" required style="display: none;" />
                                <label for="star2" title="Kurang" style="font-size: 2rem; color: #ddd; cursor: pointer; margin: 0 5px;">&#9733;</label>
                                <input type="radio" id="star1" name="rating" value="5" required style="display: none;" />
                                <label for="star1" title="Sangat Buruk" style="font-size: 2rem; color: #ddd; cursor: pointer; margin: 0 5px;">&#9733;</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="3" placeholder="Berikan pesan" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-hijau">Kirim</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="testimoni" style="padding: 150px 0px; background-color: #fff;">
    <div class="container">
        <h3 class="text-center text-capitalize mb-5">testimoni</h3>
        <div class="row">
            <div class="col-12">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($feedback as $value) : ?>
                            <div class="swiper-slide">
                                <div class="card shadow-sm" style="width: 25rem; height: 18rem;">
                                    <div class="card-body p-4 d-flex align-items-center justify-content-center">
                                        <blockquote class="blockquote text-center mb-0">
                                            <p>"<?= ucwords($value['pesan']); ?>."</p>
                                            <footer class="blockquote-footer"><?= ucwords($value['nama_lengkap']); ?></footer>
                                            <div class="rating" style="display: flex; justify-content: center; margin-top: 10px;">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <span style="font-size: 1.5rem; color: <?= $i <= $value['rating'] ? '#f5c518' : '#ddd'; ?>;">&#9733;</span>
                                                <?php endfor; ?>
                                            </div>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="text-white" style="background-color: #095B34;">
    <div class="container pt-4 pb-2">
        <div class="row d-flex justify-content-between">
            <div class="col-12 col-md-6">
                <h1 class="text-uppercase text-cream-tua">barokah amanah catering</h1>
                <p style="font-size: 16px; font-weight: 300; text-align: justify;">PT. Barokah Amanah Catering adalah sebuah perusahaan yang bergerak di bidang jasa boga yang telah berdiri sejak tahun 1997 oleh Ibu Hj. Rasmawati sebagai pemilik. Diawal berdirinya, Barokah Catering berkerjasama dengan PT. Dharma Polimetal dengan order 50 Porsi hingga 1.250 Porsi.</p>
            </div>
            <div class="col-12 col-md-3 mt-5 mt-md-0">
                <h5 class="text-capitalize text-cream-tua mb-4">Link Tautan</h5>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li>
                        <a href="<?= base_url('home'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> Beranda</a>
                    </li>
                    <li>
                        <a href="<?= base_url('paket'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> Paket</a>
                    </li>
                    <li>
                        <a href="<?= base_url('about'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> Tentang Kami</a>
                    </li>
                    <li>
                        <a href="<?= base_url('faq'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> FAQ</a>
                    </li>
                    <li>
                        <a href="<?= base_url('kontak'); ?>" class="text-white"><i class="bi bi-chevron-right"></i> Kontak</a>
                    </li>
                </ul>
            </div>
            <p class="text-center text-white" style="font-size: 15px; font-weight: 300; padding: 50PX 0 0 0;">Copyright &copy; <?= date('Y'); ?> Barokah Amanah Catering</p>
        </div>
    </div>
</footer>

<script>
    // JavaScript untuk mengatur warna bintang saat dipilih
    document.querySelectorAll('.rating label').forEach(function(star) {
        star.addEventListener('click', function() {
            var prevSiblings = this.previousElementSibling;
            var nextSiblings = this.nextElementSibling;
            
            // Hapus warna semua bintang
            document.querySelectorAll('.rating label').forEach(function(star) {
                star.style.color = '#ddd';
            });

            // Warna bintang yang dipilih dan sebelumnya
            this.style.color = '#f5c518';
            while (prevSiblings) {
                if (prevSiblings.tagName === 'LABEL') {
                    prevSiblings.style.color = '#f5c518';
                }
                prevSiblings = prevSiblings.previousElementSibling;
            }

            // Warna bintang setelahnya
            while (nextSiblings) {
                if (nextSiblings.tagName === 'LABEL') {
                    nextSiblings.style.color = '#ddd';
                }
                nextSiblings = nextSiblings.nextElementSibling;
            }
        });
    });
</script>