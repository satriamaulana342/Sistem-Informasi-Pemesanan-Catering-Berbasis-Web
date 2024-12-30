<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data = [
            'title'                 => 'Dashboard',
            'paket'                 => $this->Model_admin->getTotalPaket(),
            'pesanan'               => $this->Model_admin->getTotalPesanan(),
            'pesanan_perusahaan'    => $this->Model_admin->getTotalPesananPerusahaan(),
            'transaksi'             => $this->Model_admin->getTotalTransaksi(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/dashboard');
        $this->load->view('templates/admin/footer');
    }


    // MENU
    public function menu()
    {
        $data = [
            'title' => 'Data Menu',
            'menu'  => $this->Model_admin->getAllMenu(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/menu');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_menu()
    {
        $data = [
            'nama_menu' => $this->input->post('nama_menu')
        ];

        $this->Model_admin->tambahMenu($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>'
        );
        redirect('admin/menu');
    }

    public function edit_menu($id_menu)
    {
        $data = [
            'id_menu'   => $this->input->post('id_menu'),
            'nama_menu' => $this->input->post('nama_menu'),
        ];

        $this->Model_admin->editMenu($id_menu, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
        );
        redirect('admin/menu');
    }

    public function hapus_menu($id_menu)
    {
        $this->Model_admin->hapusMenu($id_menu);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>'
        );
        redirect('admin/menu');
    }


    // MENU PRASMANAN
    // public function menu_prasmanan()
    // {
    //     $id_user = $this->session->userdata('id_user');

    //     if (!$id_user) {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
    //         redirect('login');
    //     }

    //     $data = [
    //         'title'             => 'Data Menu Prasmanan',
    //         'menu_prasmanan'    => $this->Model_admin->getAllMenuPrasmanan(),
    //     ];

    //     $this->load->view('templates/admin/header', $data);
    //     $this->load->view('templates/admin/sidebar');
    //     $this->load->view('templates/admin/topbar');
    //     $this->load->view('admin/menu_prasmanan');
    //     $this->load->view('templates/admin/footer');
    // }

    // public function tambah_menu_prasmanan()
    // {
    //     $data = [
    //         'nama_menu' => $this->input->post('nama_menu')
    //     ];

    //     $this->Model_admin->tambahMenuPrasmanan($data);
    //     $this->session->set_flashdata(
    //         'pesan',
    //         '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>'
    //     );
    //     redirect('admin/menu_prasmanan');
    // }

    // public function edit_menu_prasmanan($id_menu_prasmanan)
    // {
    //     $data = [
    //         'id_menu_prasmanan' => $this->input->post('id_menu_prasmanan'),
    //         'nama_menu'         => $this->input->post('nama_menu'),
    //     ];

    //     $this->Model_admin->editMenuPrasmanan($id_menu_prasmanan, $data);
    //     $this->session->set_flashdata(
    //         'pesan',
    //         '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
    //     );
    //     redirect('admin/menu_prasmanan');
    // }

    // public function hapus_menu_prasmanan($id_menu_prasmanan)
    // {
    //     $this->Model_admin->hapusMenuPrasmanan($id_menu_prasmanan);
    //     $this->session->set_flashdata(
    //         'pesan',
    //         '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>'
    //     );
    //     redirect('admin/menu_prasmanan');
    // }



    // ITEM
    public function item()
    {
        $data = [
            'title' => 'Data Item',
            'item'  => $this->Model_admin->getAllItem(),
            'menu'  => $this->Model_admin->getAllMenu()
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/item');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_item()
    {
        $data = [
            'id_menu'   => $this->input->post('id_menu'),
            'nama_item' => $this->input->post('nama_item'),
        ];

        $this->Model_admin->tambahItem($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>'
        );
        redirect('admin/item');
    }

    public function edit_item($id_item)
    {
        $data = [
            'id_item'   => $this->input->post('id_item'),
            'id_menu'   => $this->input->post('id_menu'),
            'nama_item' => $this->input->post('nama_item'),
        ];

        $this->Model_admin->editItem($id_item, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
        );
        redirect('admin/item');
    }

    public function hapus_item($id_item)
    {
        $this->Model_admin->hapusItem($id_item);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>'
        );
        redirect('admin/item');
    }


    // PAKET
    public function paket()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $data = [
            'title'             => 'Data Paket',
            'paket_kategori'    => $this->Model_admin->getAllPaketKategori(),
            'paket'             => $this->Model_admin->getAllPaket()
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/paket');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_paket()
    {
        $config['upload_path']      = './assets/img/upload_paket/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('admin/paket');
        } else {
            $upload_foto = $this->upload->data();
            $foto_paket = $upload_foto['file_name'];

            $data = [
                'id_paket_kategori' => $this->input->post('id_paket_kategori'),
                'nama_paket'        => $this->input->post('nama_paket'),
                'harga'             => $this->input->post('harga'),
                'minimal_pemesanan' => $this->input->post('minimal_pemesanan'),
                'foto'              => $foto_paket
            ];

            $this->Model_admin->tambahPaket($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('admin/paket');
        }
    }

    public function edit_paket($id_paket)
    {
        $data = [
            'id_paket'          => $this->input->post('id_paket'),
            'id_paket_kategori' => $this->input->post('id_paket_kategori'),
            'nama_paket'        => $this->input->post('nama_paket'),
            'harga'             => $this->input->post('harga'),
            'minimal_pemesanan' => $this->input->post('minimal_pemesanan'),
        ];

        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path']      = './assets/img/upload_paket/';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/paket');
            } else {
                $upload_foto = $this->upload->data();
                $data['foto'] = $upload_foto['file_name'];
            }
        }

        $this->Model_admin->editPaket($id_paket, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
        );
        redirect('admin/paket');
    }

    public function hapus_paket($id_paket)
    {
        $paket      = $this->Model_admin->getPaketById($id_paket);
        $file_path  = './assets/img/upload_paket/' . $paket['foto'];

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $this->Model_admin->hapusPaket($id_paket);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('admin/paket');
    }


    // PAKET MENU
    public function paket_menu()
    {
        $data = [
            'title'         => 'Data Paket Menu',
            'paket_menu'    => $this->Model_admin->getAllPaketMenu(),
            'paket'         => $this->Model_admin->getAllPaket(),
            'menu'          => $this->Model_admin->getAllMenu(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/paket_menu');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_paket_menu()
    {
        $data = [
            'id_paket'  => $this->input->post('id_paket'),
            'id_menu'   => $this->input->post('id_menu'),
            'deskripsi' => $this->input->post('deskripsi'),
        ];

        $this->Model_admin->tambahPaketMenu($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>'
        );
        redirect('admin/paket_menu');
    }

    public function edit_paket_menu($id_paket_menu)
    {
        $data = [
            'id_paket_menu' => $this->input->post('id_paket_menu'),
            'id_paket'      => $this->input->post('id_paket'),
            'id_menu'       => $this->input->post('id_menu'),
            'deskripsi'     => $this->input->post('deskripsi'),
        ];

        $this->Model_admin->editPaketMenu($id_paket_menu, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
        );
        redirect('admin/paket_menu');
    }

    public function hapus_paket_menu($id_paket_menu)
    {
        $this->Model_admin->hapusPaketMenu($id_paket_menu);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>'
        );
        redirect('admin/paket_menu');
    }


    // PAKET PRASMANAN
    // public function paket_prasmanan()
    // {
    //     $id_user = $this->session->userdata('id_user');

    //     if (!$id_user) {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
    //         redirect('login');
    //     }

    //     $data = [
    //         'title'             => 'Data Paket Prasmanan',
    //         'paket'             => $this->Model_admin->getAllPaketKategoriPrasmanan(),
    //         'paket_prasmanan'   => $this->Model_admin->getAllPaketPrasmanan(),
    //         'menu_prasmanan'    => $this->Model_admin->getAllMenuPrasmanan(),
    //     ];

    //     $this->load->view('templates/admin/header', $data);
    //     $this->load->view('templates/admin/sidebar');
    //     $this->load->view('templates/admin/topbar');
    //     $this->load->view('admin/paket_prasmanan');
    //     $this->load->view('templates/admin/footer');
    // }

    // public function tambah_paket_prasmanan()
    // {
    //     $data = [
    //         'id_paket'          => $this->input->post('id_paket'),
    //         'id_menu_prasmanan' => $this->input->post('id_menu_prasmanan'),
    //         'deskripsi'         => $this->input->post('deskripsi'),
    //     ];

    //     $this->Model_admin->tambahPaketPrasmanan($data);
    //     $this->session->set_flashdata(
    //         'pesan',
    //         '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>'
    //     );
    //     redirect('admin/paket_prasmanan');
    // }

    // public function edit_paket_prasmanan($id_paket_prasmanan)
    // {
    //     $data = [
    //         'id_paket_prasmanan'    => $this->input->post('id_paket_prasmanan'),
    //         'id_paket'              => $this->input->post('id_paket'),
    //         'id_menu_prasmanan'     => $this->input->post('id_menu_prasmanan'),
    //     ];

    //     $this->Model_admin->editPaketPrasmanan($id_paket_prasmanan, $data);
    //     $this->session->set_flashdata(
    //         'pesan',
    //         '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
    //     );
    //     redirect('admin/paket_prasmanan');
    // }

    // public function hapus_paket_prasmanan($id_paket_prasmanan)
    // {
    //     $this->Model_admin->hapusPaketPrasmanan($id_paket_prasmanan);
    //     $this->session->set_flashdata(
    //         'pesan',
    //         '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>'
    //     );
    //     redirect('admin/paket_prasmanan');
    // }


    // PAKET KATEGORI
    public function paket_kategori()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $data = [
            'title'             => 'Data Paket Kategori',
            'paket_kategori'    => $this->Model_admin->getAllPaketKategori()
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/paket_kategori');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_paket_kategori()
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];

        $this->Model_admin->tambahPaketKategori($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>'
        );
        redirect('admin/paket_kategori');
    }

    public function edit_paket_kategori($id_paket_kategori)
    {
        $data = [
            'id_paket_kategori' => $this->input->post('id_paket_kategori'),
            'nama_kategori'     => $this->input->post('nama_kategori')
        ];

        $this->Model_admin->editPaketKategori($id_paket_kategori, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
        );
        redirect('admin/paket_kategori');
    }

    public function hapus_paket_kategori($id_paket_kategori)
    {
        $this->Model_admin->hapusPaketKategori($id_paket_kategori);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>'
        );
        redirect('admin/paket_kategori');
    }


    // PAKET CUSTOM
    public function paket_custom()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $data = [
            'title'         => 'Data Paket Custom',
            'paket'         => $this->Model_admin->getAllPaket(),
            'paket_custom'  => $this->Model_admin->getAllPaketCustom(),
            'menu'          => $this->Model_admin->getAllMenu(),
            'item'          => $this->Model_admin->getAllItem(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/paket_custom');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_paket_custom()
    {
        $data = [
            'id_paket'  => $this->input->post('id_paket'),
            'id_menu'   => $this->input->post('id_menu'),
            'id_item'   => $this->input->post('id_item')
        ];

        $this->Model_admin->tambahPaketCustom($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>'
        );
        redirect('admin/paket_custom');
    }

    public function edit_paket_custom($id_paket_custom)
    {
        $data = [
            'id_paket_custom'   => $this->input->post('id_paket_custom'),
            'id_paket'          => $this->input->post('id_paket'),
            'id_menu'           => $this->input->post('id_menu'),
            'id_item'           => $this->input->post('id_item')
        ];

        $this->Model_admin->editPaketCustom($id_paket_custom, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
        );
        redirect('admin/paket_custom');
    }

    public function hapus_paket_custom($id_paket_custom)
    {
        $this->Model_admin->hapusPaketCustom($id_paket_custom);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>'
        );
        redirect('admin/paket_custom');
    }


    // TRANSAKSI
    public function transaksi()
    {
        $data = [
            'title'     => 'Data Transaksi',
            'pesanan'   => $this->Model_admin->getAllPesanan(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/transaksi');
        $this->load->view('templates/admin/footer');
    }

    public function detail_transaksi($kode_pesanan)
    {
        $data = [
            'title'             => 'Detail Transaksi',
            'pesanan'           => $this->Model_admin->getPesananByKodePesanan($kode_pesanan),
            'transaksi'         => $this->Model_admin->getTransaksiByKodePesanan($kode_pesanan),
            'detail_pesanan'    => $this->Model_admin->getDetailPesananByKodePesanan($kode_pesanan),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/detail_transaksi');
        $this->load->view('templates/admin/footer');
    }

    public function edit_transaksi($kode_pesanan)
    {
        date_default_timezone_set('Asia/Jakarta');

        $status_pembayaran  = $this->input->post('status_pembayaran');
        $status_pengiriman  = $this->input->post('status_pengiriman');
        $keterangan_ditolak = $this->input->post('keterangan_ditolak');
        $metode_pembayaran  = $this->input->post('metode_pembayaran');

        if ($metode_pembayaran == 'transfer') {
            $batas_waktu_upload = date('Y-m-d H:i:s', strtotime('+5 minutes'));
        } elseif ($metode_pembayaran == 'cash') {
            $batas_waktu_upload = date('Y-m-d H:i:s', strtotime('+10 minutes'));
        } else {
            $batas_waktu_upload = date('Y-m-d H:i:s');
        }

        $data = [
            'kode_pesanan'       => $kode_pesanan,
            'status_pembayaran'  => $status_pembayaran,
            'status_pengiriman'  => $status_pengiriman,
            'keterangan_ditolak' => $keterangan_ditolak,
            'batas_waktu_upload' => $batas_waktu_upload,
        ];

        $this->Model_admin->editTransaksi($kode_pesanan, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>');
        redirect('admin/transaksi');
    }

    public function surat_jalan($kode_pesanan)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Surat Jalan',
            'id_user'           => $id_user,
            'pesanan'           => $this->Model_admin->getPesananByKodePesanan($kode_pesanan),
            'detail_pesanan'    => $this->Model_admin->getDetailPesananByKodePesanan($kode_pesanan),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('admin/surat_jalan', $data);
        $this->load->view('templates/user/footer');
    }


    // TRANSAKSI PEMBATALAN
    public function transaksi_pembatalan()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $data = [
            'title'                 => 'Data Transaksi Pembatalan',
            'pembatalan_pesanan'    => $this->Model_admin->getAllPembatalanPesanan()
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/transaksi_pembatalan');
        $this->load->view('templates/admin/footer');
    }

    public function hapus_transaksi_pembatalan($id_pembatalan_pesanan)
    {
        $this->Model_admin->hapusTransaksiPembatalan($id_pembatalan_pesanan);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>'
        );
        redirect('admin/transaksi_pembatalan');
    }


    // KONTRAK PERUSAHAAN
    public function kontrak()
    {
        $data = [
            'title'     => 'Data Kontrak Perusahaan',
            'user'      => $this->Model_admin->getAllUserPerusahaan(),
            'kontrak'   => $this->Model_admin->getAllKontrakPerusahaan(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/kontrak');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_kontrak()
    {
        date_default_timezone_set('Asia/Jakarta');

        $id_user        = $this->input->post('id_user');
        $nama_perwakilan        = $this->input->post('nama_perwakilan');
        $alamat        = $this->input->post('alamat');
        $tanggal_awal   = $this->input->post('tanggal_awal'); 
        $tanggal_akhir  = $this->input->post('tanggal_akhir');
        $harga_paket    = $this->input->post('harga_paket');

        $cekUser = $this->Model_admin->getKontrakByUserId($id_user);

        if ($cekUser) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger" role="alert">Gagal menyimpan data! Kontrak dengan user ini sudah ada.</div>'
            );
            redirect('admin/kontrak');
            return;
        }

        $sekarang = date('Y-m-d H:i:s');

        $tanggal_awal = date('Y-m-d H:i:s', strtotime($tanggal_awal));
        $tanggal_akhir = date('Y-m-d H:i:s', strtotime($tanggal_akhir));


        if (strtotime($tanggal_awal) > strtotime($sekarang)) {
            $status_kontrak = 'belum kontrak';
        } elseif (strtotime($tanggal_akhir) < strtotime($sekarang)) {
            $status_kontrak = 'habis kontrak';
        } else {
            $status_kontrak = 'kontrak';
        }

        $data = [
            'id_user'        => $id_user,
            'nama_perwakilan'        => $nama_perwakilan,
            'alamat'        => $alamat,
            'tanggal_awal'   => $tanggal_awal,
            'tanggal_akhir'  => $tanggal_akhir,
            'harga_paket'    => $harga_paket,
            'status_kontrak' => $status_kontrak,
        ];

        $this->Model_admin->tambahKontrak($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>'
        );

        redirect('admin/kontrak');
    }

    public function edit_kontrak($id_kontrak)
    {
        date_default_timezone_set('Asia/Jakarta');

        $id_user         = $this->input->post('id_user');
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');

         // Cek apakah id_user yang baru sudah digunakan oleh kontrak lain
    $kontrakLain = $this->Model_admin->getKontrakByUserIdExcept($id_user, $id_kontrak);

    if ($kontrakLain) {
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger" role="alert">Perusahaan sudah terdaftar!</div>'
        );
        redirect('admin/kontrak');
        return;
    }

        $sekarang = date('Y-m-d H:i:s');

        $tanggal_awal = date('Y-m-d H:i:s', strtotime($tanggal_awal));
        $tanggal_akhir = date('Y-m-d H:i:s', strtotime($tanggal_akhir));


        if (strtotime($tanggal_awal) > strtotime($sekarang)) {
            $status_kontrak = 'belum kontrak';
        } elseif (strtotime($tanggal_akhir) < strtotime($sekarang)) {
            $status_kontrak = 'habis kontrak';
        } else {
            $status_kontrak = 'kontrak';
        }

        $data = [
            'id_user'           => $id_user,
            'nama_perwakilan'           => $this->input->post('nama_perwakilan'),
            'alamat'           => $this->input->post('alamat'),
            'tanggal_awal'      => $tanggal_awal,
            'tanggal_akhir'     => $tanggal_akhir,
            'harga_paket'       => $this->input->post('harga_paket'),
            'status_kontrak'    => $status_kontrak,
        ];

        $this->Model_admin->editKontrak($id_kontrak, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
        );
        redirect('admin/kontrak');
    }

    public function hapus_kontrak($id_kontrak)
    {
        $this->Model_admin->hapusKontrak($id_kontrak);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>'
        );
        redirect('admin/kontrak');
    }

    public function surat_kontrak($id_kontrak)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Surat Kontrak Perusahaan',
            'id_user'   => $id_user,
            'kontrak'   => $this->Model_admin->getKontrakById($id_kontrak),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('admin/surat_kontrak', $data);
        $this->load->view('templates/user/footer');
    }



    // TRANSAKSI PERUSAHAAN
    public function transaksi_perusahaan()
    {
        $data = [
            'title'     => 'Data Transaksi Perusahaan',
            'pesanan'   => $this->Model_admin->getAllPesananPerusahaan(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/transaksi_perusahaan');
        $this->load->view('templates/admin/footer');
    }

    public function detail_transaksi_perusahaan($id_pesanan_perusahaan)
    {
        $data = [
            'title'             => 'Detail Transaksi',
            'pesanan'           => $this->Model_admin->getPesananPerusahaanById($id_pesanan_perusahaan),
            'detail_pesanan'    => $this->Model_admin->getDetailPesananPerusahaanById($id_pesanan_perusahaan),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/detail_transaksi_perusahaan');
        $this->load->view('templates/admin/footer');
    }

    public function edit_transaksi_perusahaan($id_pesanan_perusahaan)
    {

        $data = [
            'id_pesanan_perusahaan' => $this->input->post('id_pesanan_perusahaan'),
            'status_pengiriman'     => $this->input->post('status_pengiriman'),
        ];

        $this->Model_admin->editTransaksiPerusahaan($id_pesanan_perusahaan, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>');
        redirect('admin/transaksi_perusahaan');
    }

    public function surat_jalan_perusahaan($id_pesanan_perusahaan)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Surat Jalan',
            'id_user'           => $id_user,
            'pesanan'           => $this->Model_admin->getPesananPerusahaanById($id_pesanan_perusahaan),
            'detail_pesanan'    => $this->Model_admin->getDetailPesananPerusahaanById($id_pesanan_perusahaan),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('admin/surat_jalan_perusahaan', $data);
        $this->load->view('templates/user/footer');
    }


    // USER
    public function user()
    {
        $data = [
            'title' => 'Data User',
            'user'  => $this->Model_admin->getAllUser(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/user');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_user()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'nama_lengkap'  => htmlspecialchars($this->input->post('nama_lengkap', TRUE)),
            'email'         => htmlspecialchars($this->input->post('email', TRUE)),
            'no_telp'       => htmlspecialchars($this->input->post('no_telp', TRUE)),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'date_created'  => date('Y-m-d H:i:s'),
            'is_active'     => 1,
            'id_role'       => 4,
        ];

        $this->Model_admin->tambahUser($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
        redirect('admin/user');
    }

    public function edit_user($id_user)
    {
        $data = [
            'id_user'      => $this->input->post('id_user'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email'        => $this->input->post('email'),
            'no_telp'      => $this->input->post('no_telp'),
            'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        ];

        $this->Model_admin->editUser($id_user, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>');
        redirect('admin/user');
    }

    public function hapus_user($id_user)
    {
        $this->Model_admin->hapusUser($id_user);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('admin/user');
    }


    // FEEDBACK
    public function feedback()
    {
        $data = [
            'title' => 'Data User',
            'feedback'  => $this->Model_admin->getAllFeedback(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/feedback');
        $this->load->view('templates/admin/footer');
    }

    public function hapus_feedback($id_feedback)
    {
        $this->Model_admin->hapusFeedback($id_feedback);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('admin/feedback');
    }


    // PROFILE
    public function profile()
    {
        $id_user    = $this->session->userdata('id_user');
        $user       = $this->Model_admin->getUserById($id_user);

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $data = [
            'title'     => 'Data Profile',
            'id_user'   => $id_user,
            'user'      => $user,
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/topbar');
        $this->load->view('admin/profile');
        $this->load->view('templates/admin/footer');
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

        $this->Model_admin->editProfile($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
        );

        redirect('admin/profile');
    }
}

/* End of file Admin.php */
