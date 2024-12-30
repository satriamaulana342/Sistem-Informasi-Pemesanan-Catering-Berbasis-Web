<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    // GET DATA
    public function getAllKategori()
    {
        return $this->db->get('tbl_paket_kategori')->result_array();
    }

    public function getAllPaket()
    {
        $this->db->join('tbl_paket_kategori AS paket_kategori', 'paket_kategori.id_paket_kategori = paket.id_paket_kategori', 'INNER');
        $this->db->where('paket_kategori.nama_kategori !=', 'prasmanan');
        return $this->db->get('tbl_paket AS paket')->result_array();
    }

    public function getAllPaketPrasmanan()
    {
        $this->db->join('tbl_paket_kategori AS pk', 'pk.id_paket_kategori = p.id_paket_kategori', 'INNER');
        $this->db->where('pk.nama_kategori', 'prasmanan');
        return $this->db->get('tbl_paket AS p')->result_array();
    }

    public function getAllFeedback()
    {
        $this->db->join('tbl_user AS u', 'u.id_user = fb.id_user', 'INNER');
        return $this->db->get('tbl_feedback AS fb')->result_array();
    }

    public function getPaketByPaketKategori($kategori)
    {
        $this->db->where('paket_kategori.nama_kategori', $kategori);
        $this->db->join('tbl_paket_kategori AS paket_kategori', 'paket_kategori.id_paket_kategori = paket.id_paket_kategori', 'INNER');
        return $this->db->get('tbl_paket AS paket')->result_array();
    }

    public function getPaketById($id_paket)
    {
        $this->db->where('p.id_paket', $id_paket);
        $this->db->join('tbl_paket_kategori AS pk', 'pk.id_paket_kategori = p.id_paket_kategori', 'INNER');
        $this->db->join('tbl_paket_menu AS pm', 'pm.id_paket = p.id_paket', 'LEFT');
        return $this->db->get('tbl_paket AS p')->row_array();
    }

    public function getPaketPrasmananById($id_paket)
    {
        $this->db->where('p.id_paket', $id_paket);
        // $this->db->join('tbl_paket_kategori AS pk', 'pk.id_paket_kategori = p.id_paket_kategori', 'INNER');
        // $this->db->join('tbl_paket_prasmanan AS pp', 'pp.id_paket = p.id_paket', 'LEFT');
        return $this->db->get('tbl_paket AS p')->row_array();
    }

    public function getMenuPrasmananByPaketId($id_paket)
    {
        $this->db->where('pp.id_paket', $id_paket);
        $this->db->join('tbl_paket_prasmanan AS pp', 'pp.id_menu_prasmanan = mp.id_menu_prasmanan', 'INNER');
        $this->db->order_by('mp.nama_menu', 'ASC');
        return $this->db->get('tbl_menu_prasmanan AS mp')->result_array();
    }

    public function getMenuByPaketId($id_paket)
    {
        $this->db->where('paket_menu.id_paket', $id_paket);
        $this->db->join('tbl_paket_menu AS paket_menu', 'paket_menu.id_menu = menu.id_menu', 'INNER');
        $this->db->order_by('menu.nama_menu', 'ASC');
        return $this->db->get('tbl_menu AS menu')->result_array();
    }

    public function getMenuCustomByIdPaket($id_paket)
    {
        $this->db->where('pc.id_paket', $id_paket);
        $this->db->join('tbl_menu AS m', 'm.id_menu = pc.id_menu', 'INNER');
        $this->db->join('tbl_item AS i', 'i.id_item = pc.id_item', 'INNER');
        $this->db->order_by('m.nama_menu', 'ASC');
        return $this->db->get('tbl_paket_custom AS pc')->result_array();
    }

    public function getMenuItemsByPaketId($id_paket)
    {
        $this->db->select('tbl_menu.id_menu, tbl_menu.nama_menu');
        $this->db->from('tbl_paket_custom');
        $this->db->join('tbl_menu', 'tbl_paket_custom.id_menu = tbl_menu.id_menu');
        $this->db->where('tbl_paket_custom.id_paket', $id_paket);
        $this->db->group_by('tbl_menu.id_menu');
        $this->db->order_by('tbl_menu.nama_menu', 'ASC');

        $query = $this->db->get();

        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->id_menu] = $row->nama_menu;
        }

        return $result;
    }

    public function getCustomItemsByMenuId($menu_id)
    {
        $this->db->select('tbl_item.id_item, tbl_item.nama_item');
        $this->db->from('tbl_item');
        $this->db->join('tbl_paket_custom', 'tbl_item.id_item = tbl_paket_custom.id_item');
        $this->db->where('tbl_paket_custom.id_menu', $menu_id);
        $this->db->group_by('tbl_item.id_item');
        $this->db->order_by('tbl_item.nama_item', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function getItemsByMenuId($id_menu)
    {
        return $this->db->get_where('tbl_item', ['id_menu' => $id_menu])->result();
    }

    public function getItemById($id_item)
    {
        return $this->db->get_where('tbl_item', ['id_item' => $id_item])->row();
    }

    public function getKeranjangByUserId($id_user)
    {
        $this->db->from('tbl_keranjang AS keranjang');
        $this->db->join('tbl_paket AS paket', 'paket.id_paket = keranjang.id_paket', 'INNER');
        $this->db->where('keranjang.id_user', $id_user);
        $this->db->order_by('paket.nama_paket', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getPaketByKategori($kategori)
    {
        $this->db->where('paket_kategori.nama_kategori', $kategori);
        $this->db->join('tbl_paket_kategori AS paket_kategori', 'paket_kategori.id_paket_kategori = paket.id_paket_kategori', 'INNER');
        $this->db->order_by('paket.nama_paket', 'ASC');
        return $this->db->get('tbl_paket AS paket')->result_array();
    }

    public function getKeranjangByIdUser($id_user)
    {
        return $this->db->where('id_user', $id_user)->get('tbl_keranjang')->result_array();
    }

    public function getKeranjangById($id_keranjang)
    {
        return $this->db->get_where('tbl_keranjang', ['id_keranjang' => $id_keranjang])->row_array();
    }

    public function getPesananByUserId($id_user)
    {
        return $this->db->where('id_user', $id_user)->order_by('tanggal_pemesanan', 'DESC')->get('tbl_pesanan')->result_array();
    }

    public function getPesananById($kode_pesanan)
    {
        return $this->db->where('kode_pesanan', $kode_pesanan)->get('tbl_pesanan')->result_array();
    }

    public function getDetailPesananByIdPesanan($kode_pesanan)
    {
        $this->db->where('pesanan_detail.kode_pesanan', $kode_pesanan);
        $this->db->join('tbl_paket AS paket', 'paket.id_paket = pesanan_detail.id_paket', 'INNER');
        $this->db->join('tbl_pesanan AS pesanan', 'pesanan.kode_pesanan = pesanan_detail.kode_pesanan', 'INNER');
        return $this->db->get('tbl_pesanan_detail AS pesanan_detail')->result_array();
    }

    public function getNamaMenuByIdPaket($id_paket)
    {
        $this->db->from('tbl_paket_menu AS pm');
        $this->db->join('tbl_menu AS m', 'm.id_menu = pm.id_menu', 'INNER');
        $this->db->where('pm.id_paket', $id_paket);
        $query = $this->db->get();

        // Concatenate menu names
        $menu_names = [];
        foreach ($query->result() as $row) {
            $menu_names[] = $row->nama_menu;
        }

        return implode(', ', $menu_names);
    }

    public function getTransaksiById($id_transaksi)
    {
        return $this->db->where('id_transaksi', $id_transaksi)->get('tbl_transaksi')->row_array();
    }

    public function getPembatalanPesananById($id_pembatalan_pesanan)
    {
        return $this->db->where('id_pembatalan_pesanan', $id_pembatalan_pesanan)->get('tbl_pembatalan_pesanan')->row_array();
    }

    public function getTransaksiByIdPesanan($kode_pesanan)
    {
        return $this->db->where('kode_pesanan', $kode_pesanan)->get('tbl_transaksi')->row_array();
    }

    public function getPembatalanPesananByIdPesanan($kode_pesanan)
    {
        return $this->db->where('kode_pesanan', $kode_pesanan)->get('tbl_pembatalan_pesanan')->row_array();
    }

    public function getJumlahItem($id_user)
    {
        return $this->db->where('id_user', $id_user)->from('tbl_keranjang')->count_all_results();
    }

    public function getCartItem($id_user, $id_paket)
    {
        return $this->db->get_where('tbl_keranjang', [
            'id_user' => $id_user,
            'id_paket' => $id_paket,
            'custom_item' => null
        ])->row_array();
    }

    public function getCustomCartItem($id_user, $id_paket, $custom_item)
    {
        return $this->db->get_where('tbl_keranjang', [
            'id_user'       => $id_user,
            'id_paket'      => $id_paket,
            'custom_item'   => $custom_item
        ])->row_array();
    }

    public function getUserById($id_user)
    {
        return $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();
    }

    // Dalam file application\models\Model_paket_menu.php
    public function getMenuPaket($id_paket)
    {
        $this->db->where('id_paket', $id_paket);
        $query = $this->db->get('tbl_paket_menu');
        return $query->num_rows() > 0;
    }



    // ADD DATA
    public function addCart($data)
    {
        return $this->db->insert('tbl_keranjang', $data);
    }

    public function addPesanan($data_pesanan)
    {
        return $this->db->insert('tbl_pesanan', $data_pesanan);
    }

    public function addDetailPesanan($data_pesanan)
    {
        return $this->db->insert('tbl_pesanan_detail', $data_pesanan);
    }

    public function addTransaksi($data)
    {
        $this->db->insert('tbl_transaksi', $data);
    }

    public function addPembatalanPesanan($data)
    {
        $this->db->insert('tbl_pembatalan_pesanan', $data);
    }

    public function tambahFeedback($data)
    {
        $this->db->insert('tbl_feedback', $data);
    }



    // UPDATE DATA
    public function editKeranjang($id_keranjang, $data)
    {
        $this->db->where('id_keranjang', $id_keranjang);
        $this->db->update('tbl_keranjang', $data);
    }

    public function updateTransaksi($id_transaksi, $data)
    {
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('tbl_transaksi', $data);
    }

    public function updatePembatalanPesanan($id_pembatalan_pesanan, $data)
    {
        $this->db->where('id_pembatalan_pesanan', $id_pembatalan_pesanan);
        $this->db->update('tbl_pembatalan_pesanan', $data);
    }

    public function updateCartRegular($id_user, $id_paket, $jumlah)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_paket', $id_paket);
        $this->db->where('custom_item IS NULL');
        $this->db->update('tbl_keranjang', ['jumlah' => $jumlah]);
    }

    public function updateCartCustom($id_user, $id_paket, $new_jumlah, $custom_item = null)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_paket', $id_paket);

        if ($custom_item !== null) {
            $this->db->where('custom_item', $custom_item);
        }

        $this->db->update('tbl_keranjang', ['jumlah' => $new_jumlah]);
    }

    public function updateUser($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->update('tbl_user', $data);
    }

    public function updatePesanan($kode_pesanan, $data)
    {
        $this->db->where('kode_pesanan', $kode_pesanan);
        $this->db->update('tbl_pesanan', $data);
    }

    public function batalkanPesanan()
    {
        $current_time = date('Y-m-d H:i:s');
        $this->db->where('status_pembayaran', 'belum diterima');
        $this->db->where('batas_waktu_upload <', $current_time);
        $this->db->update('tbl_pesanan', ['status_pembayaran' => 'dibatalkan']);
    }



    // DELETE DATA
    public function deleteItem($id_keranjang)
    {
        $this->db->delete('tbl_keranjang', ['id_user' => $id_keranjang]);
        $this->db->delete('tbl_keranjang', ['id_paket' => $id_keranjang]);
        $this->db->delete('tbl_keranjang', ['id_keranjang' => $id_keranjang]);
    }

    public function hapusPesanan($kode_pesanan)
    {
        $this->db->delete('tbl_pesanan_detail', ['kode_pesanan' => $kode_pesanan]);
        $this->db->delete('tbl_transaksi', ['kode_pesanan' => $kode_pesanan]);
        $this->db->delete('tbl_pembatalan_pesanan', ['kode_pesanan' => $kode_pesanan]);
        $this->db->delete('tbl_pesanan', ['kode_pesanan' => $kode_pesanan]);
    }

    public function deleteCart($id_user)
    {
        $this->db->delete('tbl_keranjang', ['id_user' => $id_user]);
    }

    public function hapusTransaksi($kode_pesanan)
    {
        $this->db->delete('tbl_pesanan_detail', ['kode_pesanan' => $kode_pesanan]);
        $this->db->delete('tbl_transaksi', ['kode_pesanan' => $kode_pesanan]);
    }

    public function hapusPesananDetail($kode_pesanan)
    {
        $this->db->delete('tbl_pesanan_detail', ['kode_pesanan' => $kode_pesanan]);
    }
}

/* End of file Model_user.php */
