<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_direktur extends CI_Model
{
    // GET TOTAL DATA
    public function getTotalPaket()
    {
        return $this->db->count_all('tbl_paket');
    }

    public function getTotalPemesanan()
    {
        return $this->db->count_all('tbl_pesanan');
    }

    public function getTotalTransaksi()
    {
        return $this->db->count_all('tbl_transaksi');
    }

    public function getTotalTransaksiPembatalan()
    {
        return $this->db->count_all('tbl_pembatalan_pesanan');
    }


    // GET ALL DATA
    public function getAllPesanan()
    {
        $this->db->join('tbl_transaksi AS t', 't.kode_pesanan = p.kode_pesanan', 'LEFT');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        $this->db->where('p.status_pengiriman', 'selesai');
        return $this->db->get('tbl_pesanan AS p')->result_array();
    }

    public function getAllPesananPerusahaan()
    {
        $this->db->join('tbl_user AS u', 'u.id_user = pp.id_user', 'INNER');
        $this->db->where('pp.status_pengiriman', 'selesai');
        return $this->db->get('tbl_pesanan_perusahaan AS pp')->result_array();
    }

    public function getAllTransaski()
    {
        $this->db->select('p.kode_pesanan, u.nama_lengkap, p.tanggal_pemesanan, p.tanggal_pengiriman, p.metode_pembayaran, p.opsi_pembayaran, p.total');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        $this->db->group_by('p.kode_pesanan');
        $transaksi = $this->db->get('tbl_pesanan AS p')->result_array();

        foreach ($transaksi as &$trans) {
            $this->db->select('pd.kode_pesanan, pt.nama_paket, pd.jumlah');
            $this->db->join('tbl_paket AS pt', 'pt.id_paket = pd.id_paket', 'INNER');
            $this->db->where('pd.kode_pesanan', $trans['kode_pesanan']);
            $trans['paket'] = $this->db->get('tbl_pesanan_detail AS pd')->result_array();
        }

        return $transaksi;
    }

    public function filterLaporanExcel($tanggal_awal, $tanggal_akhir)
    {
        $this->db->join('tbl_transaksi AS t', 't.kode_pesanan = p.kode_pesanan', 'LEFT');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        $this->db->where('tanggal_pemesanan >=', $tanggal_awal);
        $this->db->where('tanggal_pemesanan <=', $tanggal_akhir . ' 23:59:59');
        $this->db->where('p.status_pengiriman', 'selesai');

        return $this->db->get('tbl_pesanan AS p')->result_array();
    }

    public function filterLaporanPdf($tanggal_awal, $tanggal_akhir)
    {
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        $this->db->where('tanggal_pemesanan >=', $tanggal_awal);
        $this->db->where('tanggal_pemesanan <=', $tanggal_akhir . ' 23:59:59');
        $this->db->where('p.status_pengiriman', 'selesai');
        $this->db->group_by('p.kode_pesanan');
        $transaksi = $this->db->get('tbl_pesanan AS p')->result_array();

        foreach ($transaksi as &$trans) {
            $this->db->join('tbl_paket AS pt', 'pt.id_paket = pd.id_paket', 'INNER');
            $this->db->where('pd.kode_pesanan', $trans['kode_pesanan']);
            $trans['paket'] = $this->db->get('tbl_pesanan_detail AS pd')->result_array();
        }

        return $transaksi;
    }

    public function filterExcel($tanggal_awal, $tanggal_akhir)
    {
        $this->db->join('tbl_user AS u', 'u.id_user = pp.id_user', 'INNER');
        $this->db->where('tanggal_pemesanan >=', $tanggal_awal);
        $this->db->where('tanggal_pemesanan <=', $tanggal_akhir . ' 23:59:59');
        $this->db->where('pp.status_pengiriman', 'selesai');

        return $this->db->get('tbl_pesanan_perusahaan AS pp')->result_array();
    }

    public function filterPdf($tanggal_awal, $tanggal_akhir)
    {
        $this->db->join('tbl_user AS u', 'u.id_user = pp.id_user', 'INNER');
        $this->db->where('tanggal_pemesanan >=', $tanggal_awal);
        $this->db->where('tanggal_pemesanan <=', $tanggal_akhir . ' 23:59:59');
        $this->db->where('pp.status_pengiriman', 'selesai');
        $this->db->group_by('pp.id_pesanan_perusahaan');
        $transaksi = $this->db->get('tbl_pesanan_perusahaan AS pp')->result_array();

        foreach ($transaksi as &$trans) {
            $this->db->join('tbl_paket AS p', 'p.id_paket = pdp.id_paket', 'INNER');
            $this->db->where('pdp.id_pesanan_perusahaan', $trans['id_pesanan_perusahaan']);
            $trans['paket'] = $this->db->get('tbl_pesanan_detail_perusahaan AS pdp')->result_array();
        }

        return $transaksi;
    }


    // GET DATA BY ID
    public function getUserById($id_user)
    {
        return $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();
    }



    // EDIT DATA
    public function editProfile($id_user, $data)
    {
        $this->db->where('id_user', $id_user)->update('tbl_user', $data);
    }
}

/* End of file Model_direktur.php */
