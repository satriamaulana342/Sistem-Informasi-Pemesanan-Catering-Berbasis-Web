<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_admin extends CI_Model
{
    // GET TOTAL
    public function getTotalPaket()
    {
        return $this->db->count_all('tbl_paket');
    }

    public function getTotalPesanan()
    {
        return $this->db->count_all('tbl_pesanan');
    }

    public function getTotalTransaksi()
    {
        return $this->db->count_all('tbl_transaksi');
    }

    public function getTotalPesananPerusahaan()
    {
        return $this->db->count_all('tbl_pesanan_perusahaan');
    }


    // GET ALL DATA
    public function getAllPaketKategori()
    {
        return $this->db->order_by('nama_kategori', 'ASC')->get('tbl_paket_kategori')->result_array();
    }

    public function getAllMenu()
    {
        return $this->db->order_by('id_menu', 'DESC')->get('tbl_menu')->result_array();
    }

    public function getAllMenuPrasmanan()
    {
        return $this->db->order_by('nama_menu', 'ASC')->get('tbl_menu_prasmanan')->result_array();
    }

    public function getAllItem()
    {
        $this->db->join('tbl_menu AS menu', 'menu.id_menu = item.id_menu', 'INNER');
        $this->db->order_by('item.id_item', 'DESC');
        return $this->db->get('tbl_item AS item')->result_array();
    }

    public function getAllPaket()
    {
        $this->db->join('tbl_paket_kategori AS paket_kategori', 'paket_kategori.id_paket_kategori = paket.id_paket_kategori', 'INNER');
        $this->db->order_by('nama_kategori', 'ASC');
        return $this->db->get('tbl_paket AS paket')->result_array();
    }

    public function getAllPaketPrasmanan()
    {
        $this->db->join('tbl_paket AS p', 'p.id_paket = pp.id_paket', 'INNER');
        $this->db->join('tbl_paket_kategori AS pk', 'pk.id_paket_kategori = p.id_paket_kategori', 'INNER');
        $this->db->join('tbl_menu_prasmanan AS mp', 'mp.id_menu_prasmanan = pp.id_menu_prasmanan', 'INNER');
        $this->db->order_by('nama_paket', 'ASC');
        return $this->db->get('tbl_paket_prasmanan AS pp')->result_array();
    }

    public function getAllPaketKategoriPrasmanan()
    {
        $this->db->join('tbl_paket_kategori AS paket_kategori', 'paket_kategori.id_paket_kategori = paket.id_paket_kategori', 'INNER');
        $this->db->where('paket_kategori.nama_kategori', 'prasmanan');
        $this->db->order_by('nama_kategori', 'ASC');
        return $this->db->get('tbl_paket AS paket')->result_array();
    }

    public function getAllPaketMenu()
    {
        $this->db->join('tbl_paket AS p', 'p.id_paket = pm.id_paket', 'INNER');
        $this->db->join('tbl_menu AS m', 'm.id_menu = pm.id_menu', 'INNER');
        $this->db->order_by('pM.id_paket_menu', 'DESC');
        return $this->db->get('tbl_paket_menu AS pm')->result_array();
    }

    public function getAllPaketCustom()
    {
        $this->db->join('tbl_paket AS paket', 'paket.id_paket = paket_custom.id_paket', 'INNER');
        $this->db->join('tbl_menu AS menu', 'menu.id_menu = paket_custom.id_menu', 'INNER');
        $this->db->join('tbl_item AS item', 'item.id_item = paket_custom.id_item', 'INNER');
        $this->db->order_by('paket_custom.id_paket_custom', 'DESC');
        return $this->db->get('tbl_paket_custom AS paket_custom')->result_array();
    }

    public function getAllPesanan()
    {
        $this->db->select('
            p.*, 
            t.id_transaksi, 
            t.bukti_transfer_lunas, 
            t.tgl_transfer_lunas, 
            t.bukti_transfer_dp_awal, 
            t.tgl_transfer_dp_awal, 
            t.bukti_transfer_dp_akhir, 
            t.tgl_transfer_dp_akhir, 
            u.nama_lengkap
        ');
        $this->db->from('tbl_pesanan AS p');
        $this->db->join('tbl_transaksi AS t', 't.kode_pesanan = p.kode_pesanan', 'LEFT');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        $this->db->where('p.status_pembayaran !=', 'dibatalkan');
        $this->db->order_by('p.tanggal_pemesanan', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getAllPesananPerusahaan()
    {
        // $this->db->join('tbl_paket AS paket', 'paket.id_paket = paket_custom.id_paket', 'INNER');
        // $this->db->join('tbl_transaksi_perusahaan AS tp', 'tp.id_pesanan_perusahaan = pp.id_pesanan_perusahaan', 'LEFT');
        $this->db->join('tbl_user AS u', 'u.id_user = pp.id_user', 'INNER');
        $this->db->order_by('pp.id_pesanan_perusahaan', 'DESC');
        return $this->db->get('tbl_pesanan_perusahaan AS pp')->result_array();
    }

    // public function getAllDetailPesanan()
    // {
    //     $this->db->select('pesanan_detail.*, paket.nama_paket, pesanan.kode_pesanan,  paket.harga, GROUP_CONCAT(menu.nama_menu SEPARATOR ", ") AS nama_menu');
    //     $this->db->join('tbl_paket AS paket', 'paket.id_paket = pesanan_detail.id_paket', 'INNER');
    //     $this->db->join('tbl_paket_menu AS paket_menu', 'paket_menu.id_paket = paket.id_paket', 'LEFT');
    //     $this->db->join('tbl_menu AS menu', 'menu.id_menu = paket_menu.id_menu', 'LEFT');
    //     $this->db->join('tbl_pesanan AS pesanan', 'pesanan.kode_pesanan = pesanan_detail.kode_pesanan', 'INNER');
    //     $this->db->group_by('pesanan_detail.kode_pesanan');
    //     return $this->db->get('tbl_pesanan_detail AS pesanan_detail')->result_array();
    // }

    public function getAllPembatalanPesanan()
    {
        $this->db->join('tbl_pesanan AS p', 'p.kode_pesanan = ps.kode_pesanan', 'INNER');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->get('tbl_pembatalan_pesanan AS ps')->result_array();
    }

    public function getAllUser()
    {
        $this->db->join('tbl_user_role AS user_role', 'user_role.id_role = user.id_role', 'INNER');
        $this->db->order_by('user.nama_lengkap', 'ASC');
        return $this->db->get('tbl_user AS user')->result_array();
    }

    public function getAllUserPerusahaan()
    {
        $this->db->join('tbl_user_role AS ur', 'ur.id_role = u.id_role', 'INNER');
        $this->db->where('ur.role', 'Perusahaan');
        $this->db->order_by('u.nama_lengkap', 'ASC');
        return $this->db->get('tbl_user AS u')->result_array();
    }

    public function getAllKontrakPerusahaan()
    {
        $this->db->join('tbl_user AS u', 'u.id_user = k.id_user', 'INNER');
        $this->db->order_by('k.id_kontrak', 'DESC');
        return $this->db->get('tbl_kontrak AS k')->result_array();
    }

    public function getKontrakByUserId($id_user)
    {
        return $this->db->get_where('tbl_kontrak', ['id_user' => $id_user])->row_array();
    }

    public function getKontrakByUserIdExcept($id_user, $id_kontrak)
{
    return $this->db->where('id_user', $id_user)
                    ->where('id_kontrak !=', $id_kontrak)
                    ->get('tbl_kontrak')->row_array();
}

    public function getAllFeedback()
    {
        return $this->db->order_by('id_feedback', 'DESC')->get('tbl_feedback')->result_array();
    }


    // GET DATA BY ID
    public function getPaketById($id_paket)
    {
        return $this->db->get_where('tbl_paket', ['id_paket' => $id_paket])->row_array();
    }

    public function getPesananByKodePesanan($kode_pesanan)
    {
        $this->db->where('p.kode_pesanan', $kode_pesanan);
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->get('tbl_pesanan AS p')->row_array();
    }

    public function getPesananPerusahaanById($id_pesanan_perusahaan)
    {
        $this->db->where('pp.id_pesanan_perusahaan', $id_pesanan_perusahaan);
        $this->db->join('tbl_user AS u', 'u.id_user = pp.id_user', 'INNER');
        return $this->db->get('tbl_pesanan_perusahaan AS pp')->row_array();
    }

    public function getKontrakById($id_kontrak)
    {
        $this->db->where('k.id_kontrak', $id_kontrak);
        $this->db->join('tbl_user AS u', 'u.id_user = k.id_user', 'INNER');
        
        return $this->db->get('tbl_kontrak AS k')->row_array();
    }

    public function getTransaksiByKodePesanan($kode_pesanan)
    {
        $this->db->where('t.kode_pesanan', $kode_pesanan);
        $this->db->join('tbl_pesanan AS p', 'p.kode_pesanan = t.kode_pesanan', 'INNER');
        return $this->db->get('tbl_transaksi AS t')->result_array();
    }

    public function getDetailPesananByKodePesanan($kode_pesanan)
    {
        $this->db->select('pesanan_detail.*, 
        paket.nama_paket, 
        pesanan.kode_pesanan, 
        pesanan.alamat, 
        pesanan.tanggal_pengiriman, 
        pesanan.waktu_pengiriman, 
        pesanan.keterangan, 
        pesanan.total, 
        paket.harga, 
        GROUP_CONCAT(menu.nama_menu SEPARATOR ", ") AS nama_menu');
        $this->db->from('tbl_pesanan_detail AS pesanan_detail');
        $this->db->where('pesanan_detail.kode_pesanan', $kode_pesanan);
        $this->db->join('tbl_paket AS paket', 'paket.id_paket = pesanan_detail.id_paket', 'INNER');
        $this->db->join('tbl_paket_menu AS paket_menu', 'paket_menu.id_paket = paket.id_paket', 'LEFT');
        $this->db->join('tbl_menu AS menu', 'menu.id_menu = paket_menu.id_menu', 'LEFT');
        $this->db->join('tbl_pesanan AS pesanan', 'pesanan.kode_pesanan = pesanan_detail.kode_pesanan', 'INNER');
        $this->db->group_by('pesanan_detail.id_pesanan_detail');
        return $this->db->get()->result_array();
    }

    public function getDetailPesananPerusahaanById($id_pesanan_perusahaan)
    {
        $this->db->select('pdp.*, pp.*, p.*, GROUP_CONCAT(m.nama_menu SEPARATOR ", ") AS nama_menu');
        $this->db->from('tbl_pesanan_detail_perusahaan AS pdp');
        $this->db->join('tbl_pesanan_perusahaan AS pp', 'pp.id_pesanan_perusahaan = pdp.id_pesanan_perusahaan', 'INNER');
        $this->db->join('tbl_paket AS p', 'p.id_paket = pdp.id_paket', 'INNER');
        $this->db->join('tbl_paket_menu AS pm', 'pm.id_paket = p.id_paket', 'LEFT');
        $this->db->join('tbl_menu AS m', 'm.id_menu = pm.id_menu', 'LEFT');
        $this->db->where('pp.id_pesanan_perusahaan', $id_pesanan_perusahaan);
        return $this->db->get()->result_array();
    }


    public function getUserById($id_user)
    {
        return $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();
    }


    // TAMBAH DATA
    public function tambahMenu($data)
    {
        $this->db->insert('tbl_menu', $data);
    }

    public function tambahMenuPrasmanan($data)
    {
        $this->db->insert('tbl_menu_prasmanan', $data);
    }

    public function tambahItem($data)
    {
        $this->db->insert('tbl_item', $data);
    }

    public function tambahPaket($data)
    {
        $this->db->insert('tbl_paket', $data);
    }

    public function tambahPaketMenu($data)
    {
        $this->db->insert('tbl_paket_menu', $data);
    }

    public function tambahPaketKategori($data)
    {
        $this->db->insert('tbl_paket_kategori', $data);
    }

    public function tambahPaketCustom($data)
    {
        $this->db->insert('tbl_paket_custom', $data);
    }
    public function tambahPaketPrasmanan($data)
    {
        $this->db->insert('tbl_paket_prasmanan', $data);
    }

    public function tambahUser($data)
    {
        $this->db->insert('tbl_user', $data);
    }

    public function tambahKontrak($data)
    {
        $this->db->insert('tbl_kontrak', $data);
    }


    // EDIT DATA
    public function editMenu($id_menu, $data)
    {
        $this->db->where('id_menu', $id_menu)->update('tbl_menu', $data);
    }

    public function editMenuPrasmanan($id_menu_prasmanan, $data)
    {
        $this->db->where('id_menu_prasmanan', $id_menu_prasmanan)->update('tbl_menu_prasmanan', $data);
    }

    public function editItem($id_item, $data)
    {
        $this->db->where('id_item', $id_item)->update('tbl_item', $data);
    }

    public function editPaket($id_paket, $data)
    {
        $this->db->where('id_paket', $id_paket)->update('tbl_paket', $data);
    }

    public function editPaketPrasmanan($id_paket_prasmanan, $data)
    {
        $this->db->where('id_paket_prasmanan', $id_paket_prasmanan)->update('tbl_paket_prasmanan', $data);
    }

    public function editPaketMenu($id_paket_menu, $data)
    {
        $this->db->where('id_paket_menu', $id_paket_menu)->update('tbl_paket_menu', $data);
    }

    public function editPaketKategori($id_paket_kategori, $data)
    {
        $this->db->where('id_paket_kategori', $id_paket_kategori)->update('tbl_paket_kategori', $data);
    }

    public function editPaketCustom($id_paket_custom, $data)
    {
        $this->db->where('id_paket_custom', $id_paket_custom)->update('tbl_paket_custom', $data);
    }

    public function editTransaksi($kode_pesanan, $data)
    {
        $this->db->where('kode_pesanan', $kode_pesanan)->update('tbl_pesanan', $data);
    }

    public function editTransaksiPerusahaan($id_pesanan_perusahaan, $data)
    {
        $this->db->where('id_pesanan_perusahaan', $id_pesanan_perusahaan)->update('tbl_pesanan_perusahaan', $data);
    }

    public function editUser($id_user, $data)
    {
        $this->db->where('id_user', $id_user)->update('tbl_user', $data);
    }

    public function editProfile($id_user, $data)
    {
        $this->db->where('id_user', $id_user)->update('tbl_user', $data);
    }

    public function editKontrak($id_kontrak, $data)
    {
        $this->db->where('id_kontrak', $id_kontrak)->update('tbl_kontrak', $data);
    }


    // HAPUS DATA
    public function hapusMenu($id_menu)
    {
        $this->db->delete('tbl_paket_menu', ['id_menu' => $id_menu]);
        $this->db->delete('tbl_paket_custom', ['id_menu' => $id_menu]);
        $this->db->delete('tbl_item', ['id_menu' => $id_menu]);
        $this->db->delete('tbl_menu', ['id_menu' => $id_menu]);
    }

    public function hapusMenuPrasmanan($id_menu_prasmanan)
    {
        $this->db->delete('tbl_paket_prasmanan', ['id_menu_prasmanan' => $id_menu_prasmanan]);
        $this->db->delete('tbl_menu_prasmanan', ['id_menu_prasmanan' => $id_menu_prasmanan]);
    }

    public function hapusItem($id_item)
    {
        $this->db->delete('tbl_item', ['id_item' => $id_item]);
    }

    public function hapusPaket($id_paket)
    {
        $this->db->delete('tbl_paket_menu', ['id_paket' => $id_paket]);
        $this->db->delete('tbl_paket_custom', ['id_paket' => $id_paket]);
        $this->db->delete('tbl_paket', ['id_paket' => $id_paket]);
    }

    public function hapusPaketMenu($id_paket_menu)
    {
        $this->db->delete('tbl_paket_menu', ['id_paket_menu' => $id_paket_menu]);
    }

    public function hapusPaketKategori($id_paket_kategori)
    {
        $this->db->delete('tbl_paket', ['id_paket_kategori' => $id_paket_kategori]);
        $this->db->delete('tbl_paket_kategori', ['id_paket_kategori' => $id_paket_kategori]);
    }

    public function hapusPaketCustom($id_paket_custom)
    {
        $this->db->delete('tbl_paket_custom', ['id_paket_custom' => $id_paket_custom]);
    }

    public function hapusPaketPrasmanan($id_paket_prasmanan)
    {
        $this->db->delete('tbl_paket_prasmanan', ['id_paket_prasmanan' => $id_paket_prasmanan]);
    }

    public function hapusTransaksiPembatalan($kode_pesanan)
    {
        $this->db->delete('tbl_pesanan_detail', ['kode_pesanan' => $kode_pesanan]);
        $this->db->delete('tbl_transaksi', ['kode_pesanan' => $kode_pesanan]);
        $this->db->delete('tbl_pembatalan_pesanan', ['kode_pesanan' => $kode_pesanan]);
        $this->db->delete('tbl_pesanan', ['kode_pesanan' => $kode_pesanan]);
    }

    public function hapusUser($id_user)
    {
        // Mendapatkan daftar kode_pesanan yang terkait dengan id_user
        $this->db->select('kode_pesanan');
        $this->db->from('tbl_pesanan');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        $pesanan_ids = $query->result_array();

        // Menghapus data dari tbl_pesanan_detail berdasarkan daftar kode_pesanan
        foreach ($pesanan_ids as $pesanan) {
            $this->db->delete('tbl_pesanan_detail', ['kode_pesanan' => $pesanan['kode_pesanan']]);
            $this->db->delete('tbl_transaksi', ['kode_pesanan' => $pesanan['kode_pesanan']]);
            $this->db->delete('tbl_pembatalan_pesanan', ['kode_pesanan' => $pesanan['kode_pesanan']]);
        }

        // Menghapus data dari tbl_keranjang, tbl_pesanan, dan tbl_user
        $this->db->delete('tbl_keranjang', ['id_user' => $id_user]);
        $this->db->delete('tbl_pesanan', ['id_user' => $id_user]);
        $this->db->delete('tbl_user', ['id_user' => $id_user]);
    }

    public function hapusFeedback($id_feedback)
    {
        $this->db->delete('tbl_feedback', ['id_feedback' => $id_feedback]);
    }

    public function hapusKontrak($id_kontrak)
    {
        $this->db->delete('tbl_kontrak', ['id_kontrak' => $id_kontrak]);
    }
}

/* End of file Model_admin.php */
