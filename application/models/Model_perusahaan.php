<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_perusahaan extends CI_Model
{

    // CEK DATA
    public function cekKontrak($id_user)
    {
        $this->db->select('tanggal_awal, tanggal_akhir');
        $this->db->from('tbl_kontrak');
        $this->db->where('id_user', $id_user);
        $kontrak = $this->db->get()->row();

        if ($kontrak) {
            $tanggal_awal = $kontrak->tanggal_awal;
            $tanggal_akhir = $kontrak->tanggal_akhir;
            $sekarang = date('Y-m-d');

            if (strtotime($tanggal_awal) > strtotime($sekarang)) {
                return 'belum_mulai';
            } elseif (strtotime($tanggal_akhir) < strtotime($sekarang)) {
                return 'habis_kontrak';
            } else {
                return 'aktif';
            }
        }

        return 'belum_kontrak';
    }




    // GET DATA BY ID
    public function getKontrakById($id_user)
    {
        $this->db->where('k.id_user', $id_user);
        $this->db->join('tbl_user AS u', 'u.id_user = k.id_user', 'INNER');
        return $this->db->get('tbl_kontrak AS k')->row_array();
    }

    public function getUserById($id_user)
    {
        return $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();
    }

    public function getJumlahItem($id_user)
    {
        return $this->db->where('id_user', $id_user)->from('tbl_keranjang')->count_all_results();
    }

    public function getPaketByPaketKategori($kategori)
    {
        $this->db->where('paket_kategori.nama_kategori', $kategori);
        $this->db->join('tbl_paket_kategori AS paket_kategori', 'paket_kategori.id_paket_kategori = paket.id_paket_kategori', 'INNER');
        return $this->db->get('tbl_paket AS paket')->result_array();
    }

    public function getKeranjangByUserId($id_user)
    {
        $this->db->from('tbl_keranjang AS keranjang');
        $this->db->join('tbl_paket AS paket', 'paket.id_paket = keranjang.id_paket', 'INNER');
        $this->db->where('keranjang.id_user', $id_user);
        $this->db->order_by('paket.nama_paket', 'ASC');
        return $this->db->get()->result_array();
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

    public function getKeranjangById($id_keranjang)
    {
        return $this->db->get_where('tbl_keranjang', ['id_keranjang' => $id_keranjang])->row_array();
    }

    public function getItemById($id_item)
    {
        return $this->db->get_where('tbl_item', ['id_item' => $id_item])->row();
    }

    public function getPaketById($id_paket)
    {
        $this->db->where('p.id_paket', $id_paket);
        $this->db->join('tbl_paket_kategori AS pk', 'pk.id_paket_kategori = p.id_paket_kategori', 'INNER');
        $this->db->join('tbl_paket_menu AS pm', 'pm.id_paket = p.id_paket', 'LEFT');
        return $this->db->get('tbl_paket AS p')->row_array();
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

    public function getCartItem($id_user, $id_paket)
    {
        return $this->db->get_where('tbl_keranjang', [
            'id_user' => $id_user,
            'id_paket' => $id_paket,
            'custom_item' => null
        ])->row_array();
    }

    public function updateCartRegular($id_user, $id_paket, $jumlah)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_paket', $id_paket);
        $this->db->where('custom_item IS NULL');
        $this->db->update('tbl_keranjang', ['jumlah' => $jumlah]);
    }

    public function getCustomCartItem($id_user, $id_paket, $custom_item)
    {
        return $this->db->get_where('tbl_keranjang', [
            'id_user'       => $id_user,
            'id_paket'      => $id_paket,
            'custom_item'   => $custom_item
        ])->row_array();
    }

    public function getKeranjangByIdUser($id_user)
    {
        return $this->db->where('id_user', $id_user)->get('tbl_keranjang')->result_array();
    }

    public function getPesananByUserId($id_user)
    {
        return $this->db->where('id_user', $id_user)->order_by('tanggal_pemesanan', 'DESC')->get('tbl_pesanan_perusahaan')->result_array();
    }

    public function getPesananById($id_pesanan_perusahaan)
    {
        return $this->db->where('id_pesanan_perusahaan', $id_pesanan_perusahaan)->get('tbl_pesanan_perusahaan')->result_array();
    }

    public function getDetailPesananByIdPesanan($id_pesanan_perusahaan)
    {
        $this->db->where('pdp.id_pesanan_perusahaan', $id_pesanan_perusahaan);
        $this->db->join('tbl_paket AS p', 'p.id_paket = pdp.id_paket', 'INNER');
        $this->db->join('tbl_pesanan_perusahaan AS pp', 'pp.id_pesanan_perusahaan = pdp.id_pesanan_perusahaan', 'INNER');
        return $this->db->get('tbl_pesanan_detail_perusahaan AS pdp')->result_array();
    }



    // GET ALL DATA
    public function getAllFeedback()
    {
        $this->db->join('tbl_user AS u', 'u.id_user = fb.id_user', 'INNER');
        return $this->db->get('tbl_feedback AS fb')->result_array();
    }

    public function getAllKategori()
    {
        return $this->db->get('tbl_paket_kategori')->result_array();
    }

    public function getAllPaket($id_user)
    {
        $this->db->join('tbl_kontrak AS k', 'k.harga_paket = p.harga', 'INNER');
        $this->db->join('tbl_paket_kategori AS pk', 'pk.id_paket_kategori = p.id_paket_kategori', 'INNER');
        $this->db->where('k.id_user', $id_user);
        $this->db->where('pk.nama_kategori !=', 'prasmanan');

        return $this->db->get('tbl_paket AS p')->result_array();
    }

    public function getAllPaketPrasmanan($id_user)
    {
        $this->db->join('tbl_kontrak AS k', 'k.harga_paket = p.harga', 'INNER');
        $this->db->join('tbl_paket_kategori AS pk', 'pk.id_paket_kategori = p.id_paket_kategori', 'INNER');
        $this->db->where('k.id_user', $id_user);
        $this->db->where('pk.nama_kategori', 'prasmanan');

        return $this->db->get('tbl_paket AS p')->result_array();
    }





    // TAMBAH DATA
    public function addCart($data)
    {
        return $this->db->insert('tbl_keranjang', $data);
    }

    public function tambahFeedback($data)
    {
        $this->db->insert('tbl_feedback', $data);
    }

    public function addPesanan($data_pesanan)
    {
        $this->db->insert('tbl_pesanan_perusahaan', $data_pesanan);
        return $this->db->insert_id(); // Mengembalikan ID dari record yang baru ditambahkan
    }

    public function addDetailPesanan($data_pesanan)
    {
        return $this->db->insert('tbl_pesanan_detail_perusahaan', $data_pesanan);
    }





    // EDIT DATA
    public function editKeranjang($id_keranjang, $data)
    {
        $this->db->where('id_keranjang', $id_keranjang);
        $this->db->update('tbl_keranjang', $data);
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



    // HAPUS DATA
    public function deleteItem($id_keranjang)
    {
        $this->db->delete('tbl_keranjang', ['id_user' => $id_keranjang]);
        $this->db->delete('tbl_keranjang', ['id_paket' => $id_keranjang]);
        $this->db->delete('tbl_keranjang', ['id_keranjang' => $id_keranjang]);
    }

    public function deleteCart($id_user)
    {
        $this->db->delete('tbl_keranjang', ['id_user' => $id_user]);
    }

    public function hapusPesanan($id_pesanan_perusahaan)
    {
        $this->db->delete('tbl_pesanan_detail_perusahaan', ['id_pesanan_perusahaan' => $id_pesanan_perusahaan]);
        $this->db->delete('tbl_pesanan_perusahaan', ['id_pesanan_perusahaan' => $id_pesanan_perusahaan]);
    }
}

/* End of file Model_perusahaan.php */
