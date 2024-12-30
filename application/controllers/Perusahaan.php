<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // CEK KONDISI LOGIN
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        // FORMAT BULAN
        function tanggalIndonesia($tanggal)
        {
            $bulan = [
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];
            $pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Halaman Home',
            'id_user'   => $id_user,
            'user'      => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah' => $this->Model_perusahaan->getJumlahItem($id_user),
            'feedback'  => $this->Model_perusahaan->getAllFeedback(),
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/home', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function tentang_kami()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Tentang Kami',
            'id_user'   => $id_user,
            'user'      => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah' => $this->Model_perusahaan->getJumlahItem($id_user)
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/about', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function faq()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'FAQ',
            'id_user'   => $id_user,
            'user'      => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah' => $this->Model_perusahaan->getJumlahItem($id_user),
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/faq', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function kontak()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Hubungi Kami',
            'user'      => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah' => $this->Model_perusahaan->getJumlahItem($id_user),
            'id_user'   => $id_user
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/kontak', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function nota($id_pesanan_perusahaan)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Nota Pembayaran',
            'user'              => $this->Model_perusahaan->getUserById($id_user),
            'pesanan'           => $this->Model_perusahaan->getPesananById($id_pesanan_perusahaan),
            'detail_pesanan'    => $this->Model_perusahaan->getDetailPesananByIdPesanan($id_pesanan_perusahaan),
            'id_user'           => $id_user
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('perusahaan/nota', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function profile()
    {
        $id_user    = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Profile',
            'id_user'   => $id_user,
            'user'      => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah' => $this->Model_perusahaan->getJumlahItem($id_user),
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/profile', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function edit_profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email'        => $this->input->post('email'),
            'no_telp'      => $this->input->post('no_telp'),
            'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];

        $this->Model_perusahaan->updateUser($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
               Profile berhasil diedit.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('perusahaan/profile');
    }

    public function nasi_box()
    {
        $id_user    = $this->session->userdata('id_user');
        $kategori   = $this->Model_perusahaan->getAllKategori();

        $data = [
            'title'          => 'Nasi Box',
            'id_user'        => $id_user,
            'user'           => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah'      => $this->Model_perusahaan->getJumlahItem($id_user),
            'paket'          => $this->Model_perusahaan->getAllPaket($id_user),
            'status_kontrak' => $this->Model_perusahaan->cekKontrak($id_user),
            'kategori'       => [],
        ];

        foreach ($kategori as $kat) {
            if ($kat['nama_kategori'] !== 'prasmanan') {
                $data['kategori'][] = $kat;
                $data[$kat['nama_kategori']] = $this->Model_perusahaan->getPaketByPaketKategori($kat['nama_kategori'], $id_user);
            }
        }

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/paket', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function prasmanan()
    {
        $id_user    = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Prasmanan',
            'id_user'           => $id_user,
            'user'              => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah'         => $this->Model_perusahaan->getJumlahItem($id_user),
            'paket'             => $this->Model_perusahaan->getAllPaketPrasmanan($id_user),
            'status_kontrak'    => $this->Model_perusahaan->cekKontrak($id_user),
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/prasmanan', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function surat_kontrak()
    {
        $id_user    = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Surat Kontrak',
            'id_user'           => $id_user,
            'user'              => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah'         => $this->Model_perusahaan->getJumlahItem($id_user),
            // 'paket'             => $this->Model_perusahaan->getAllPaketPrasmanan($id_user),
            'kontrak'    => $this->Model_perusahaan->getKontrakById($id_user),
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/surat_kontrak', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function keranjang()
    {
        $id_user = $this->session->userdata('id_user');

        $keranjang = $this->Model_perusahaan->getKeranjangByUserId($id_user);

        foreach ($keranjang as &$item) {
            $item['menu_paket'] = $this->Model_perusahaan->getNamaMenuByIdPaket($item['id_paket']);
        }

        $data = [
            'title'     => 'Keranjang Belanja',
            'id_user'   => $id_user,
            'keranjang' => $keranjang,
            'user'      => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah' => $this->Model_perusahaan->getJumlahItem($id_user),
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/keranjang', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function editKeranjang()
    {
        $id_keranjang   = $this->input->post('id_keranjang');
        $jumlah         = $this->input->post('jumlah');
        $custom_items   = $this->input->post('custom_item');

        if ($jumlah < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Jumlah tidak boleh kurang dari 1!</div>');
            redirect('perusahaan/keranjang');
        }

        // Ambil data keranjang yang ada
        $existing_cart_item = $this->Model_perusahaan->getKeranjangById($id_keranjang);

        if ($existing_cart_item) {
            // Jika paket custom
            if ($existing_cart_item['custom_item'] !== null) {
                // Proses custom item
                $nama_item_string = '';
                foreach ($custom_items as $id_item) {
                    $item = $this->Model_perusahaan->getItemById($id_item);
                    if ($item) {
                        $nama_item_string .= $item->nama_item . ', ';
                    }
                }
                $nama_item_string = rtrim($nama_item_string, ', ');

                $data_update = [
                    'jumlah' => $jumlah,
                    'custom_item' => $nama_item_string
                ];
            } else {
                // Jika bukan paket custom
                $data_update = [
                    'jumlah' => $jumlah
                ];
            }

            $this->Model_perusahaan->editKeranjang($id_keranjang, $data_update);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Item keranjang berhasil diperbarui!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Item keranjang tidak ditemukan!</div>');
        }

        redirect('perusahaan/keranjang');
    }

    public function hapusKeranjang($id_keranjang)
    {
        $this->Model_perusahaan->deleteItem($id_keranjang);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              Item berhasil dihapus!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
        redirect('perusahaan/keranjang');
    }

    public function detail($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Detail Paket',
            'id_user'   => $id_user,
            'user'      => $this->Model_perusahaan->getUserById($id_user),
            'paket'     => $this->Model_perusahaan->getPaketById($id_paket),
            'menu'      => $this->Model_perusahaan->getMenuByPaketId($id_paket),
            'cekJumlah' => $this->Model_perusahaan->getJumlahItem($id_user)
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/detail_paket', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function detail_custom($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'         => 'Detail Paket',
            'id_user'       => $id_user,
            'user'          => $this->Model_perusahaan->getUserById($id_user),
            'paket'         => $this->Model_perusahaan->getPaketById($id_paket),
            'menu'          => $this->Model_perusahaan->getMenuByPaketId($id_paket),
            'custom_menu'   => $this->Model_perusahaan->getMenuCustomByIdPaket($id_paket),
            'cekJumlah'     => $this->Model_perusahaan->getJumlahItem($id_user),
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/detail_custom', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function detail_prasmanan($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Detail Paket',
            'id_user'   => $id_user,
            'user'      => $this->Model_perusahaan->getUserById($id_user),
            'paket'     => $this->Model_perusahaan->getPaketById($id_paket),
            'menu'      => $this->Model_perusahaan->getMenuByPaketId($id_paket),
            'cekJumlah' => $this->Model_perusahaan->getJumlahItem($id_user)
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/detail_prasmanan', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function detail_custom_prasmanan($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'         => 'Detail Paket',
            'id_user'       => $id_user,
            'user'          => $this->Model_perusahaan->getUserById($id_user),
            'paket'         => $this->Model_perusahaan->getPaketById($id_paket),
            'menu'          => $this->Model_perusahaan->getMenuByPaketId($id_paket),
            'custom_menu'   => $this->Model_perusahaan->getMenuCustomByIdPaket($id_paket),
            'cekJumlah'     => $this->Model_perusahaan->getJumlahItem($id_user),
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/detail_custom_prasmanan', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function addFeedback()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $data = [
            'pesan' => $this->input->post('pesan'),
            'rating' => $this->input->post('rating'),  // Tambahkan rating ke array data
            'id_user' => $id_user  // Simpan ID user untuk melacak siapa yang memberi feedback
        ];

        $this->Model_perusahaan->tambahFeedback($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Feedback berhasil dikirim!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
        redirect('perusahaan');
    }

    public function addToCart($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $jumlah             = $this->input->post('jumlah');

        if ($jumlah > 100) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Jumlah tidak boleh lebih dari 100
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );

            redirect('perusahaan/detail/' . $id_paket);
            return;
        }

        // Cek apakah id_paket sudah ada di keranjang sebagai paket biasa
        $existingItem = $this->Model_perusahaan->getCartItem($id_user, $id_paket);

        if ($existingItem) {
            // Jika sudah ada, update jumlah hanya untuk paket biasa
            $jumlahBaru = $existingItem['jumlah'] + $jumlah;
            $this->Model_perusahaan->updateCartRegular($id_user, $id_paket, $jumlahBaru);
        } else {
            // Jika belum ada, tambahkan sebagai paket biasa baru
            $data = [
                'id_user'       => $id_user,
                'id_paket'      => $id_paket,
                'jumlah'        => $jumlah,
                'custom_item'   => null
            ];

            $this->Model_perusahaan->addCart($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Paket berhasil ditambahkan ke keranjang!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
        redirect('perusahaan/detail/' . $id_paket);
    }

    public function addToCartCustom($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $nama_item_array    = $this->input->post('custom_item');
        $jumlah             = $this->input->post('jumlah');

        if ($jumlah > 100) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Jumlah tidak boleh lebih dari 100
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );

            redirect('perusahaan/detail_custom/' . $id_paket);
            return;
        }

        // Ambil nama_item berdasarkan id_item
        $nama_item_string = '';
        foreach ($nama_item_array as $id_item) {
            $item = $this->Model_perusahaan->getItemById($id_item);
            if ($item) {
                $nama_item_string .= $item->nama_item . ', ';
            }
        }

        $nama_item_string = rtrim($nama_item_string, ', ');

        // Cek apakah id_paket dengan custom_item yang sama sudah ada di keranjang
        $existing_cart_item = $this->Model_perusahaan->getCustomCartItem($id_user, $id_paket, $nama_item_string);

        if ($existing_cart_item) {
            // Jika sudah ada, update jumlah
            $new_jumlah = $existing_cart_item['jumlah'] + $jumlah;
            $this->Model_perusahaan->updateCartCustom($id_user, $id_paket, $new_jumlah, $nama_item_string);
        } else {
            // Jika belum ada, tambahkan item baru ke keranjang
            $data = [
                'id_user'       => $id_user,
                'id_paket'      => $id_paket,
                'jumlah'        => $jumlah,
                'custom_item'   => $nama_item_string,
            ];

            $this->Model_perusahaan->addCart($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Paket berhasil ditambahkan ke keranjang!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
        redirect('perusahaan/detail_custom/' . $id_paket);
    }

    public function addToCartPrasmanan($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $jumlah = $this->input->post('jumlah');
        
        if ($jumlah > 100) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Jumlah tidak boleh lebih dari 100
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );

            redirect('perusahaan/detail_prasmanan/' . $id_paket);
            return;
        }

        // Cek apakah id_paket sudah ada di keranjang sebagai paket biasa
        $existingItem = $this->Model_perusahaan->getCartItem($id_user, $id_paket);

        if ($existingItem) {
            // Jika sudah ada, update jumlah hanya untuk paket biasa
            $jumlahBaru = $existingItem['jumlah'] + $jumlah;
            $this->Model_perusahaan->updateCartRegular($id_user, $id_paket, $jumlahBaru);
        } else {
            // Jika belum ada, tambahkan sebagai paket biasa baru
            $data = [
                'id_user'       => $id_user,
                'id_paket'      => $id_paket,
                'jumlah'        => $jumlah,
                'custom_item'   => null
            ];

            $this->Model_perusahaan->addCart($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Paket berhasil ditambahkan ke keranjang!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
        redirect('perusahaan/detail_prasmanan/' . $id_paket);
    }

    public function addToCartCustomPrasmanan($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $nama_item_array    = $this->input->post('custom_item');
        $jumlah             = $this->input->post('jumlah');
        
        if ($jumlah > 100) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Jumlah tidak boleh lebih dari 100
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );

            redirect('perusahaan/detail_custom_prasmanan/' . $id_paket);
            return;
        }

        // Ambil nama_item berdasarkan id_item
        $nama_item_string = '';
        foreach ($nama_item_array as $id_item) {
            $item = $this->Model_perusahaan->getItemById($id_item);
            if ($item) {
                $nama_item_string .= $item->nama_item . ', ';
            }
        }

        $nama_item_string = rtrim($nama_item_string, ', ');

        // Cek apakah id_paket dengan custom_item yang sama sudah ada di keranjang
        $existing_cart_item = $this->Model_perusahaan->getCustomCartItem($id_user, $id_paket, $nama_item_string);

        if ($existing_cart_item) {
            // Jika sudah ada, update jumlah
            $new_jumlah = $existing_cart_item['jumlah'] + $jumlah;
            $this->Model_perusahaan->updateCartCustom($id_user, $id_paket, $new_jumlah, $nama_item_string);
        } else {
            // Jika belum ada, tambahkan item baru ke keranjang
            $data = [
                'id_user'       => $id_user,
                'id_paket'      => $id_paket,
                'jumlah'        => $jumlah,
                'custom_item'   => $nama_item_string,
            ];

            $this->Model_perusahaan->addCart($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Paket berhasil ditambahkan ke keranjang!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
        redirect('perusahaan/detail_custom_prasmanan/' . $id_paket);
    }

    public function checkout()
    {
        $id_user = $this->session->userdata('id_user');

        $keranjang = $this->Model_perusahaan->getKeranjangByUserId($id_user);

        // Looping menu berdasarkan id_paket
        foreach ($keranjang as &$item) {
            $item['nama_menu'] = $this->Model_perusahaan->getNamaMenuByIdPaket($item['id_paket']);
        }

        $data = [
            'title'         => 'Checkout Pemesanan',
            'user'          => $this->Model_perusahaan->getUserById($id_user),
            'cekJumlah'     => $this->Model_perusahaan->getJumlahItem($id_user),
            'id_user'       => $id_user,
            'keranjang'     => $keranjang,
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/checkout', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function checkout_pesanan()
    {
        date_default_timezone_set('Asia/Jakarta');

        $id_user = $this->session->userdata('id_user');

        $data_pesanan = [
            'id_user'               => $id_user,
            'tanggal_pemesanan'     => date('Y-m-d H:i:s'),
            'tanggal_pengiriman'    => $this->input->post('tanggal_pengiriman'),
            'kota_tujuan'           => 'tangerang',
            'kecamatan'             => $this->input->post('kecamatan'),
            'waktu_pengiriman'      => $this->input->post('waktu_pengiriman'),
            'alamat'                => $this->input->post('alamat'),
            'total'                 => $this->input->post('total'),
            'keterangan'            => $this->input->post('keterangan'),
            'status_pengiriman'     => 'pending',
        ];

        $keranjang      = $this->Model_perusahaan->getKeranjangByIdUser($id_user);
        $kode_pesanan   = $this->generateKodePesanan($keranjang);

        $data_pesanan['kode_pesanan'] = $kode_pesanan;

        $id_pesanan_perusahaan  = $this->Model_perusahaan->addPesanan($data_pesanan);

        foreach ($keranjang as $item) {
            $data_detail = [
                'id_pesanan_perusahaan'     => $id_pesanan_perusahaan,
                'id_paket'                  => $item['id_paket'],
                'jumlah'                    => $item['jumlah'],
                'custom_item'               => $item['custom_item']
            ];

            $this->Model_perusahaan->addDetailPesanan($data_detail);
        }

        $this->Model_perusahaan->deleteCart($id_user);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">Checkout berhasil! Silahkan lakukan pembayaran.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
        );

        redirect('perusahaan/transaksi');
    }

    private function generateKodePesanan($keranjang)
    {
        $hasCustom = false;
        $hasNonCustom = false;

        foreach ($keranjang as $item) {
            if (empty($item['custom_item'])) {
                $hasNonCustom = true;
            } else {
                $hasCustom = true;
            }

            if ($hasCustom && $hasNonCustom) {
                $prefix = 'PBC';
                break;
            }
        }

        if (!$hasCustom) {
            $prefix = 'PB';
        } elseif (!$hasNonCustom) {
            $prefix = 'PC';
        }

        // Mengambil kode pesanan terakhir dengan prefix yang sesuai
        $this->db->select('kode_pesanan');
        $this->db->from('tbl_pesanan_perusahaan');
        $this->db->like('kode_pesanan', $prefix, 'after');
        $this->db->order_by('kode_pesanan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $last_code = $query->row()->kode_pesanan;
            $number = (int) substr($last_code, strlen($prefix)) + 1;
        } else {
            $number = 1;
        }

        // Kembalikan kode pesanan dengan format yang benar
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function transaksi()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Transaksi Pemesanan',
            'id_user'   => $id_user,
            'user'      => $this->Model_perusahaan->getUserById($id_user),
            'pesanan'   => $this->Model_perusahaan->getPesananByUserId($id_user),
            'cekJumlah' => $this->Model_perusahaan->getJumlahItem($id_user)
        ];

        $this->load->view('templates/perusahaan/header', $data);
        $this->load->view('templates/perusahaan/navbar');
        $this->load->view('perusahaan/transaksi', $data);
        $this->load->view('templates/perusahaan/footer');
    }

    public function hapusPesanan($id_pesanan_perusahaan)
    {
        $this->Model_perusahaan->hapusPesanan($id_pesanan_perusahaan);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              Item berhasil dihapus!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
        redirect('perusahaan/transaksi');
    }
}

/* End of file Perusahaan.php */
