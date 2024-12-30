<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    // VIEW HOME
    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Halaman Home',
            'id_user'   => $id_user,
            'user'      => $this->Model_user->getUserById($id_user),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user),
            'feedback'  => $this->Model_user->getAllFeedback(),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/home', $data);
        $this->load->view('templates/user/footer');
    }

    // VIEW ABOUT US
    public function about()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Tentang Kami',
            'id_user'   => $id_user,
            'user'      => $this->Model_user->getUserById($id_user),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user)
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/about', $data);
        $this->load->view('templates/user/footer');
    }

    // public function paket()
    // {
    //     $id_user    = $this->session->userdata('id_user');
    //     $kategori   = $this->Model_user->getAllKategori();

    //     $data = [
    //         'title'     => 'Nasi Box',
    //         'id_user'   => $id_user,
    //         'user'      => $this->Model_user->getUserById($id_user),
    //         'cekJumlah' => $this->Model_user->getJumlahItem($id_user),
    //         'paket'     => $this->Model_user->getAllPaket(),
    //         'kategori'  => $kategori,
    //     ];

    //     foreach ($kategori as $kat) {
    //         $data[$kat['nama_kategori']] = $this->Model_user->getPaketByPaketKategori($kat['nama_kategori']);
    //     }

    //     $this->load->view('templates/user/header', $data);
    //     $this->load->view('templates/user/navbar');
    //     $this->load->view('user/paket', $data);
    //     $this->load->view('templates/user/footer');
    // }

    public function paket()
    {
        $id_user    = $this->session->userdata('id_user');
        $kategori   = $this->Model_user->getAllKategori();

        $data = [
            'title'     => 'Nasi Box',
            'id_user'   => $id_user,
            'user'      => $this->Model_user->getUserById($id_user),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user),
            'paket'     => $this->Model_user->getAllPaket(),
            'kategori'  => [],
        ];

        foreach ($kategori as $kat) {
            if ($kat['nama_kategori'] !== 'prasmanan') {
                $data['kategori'][] = $kat;
                $data[$kat['nama_kategori']] = $this->Model_user->getPaketByPaketKategori($kat['nama_kategori']);
            }
        }

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/paket', $data);
        $this->load->view('templates/user/footer');
    }


    public function prasmanan()
    {
        $id_user    = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Prasmanan',
            'id_user'   => $id_user,
            'user'      => $this->Model_user->getUserById($id_user),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user),
            'paket'     => $this->Model_user->getAllPaketPrasmanan(),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/prasmanan', $data);
        $this->load->view('templates/user/footer');
    }

    // VIEW FAQ
    public function faq()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'FAQ',
            'id_user'   => $id_user,
            'user'      => $this->Model_user->getUserById($id_user),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/faq', $data);
        $this->load->view('templates/user/footer');
    }

    // VIEW KONTAK
    public function kontak()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Hubungi Kami',
            'user'      => $this->Model_user->getUserById($id_user),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user),
            'id_user'   => $id_user
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/kontak', $data);
        $this->load->view('templates/user/footer');
    }

    public function profile()
    {
        $id_user    = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Profile',
            'id_user'   => $id_user,
            'user'      => $this->Model_user->getUserById($id_user),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/profile', $data);
        $this->load->view('templates/user/footer');
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

        $this->Model_user->updateUser($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
               Profile berhasil diedit.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('profile');
    }


    // VIEW DETAIL PAKET BIASA
    public function detail($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Detail Paket',
            'id_user'   => $id_user,
            'user'      => $this->Model_user->getUserById($id_user),
            'paket'     => $this->Model_user->getPaketById($id_paket),
            'menu'      => $this->Model_user->getMenuByPaketId($id_paket),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user)
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/detail_paket', $data);
        $this->load->view('templates/user/footer');
    }

    // public function detail_prasmanan($id_paket)
    // {
    //     $id_user = $this->session->userdata('id_user');

    //     $data = [
    //         'title'     => 'Detail Paket',
    //         'id_user'   => $id_user,
    //         'user'      => $this->Model_user->getUserById($id_user),
    //         'paket'     => $this->Model_user->getPaketPrasmananById($id_paket),
    //         'menu'      => $this->Model_user->getMenuPrasmananByPaketId($id_paket),
    //         'cekJumlah' => $this->Model_user->getJumlahItem($id_user)
    //     ];

    //     $this->load->view('templates/user/header', $data);
    //     $this->load->view('templates/user/navbar');
    //     $this->load->view('user/detail_prasmanan', $data);
    //     $this->load->view('templates/user/footer');
    // }

    public function detail_prasmanan($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Detail Paket',
            'id_user'   => $id_user,
            'user'      => $this->Model_user->getUserById($id_user),
            'paket'     => $this->Model_user->getPaketById($id_paket),
            'menu'      => $this->Model_user->getMenuByPaketId($id_paket),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user)
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/detail_prasmanan', $data);
        $this->load->view('templates/user/footer');
    }

    public function detail_custom_prasmanan($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'         => 'Detail Paket',
            'id_user'       => $id_user,
            'user'          => $this->Model_user->getUserById($id_user),
            'paket'         => $this->Model_user->getPaketById($id_paket),
            'menu'          => $this->Model_user->getMenuByPaketId($id_paket),
            'custom_menu'   => $this->Model_user->getMenuCustomByIdPaket($id_paket),
            'cekJumlah'     => $this->Model_user->getJumlahItem($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/detail_custom_prasmanan', $data);
        $this->load->view('templates/user/footer');
    }

    // VIEW DETAIL PAKET CUSTOM
    public function detail_custom($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'         => 'Detail Paket',
            'id_user'       => $id_user,
            'user'          => $this->Model_user->getUserById($id_user),
            'paket'         => $this->Model_user->getPaketById($id_paket),
            'menu'          => $this->Model_user->getMenuByPaketId($id_paket),
            'custom_menu'   => $this->Model_user->getMenuCustomByIdPaket($id_paket),
            'cekJumlah'     => $this->Model_user->getJumlahItem($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/detail_custom', $data);
        $this->load->view('templates/user/footer');
    }


    public function tambah_feedback()
{
    $id_user = $this->session->userdata('id_user');

    // Cek apakah user sudah login
    if (!$id_user) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
        redirect('login');
    }

    // Ambil data dari form input
    $data = [
        'pesan' => $this->input->post('pesan'),
        'rating' => $this->input->post('rating'),  // Tambahkan rating ke array data
        'id_user' => $id_user  // Simpan ID user untuk melacak siapa yang memberi feedback
    ];

    // Simpan data feedback ke database melalui model
    $this->Model_user->tambahFeedback($data);

    // Set pesan sukses
    $this->session->set_flashdata(
        'pesan',
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Feedback berhasil dikirim!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
    );

    // Redirect kembali ke halaman home
    redirect('home');
}



    // VIEW NOTA PEMBAYARAN
    public function nota($kode_pesanan)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Nota Pembayaran',
            'user'              => $this->Model_user->getUserById($id_user),
            'pesanan'           => $this->Model_user->getPesananById($kode_pesanan),
            'detail_pesanan'    => $this->Model_user->getDetailPesananByIdPesanan($kode_pesanan),
            'id_user'           => $id_user
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('user/nota', $data);
        $this->load->view('templates/user/footer');
    }

    // TAMBAH KE KERANJANG PAKET BIASA
    public function addToCart($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        // Cek apakah id_paket sudah ada di keranjang sebagai paket biasa
        $existingItem = $this->Model_user->getCartItem($id_user, $id_paket);

        if ($existingItem) {
            // Jika sudah ada, update jumlah hanya untuk paket biasa
            $jumlahBaru = $existingItem['jumlah'] + $this->input->post('jumlah');
            $this->Model_user->updateCartRegular($id_user, $id_paket, $jumlahBaru);
        } else {
            // Jika belum ada, tambahkan sebagai paket biasa baru
            $data = [
                'id_user'       => $id_user,
                'id_paket'      => $id_paket,
                'jumlah'        => $this->input->post('jumlah'),
                'custom_item'   => null
            ];

            $this->Model_user->addCart($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Paket berhasil ditambahkan ke keranjang!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
        redirect('detail/' . $id_paket);
    }

    // TAMBAH KE KERANJANG CUSTOM PAKET
    public function addToCartCustom($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $nama_item_array    = $this->input->post('custom_item');
        $jumlah             = $this->input->post('jumlah');

        // Ambil nama_item berdasarkan id_item
        $nama_item_string = '';
        foreach ($nama_item_array as $id_item) {
            $item = $this->Model_user->getItemById($id_item);
            if ($item) {
                $nama_item_string .= $item->nama_item . ', ';
            }
        }

        $nama_item_string = rtrim($nama_item_string, ', ');

        // Cek apakah id_paket dengan custom_item yang sama sudah ada di keranjang
        $existing_cart_item = $this->Model_user->getCustomCartItem($id_user, $id_paket, $nama_item_string);

        if ($existing_cart_item) {
            // Jika sudah ada, update jumlah
            $new_jumlah = $existing_cart_item['jumlah'] + $jumlah;
            $this->Model_user->updateCartCustom($id_user, $id_paket, $new_jumlah, $nama_item_string);
        } else {
            // Jika belum ada, tambahkan item baru ke keranjang
            $data = [
                'id_user'       => $id_user,
                'id_paket'      => $id_paket,
                'jumlah'        => $jumlah,
                'custom_item'   => $nama_item_string,
            ];

            $this->Model_user->addCart($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Paket berhasil ditambahkan ke keranjang!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
        redirect('detail_custom/' . $id_paket);
    }

    public function addToCartPrasmanan($id_paket)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        // Cek apakah id_paket sudah ada di keranjang sebagai paket biasa
        $existingItem = $this->Model_user->getCartItem($id_user, $id_paket);

        if ($existingItem) {
            // Jika sudah ada, update jumlah hanya untuk paket biasa
            $jumlahBaru = $existingItem['jumlah'] + $this->input->post('jumlah');
            $this->Model_user->updateCartRegular($id_user, $id_paket, $jumlahBaru);
        } else {
            // Jika belum ada, tambahkan sebagai paket biasa baru
            $data = [
                'id_user'       => $id_user,
                'id_paket'      => $id_paket,
                'jumlah'        => $this->input->post('jumlah'),
                'custom_item'   => null
            ];

            $this->Model_user->addCart($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Paket berhasil ditambahkan ke keranjang!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
        redirect('detail_prasmanan/' . $id_paket);
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

        // Ambil nama_item berdasarkan id_item
        $nama_item_string = '';
        foreach ($nama_item_array as $id_item) {
            $item = $this->Model_user->getItemById($id_item);
            if ($item) {
                $nama_item_string .= $item->nama_item . ', ';
            }
        }

        $nama_item_string = rtrim($nama_item_string, ', ');

        // Cek apakah id_paket dengan custom_item yang sama sudah ada di keranjang
        $existing_cart_item = $this->Model_user->getCustomCartItem($id_user, $id_paket, $nama_item_string);

        if ($existing_cart_item) {
            // Jika sudah ada, update jumlah
            $new_jumlah = $existing_cart_item['jumlah'] + $jumlah;
            $this->Model_user->updateCartCustom($id_user, $id_paket, $new_jumlah, $nama_item_string);
        } else {
            // Jika belum ada, tambahkan item baru ke keranjang
            $data = [
                'id_user'       => $id_user,
                'id_paket'      => $id_paket,
                'jumlah'        => $jumlah,
                'custom_item'   => $nama_item_string,
            ];

            $this->Model_user->addCart($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Paket berhasil ditambahkan ke keranjang!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
        redirect('detail_custom_prasmanan/' . $id_paket);
    }

    public function keranjang()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $keranjang = $this->Model_user->getKeranjangByUserId($id_user);

        foreach ($keranjang as &$item) {
            $item['menu_paket'] = $this->Model_user->getNamaMenuByIdPaket($item['id_paket']);
        }

        $data = [
            'title'     => 'Keranjang Belanja',
            'id_user'   => $id_user,
            'keranjang' => $keranjang,
            'user'      => $this->Model_user->getUserById($id_user),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/keranjang', $data);
        $this->load->view('templates/user/footer');
    }


    // FUNGSI EDIT JUMLAH ITEM DI KERANJANG
    public function editKeranjang()
    {
        $id_keranjang   = $this->input->post('id_keranjang');
        $jumlah         = $this->input->post('jumlah');
        $custom_items   = $this->input->post('custom_item');

        if ($jumlah < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Jumlah tidak boleh kurang dari 1!</div>');
            redirect('user/keranjang');
        }

        // Ambil data keranjang yang ada
        $existing_cart_item = $this->Model_user->getKeranjangById($id_keranjang);

        if ($existing_cart_item) {
            // Jika paket custom
            if ($existing_cart_item['custom_item'] !== null) {
                // Proses custom item
                $nama_item_string = '';
                foreach ($custom_items as $id_item) {
                    $item = $this->Model_user->getItemById($id_item);
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

            $this->Model_user->editKeranjang($id_keranjang, $data_update);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Item keranjang berhasil diperbarui!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Item keranjang tidak ditemukan!</div>');
        }

        redirect('keranjang');
    }

    // FUNGSI HAPUS ITEM DI KERANJANG
    public function hapusKeranjang($id_keranjang)
    {
        $this->Model_user->deleteItem($id_keranjang);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              Item berhasil dihapus!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
        redirect('keranjang');
    }

    // FUNGSI HAPUS PESANAN
    public function hapusPesanan($kode_pesanan)
    {
        $this->Model_user->hapusPesanan($kode_pesanan);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              Item berhasil dihapus!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
        redirect('transaksi');
    }

    // VIEW CHECKOUT PEMESANAN
    public function checkout()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $keranjang = $this->Model_user->getKeranjangByUserId($id_user);

        // Looping menu berdasarkan id_paket
        foreach ($keranjang as &$item) {
            $item['nama_menu'] = $this->Model_user->getNamaMenuByIdPaket($item['id_paket']);
        }

        $data = [
            'title'         => 'Checkout Pemesanan',
            'user'          => $this->Model_user->getUserById($id_user),
            'cekJumlah'     => $this->Model_user->getJumlahItem($id_user),
            'id_user'       => $id_user,
            'keranjang'     => $keranjang,
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/checkout', $data);
        $this->load->view('templates/user/footer');
    }

    public function checkout_pesanan()
    {
        date_default_timezone_set('Asia/Jakarta');

        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $tanggal_pengiriman = $this->input->post('tanggal_pengiriman');
        $tanggal_pemesanan  = date('Y-m-d H:i:s');
        $min_date           = date('Y-m-d H:i:s', strtotime($tanggal_pemesanan . ' +2 days'));

        if ($tanggal_pengiriman < $min_date) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Checkout gagal!</strong> Tanggal pengiriman minimal 3 hari setelah tanggal pemesanan. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('checkout');
        }

        $metode_pembayaran = $this->input->post('metode_pembayaran');

        if ($metode_pembayaran == 'transfer') {
            $batas_waktu_upload = date('Y-m-d H:i:s', strtotime($tanggal_pemesanan . ' +1 minutes'));
        } elseif ($metode_pembayaran == 'cash') {
            $batas_waktu_upload = date('Y-m-d H:i:s', strtotime($tanggal_pemesanan . ' +1 minutes'));
        }

        $opsi_pembayaran    = $this->input->post('opsi_pembayaran');
        $total              = $this->input->post('total');
        $uang_muka          = $this->input->post('uang_muka');

        $sisa_pembayaran = ($opsi_pembayaran == 'dp') ? $total - $uang_muka : 0;

        // Validasi uang muka minimal 50% dan tidak lebih dari total harga
        if ($opsi_pembayaran == 'dp') {
            if ($uang_muka < 0.5 * $total) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Checkout gagal!</strong> Uang muka minimal 50% dari total harga. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('checkout');
            }
            if ($uang_muka > $total) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Checkout gagal!</strong> Uang muka tidak boleh lebih dari total harga. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('checkout');
            }
        }

        $data_pesanan = [
            'id_user'               => $id_user,
            'tanggal_pemesanan'     => $tanggal_pemesanan,
            'tanggal_pengiriman'    => $tanggal_pengiriman,
            'kota_tujuan'           => 'tangerang',
            'kecamatan'             => $this->input->post('kecamatan'),
            'waktu_pengiriman'      => $this->input->post('waktu_pengiriman'),
            'alamat'                => $this->input->post('alamat'),
            'metode_pembayaran'     => $metode_pembayaran,
            'opsi_pembayaran'       => $opsi_pembayaran,
            'uang_muka'             => $uang_muka,
            'total'                 => $total,
            'sisa_pembayaran'       => $sisa_pembayaran,
            'keterangan'            => $this->input->post('keterangan'),
            'status_pembayaran'     => 'belum diterima',
            'status_pengiriman'     => 'pending',
            'batas_waktu_upload'    => $batas_waktu_upload,
            // 'no_telp'                => $this->input->post('no_telp')
        ];

        // Generate kode pesanan
        $keranjang      = $this->Model_user->getKeranjangByIdUser($id_user);
        $kode_pesanan   = $this->generateKodePesanan($keranjang);

        $data_pesanan['kode_pesanan'] = $kode_pesanan;

        $this->Model_user->addPesanan($data_pesanan);

        foreach ($keranjang as $item) {
            $data_detail = [
                'kode_pesanan' => $kode_pesanan,
                'id_paket'     => $item['id_paket'],
                'jumlah'       => $item['jumlah'],
                'custom_item'  => $item['custom_item']
            ];

            $this->Model_user->addDetailPesanan($data_detail);
        }

        $this->Model_user->deleteCart($id_user);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">Checkout berhasil! Silahkan lakukan pembayaran.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
        );

        redirect('user/pembayaran/' . $kode_pesanan);
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
        $this->db->from('tbl_pesanan');
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

    public function pembatalanOtomatis()
    {
        $kode_pesanan     = $this->input->post('kode_pesanan');
        $data_pesanan   = ['status_pembayaran' => 'dibatalkan'];
        $this->Model_user->updatePesanan($kode_pesanan, $data_pesanan);

        $data_pembatalan = ['kode_pesanan' => $kode_pesanan,];
        $this->Model_user->addPembatalanPesanan($data_pembatalan);

        // $data_detail = ['kode_pesanan' => $kode_pesanan,];
        // $this->Model_user->hapusPesananDetail($kode_pesanan, $data_detail);
    }

    public function waktuDpAKhir()
    {
        $kode_pesanan = $this->input->post('kode_pesanan');
        if ($kode_pesanan) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">Waktu yang diberikan untuk melakukan pelunasan telah berakhir. Mohon segera melakukan pelunasan. Terima kasih.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button></div>'
            );
            echo "success";
        } else {
            echo "error";
        }
    }


    // VIEW TRANSAKSI
    public function transaksi()
    {
        $id_user = $this->session->userdata('id_user');

        // $this->Model_user->batalkanPesanan();

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $data = [
            'title'     => 'Transaksi Pemesanan',
            'id_user'   => $id_user,
            'user'      => $this->Model_user->getUserById($id_user),
            'pesanan'   => $this->Model_user->getPesananByUserId($id_user),
            'cekJumlah' => $this->Model_user->getJumlahItem($id_user)
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/transaksi', $data);
        $this->load->view('templates/user/footer');
    }

    public function pembayaran($kode_pesanan)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $detail_pesanan     = $this->Model_user->getDetailPesananByIdPesanan($kode_pesanan);
        $detail_transaksi   = $this->Model_user->getTransaksiByIdPesanan($kode_pesanan);

        // Ambil nama menu berdasarkan id_paket dari detail_pesanan
        if (!empty($detail_pesanan)) {
            foreach ($detail_pesanan as &$pesanan) {
                $pesanan['nama_menu'] = $this->Model_user->getNamaMenuByIdPaket($pesanan['id_paket']);
            }
        }

        $data = [
            'title'                     => 'Pembayaran',
            'cekJumlah'                 => $this->Model_user->getJumlahItem($id_user),
            'user'                      => $this->Model_user->getUserById($id_user),
            'id_user'                   => $id_user,
            'detail_pesanan'            => $detail_pesanan,
            'bukti_transfer_lunas'      => $detail_transaksi ? $detail_transaksi['bukti_transfer_lunas'] : null,
            'bukti_transfer_dp_awal'    => $detail_transaksi ? $detail_transaksi['bukti_transfer_dp_awal'] : null,
            'bukti_transfer_dp_akhir'   => $detail_transaksi ? $detail_transaksi['bukti_transfer_dp_akhir'] : null,
            'id_transaksi'              => $detail_transaksi ? $detail_transaksi['id_transaksi'] : null,
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/pembayaran', $data);
        $this->load->view('templates/user/footer');
    }

    // FUNGSI UPLOAD BUKTI TRANSFER LUNAS
    public function transfer_lunas()
    {
        $config['upload_path']      = './assets/img/bukti_transfer/lunas/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        $kode_pesanan     = $this->input->post('kode_pesanan');
        $id_transaksi   = $this->input->post('id_transaksi');

        if ($id_transaksi) {
            $transaksi              = $this->Model_user->getTransaksiById($id_transaksi);
            $bukti_transfer_lama    = $transaksi['bukti_transfer_lunas'];
            $path_file_lama         = './assets/img/bukti_transfer/lunas/' . $bukti_transfer_lama;

            if ($bukti_transfer_lama && file_exists($path_file_lama)) {
                unlink($path_file_lama);
            }
        }

        if (!$this->upload->do_upload('bukti_transfer_lunas')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('user/pembayaran');
        } else {
            $upload_foto    = $this->upload->data();
            $transfer_lunas = $upload_foto['file_name'];

            $data = [
                'kode_pesanan'                => $kode_pesanan,
                'bukti_transfer_lunas'      => $transfer_lunas,
                'bukti_transfer_dp_awal'    => null,
                'bukti_transfer_dp_akhir'   => null,
                'tgl_transfer_lunas'        => date('Y-m-d'),
                'tgl_transfer_dp_awal'      => null,
                'tgl_transfer_dp_akhir'     => null,
            ];

            if ($id_transaksi) {
                $this->Model_user->updateTransaksi($id_transaksi, $data);
            } else {
                $this->Model_user->addTransaksi($data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bukti transfer lunas berhasil diupload!</div>');
            redirect('user/transaksi');
        }
    }

    // FUNGSI UPLOAD BUKTI TRANSFER DP AWAL
    public function transfer_dp_awal()
    {
        $config['upload_path']      = './assets/img/bukti_transfer/dp_awal/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        $kode_pesanan     = $this->input->post('kode_pesanan');
        $id_transaksi   = $this->input->post('id_transaksi');

        if ($id_transaksi) {
            $transaksi              = $this->Model_user->getTransaksiById($id_transaksi);
            $bukti_transfer_lama    = $transaksi['bukti_transfer_dp_awal'];
            $path_file_lama         = './assets/img/bukti_transfer/dp_awal/' . $bukti_transfer_lama;

            if ($bukti_transfer_lama && file_exists($path_file_lama)) {
                unlink($path_file_lama);
            }
        }

        if (!$this->upload->do_upload('bukti_transfer_dp_awal')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('user/pembayaran');
        } else {
            $upload_foto        = $this->upload->data();
            $transfer_dp_awal   = $upload_foto['file_name'];

            $data = [
                'kode_pesanan'                => $kode_pesanan,
                'bukti_transfer_lunas'      => null,
                'bukti_transfer_dp_awal'    => $transfer_dp_awal,
                'tgl_transfer_dp_awal'      => date('Y-m-d'),
            ];

            if ($id_transaksi) {
                $transaksi = $this->Model_user->getTransaksiById($id_transaksi);
                $data['bukti_transfer_dp_akhir']    = $transaksi['bukti_transfer_dp_akhir'];
                $data['tgl_transfer_dp_akhir']      = $transaksi['tgl_transfer_dp_akhir'];

                $this->Model_user->updateTransaksi($id_transaksi, $data);
            } else {
                $this->Model_user->addTransaksi($data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bukti DP Awal berhasil diupload!</div>');
            redirect('transaksi');
        }
    }

    // FUNGSI UPLOAD BUKTI TRANSFER DP AKHIR
    public function transfer_dp_akhir()
    {
        $config['upload_path']      = './assets/img/bukti_transfer/dp_akhir/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        $kode_pesanan     = $this->input->post('kode_pesanan');
        $id_transaksi   = $this->input->post('id_transaksi');

        if ($id_transaksi) {
            $transaksi              = $this->Model_user->getTransaksiById($id_transaksi);
            $bukti_transfer_lama    = $transaksi['bukti_transfer_dp_akhir'];
            $path_file_lama         = './assets/img/bukti_transfer/dp_akhir/' . $bukti_transfer_lama;

            if ($bukti_transfer_lama && file_exists($path_file_lama)) {
                unlink($path_file_lama);
            }
        }

        if (!$this->upload->do_upload('bukti_transfer_dp_akhir')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('user/pembayaran');
        } else {
            $upload_foto        = $this->upload->data();
            $transfer_dp_akhir  = $upload_foto['file_name'];

            $data = [
                'kode_pesanan'                => $kode_pesanan,
                'bukti_transfer_dp_akhir'   => $transfer_dp_akhir,
                'bukti_transfer_lunas'      => null,
                'tgl_transfer_dp_akhir'     => date('Y-m-d'),
                'tgl_transfer_lunas'        => null,
            ];

            if ($id_transaksi) {
                $this->Model_user->updateTransaksi($id_transaksi, $data);
            } else {
                $this->Model_user->addTransaksi($data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bukti DP Akhir berhasil diupload!</div>');
            redirect('user/transaksi');
        }
    }

    // VIEW PEMBATALAN PEMESANAN
    public function pembatalan_pesanan($kode_pesanan)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $detail_pesanan = $this->Model_user->getDetailPesananByIdPesanan($kode_pesanan);

        // Ambil nama menu berdasarkan id_paket dari detail_pesanan
        if (!empty($detail_pesanan)) {
            foreach ($detail_pesanan as &$pesanan) {
                $pesanan['nama_menu'] = $this->Model_user->getNamaMenuByIdPaket($pesanan['id_paket']);
            }
        }

        $data = [
            'title'             => 'Pembatalan Pesanan',
            'cekJumlah'         => $this->Model_user->getJumlahItem($id_user),
            'user'              => $this->Model_user->getUserById($id_user),
            'id_user'           => $id_user,
            'detail_pesanan'    => $detail_pesanan,
            'kode_pesanan'        => $kode_pesanan,
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/pembatalan_pesanan', $data);
        $this->load->view('templates/user/footer');
    }

    public function batalkanPesanan()
    {
        $kode_pesanan = $this->input->post('kode_pesanan');

        $data_pesanan = ['status_pembayaran' => 'dibatalkan'];
        $this->Model_user->updatePesanan($kode_pesanan, $data_pesanan);

        $data = [
            'kode_pesanan' => $kode_pesanan,
        ];

        $this->Model_user->addPembatalanPesanan($data);
        $this->Model_user->hapusTransaksi($kode_pesanan);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pesanan berhasil dibatalkan!</div>');
        redirect('user/transaksi');
    }


    // VIEW DETAIL PESANAN
    public function detail_pesanan($kode_pesanan)
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $detail_pesanan     = $this->Model_user->getDetailPesananByIdPesanan($kode_pesanan);
        $detail_transaksi   = $this->Model_user->getTransaksiByIdPesanan($kode_pesanan);

        // Ambil nama menu berdasarkan id_paket dari detail_pesanan
        if (!empty($detail_pesanan)) {
            foreach ($detail_pesanan as &$pesanan) {
                $pesanan['nama_menu'] = $this->Model_user->getNamaMenuByIdPaket($pesanan['id_paket']);
            }
        }

        $data = [
            'title'                     => 'Detail Pesanan',
            'cekJumlah'                 => $this->Model_user->getJumlahItem($id_user),
            'user'                      => $this->Model_user->getUserById($id_user),
            'id_user'                   => $id_user,
            'detail_pesanan'            => $detail_pesanan,
            'bukti_transfer_lunas'      => $detail_transaksi ? $detail_transaksi['bukti_transfer_lunas'] : null,
            'bukti_transfer_dp_awal'    => $detail_transaksi ? $detail_transaksi['bukti_transfer_dp_awal'] : null,
            'bukti_transfer_dp_akhir'   => $detail_transaksi ? $detail_transaksi['bukti_transfer_dp_akhir'] : null,
            'id_transaksi'              => $detail_transaksi ? $detail_transaksi['id_transaksi'] : null,
            'data'                      => $detail_pesanan
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/detail_pesanan', $data);
        $this->load->view('templates/user/footer');
    }
}

/* End of file User.php */
