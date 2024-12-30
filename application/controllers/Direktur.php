<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

defined('BASEPATH') or exit('No direct script access allowed');

class Direktur extends CI_Controller
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
            'title'             => 'Dashboard',
            'total_paket'       => $this->Model_direktur->getTotalPaket(),
            'total_pemesanan'   => $this->Model_direktur->getTotalPemesanan(),
            'total_transaksi'   => $this->Model_direktur->getTotalTransaksi(),
            'total_pembatalan'  => $this->Model_direktur->getTotalTransaksiPembatalan(),
        ];

        $this->load->view('templates/direktur/header', $data);
        $this->load->view('templates/direktur/sidebar');
        $this->load->view('templates/direktur/topbar');
        $this->load->view('direktur/dashboard');
        $this->load->view('templates/direktur/footer');
    }

    // LAPORAN TRANSAKSI
    public function laporan_transaksi()
    {
        $data = [
            'title'     => 'Laporan Transaksi',
            'pesanan'   => $this->Model_direktur->getAllPesanan(),
        ];

        $this->load->view('templates/direktur/header', $data);
        $this->load->view('templates/direktur/sidebar');
        $this->load->view('templates/direktur/topbar');
        $this->load->view('direktur/laporan_transaksi');
        $this->load->view('templates/direktur/footer');
    }

    public function print_laporan_pdf()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'transaksi'    => $this->Model_direktur->filterLaporanPdf($tanggal_awal, $tanggal_akhir),
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ];

        $this->load->view('templates/direktur/header', $data);
        $this->load->view('direktur/laporan_pdf', $data);
    }

    public function print_laporan_excel()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'pesanan' => $this->Model_direktur->filterLaporanExcel($tanggal_awal, $tanggal_akhir)
        ];

        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();

        // Set properties
        $object->getProperties()->setCreator("Hanseee");
        $object->getProperties()->setLastModifiedBy("Hanseee");
        $object->getProperties()->setTitle("Laporan Transaksi");

        $object->setActiveSheetIndex(0);

        // Set header cells
        $object->getActiveSheet()->setCellValue('A1', 'No');
        $object->getActiveSheet()->setCellValue('B1', 'Nama Lengkap');
        $object->getActiveSheet()->setCellValue('C1', 'Tanggal Pemesanan');
        $object->getActiveSheet()->setCellValue('D1', 'Tanggal Pengiriman');
        $object->getActiveSheet()->setCellValue('E1', 'Waktu Pengiriman');
        $object->getActiveSheet()->setCellValue('F1', 'Metode Pembayaran');
        $object->getActiveSheet()->setCellValue('G1', 'Status Transaksi');
        $object->getActiveSheet()->setCellValue('H1', 'Total');

        // Styling header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => '095B34'],
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
        ];

        $object->getActiveSheet()->getStyle('A1:H1')->applyFromArray($headerStyle);

        // Set column width
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('H')->setWidth(30);

        $row = 2;

        foreach ($data['pesanan'] as $tr) {
            $object->getActiveSheet()->setCellValue('A' . $row, $row - 1);
            $object->getActiveSheet()->setCellValue('B' . $row, ucwords($tr['nama_lengkap']));
            $object->getActiveSheet()->setCellValue('C' . $row, $tr['tanggal_pemesanan']);
            $object->getActiveSheet()->setCellValue('D' . $row, $tr['tanggal_pengiriman']);
            $object->getActiveSheet()->setCellValue('E' . $row, $tr['waktu_pengiriman']);
            $object->getActiveSheet()->setCellValue('F' . $row, ucwords($tr['metode_pembayaran']));
            $object->getActiveSheet()->setCellValue('G' . $row, ucwords($tr['status_pengiriman']));
            $object->getActiveSheet()->setCellValue('H' . $row, $tr['total']);

            $cellStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ],
            ];

            $object->getActiveSheet()->getStyle('A' . $row . ':H' . $row)->applyFromArray($cellStyle);

            $row++;
        }

        $filename = "Laporan Transaksi.xlsx";

        $object->getActiveSheet()->setTitle('Laporan Transaksi');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $writer->save('php://output');
        exit;
    }


    // LAPORAN TRANSAKSI PERUSAHAAN
    public function laporan_transaksi_perusahaan()
    {
        $data = [
            'title'     => 'Laporan Transaksi Perusahaan',
            'pesanan'   => $this->Model_direktur->getAllPesananPerusahaan(),
        ];

        $this->load->view('templates/direktur/header', $data);
        $this->load->view('templates/direktur/sidebar');
        $this->load->view('templates/direktur/topbar');
        $this->load->view('direktur/laporan_transaksi_perusahaan');
        $this->load->view('templates/direktur/footer');
    }

    public function transaksi_perusahaan_pdf()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'transaksi'    => $this->Model_direktur->filterPdf($tanggal_awal, $tanggal_akhir),
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ];

        $this->load->view('templates/direktur/header', $data);
        $this->load->view('direktur/laporan_pdf', $data);
    }

    public function transaksi_perusahaan_excel()
    {
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $data = [
            'pesanan' => $this->Model_direktur->filterExcel($tanggal_awal, $tanggal_akhir)
        ];

        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();

        // Set properties
        $object->getProperties()->setCreator("Hanseee");
        $object->getProperties()->setLastModifiedBy("Hanseee");
        $object->getProperties()->setTitle("Laporan Transaksi Perusahaan");

        $object->setActiveSheetIndex(0);

        // Set header cells
        $object->getActiveSheet()->setCellValue('A1', 'No');
        $object->getActiveSheet()->setCellValue('B1', 'Nama Lengkap');
        $object->getActiveSheet()->setCellValue('C1', 'Tanggal Pemesanan');
        $object->getActiveSheet()->setCellValue('D1', 'Tanggal Pengiriman');
        $object->getActiveSheet()->setCellValue('E1', 'Waktu Pengiriman');
        $object->getActiveSheet()->setCellValue('F1', 'Status Transaksi');
        $object->getActiveSheet()->setCellValue('G1', 'Total');

        // Styling header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => '095B34'],
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
        ];

        $object->getActiveSheet()->getStyle('A1:G1')->applyFromArray($headerStyle);

        // Set column width
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $object->getActiveSheet()->getColumnDimension('G')->setWidth(30);

        $row = 2;

        foreach ($data['pesanan'] as $tr) {
            $object->getActiveSheet()->setCellValue('A' . $row, $row - 1);
            $object->getActiveSheet()->setCellValue('B' . $row, ucwords($tr['nama_lengkap']));
            $object->getActiveSheet()->setCellValue('C' . $row, $tr['tanggal_pemesanan']);
            $object->getActiveSheet()->setCellValue('D' . $row, $tr['tanggal_pengiriman']);
            $object->getActiveSheet()->setCellValue('E' . $row, $tr['waktu_pengiriman']);
            $object->getActiveSheet()->setCellValue('F' . $row, ucwords($tr['status_pengiriman']));
            $object->getActiveSheet()->setCellValue('G' . $row, $tr['total']);

            $cellStyle = [
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ],
            ];

            $object->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->applyFromArray($cellStyle);

            $row++;
        }

        $filename = "Laporan Transaksi Perusahaan.xlsx";

        $object->getActiveSheet()->setTitle('Laporan Transaksi Perusahaan');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $writer->save('php://output');
        exit;
    }


    // PROFILE
    public function profile()
    {
        $id_user    = $this->session->userdata('id_user');
        $user       = $this->Model_direktur->getUserById($id_user);

        if (!$id_user) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        $data = [
            'title'     => 'Data Profile',
            'id_user'   => $id_user,
            'user'      => $user,
        ];

        $this->load->view('templates/direktur/header', $data);
        $this->load->view('templates/direktur/sidebar');
        $this->load->view('templates/direktur/topbar');
        $this->load->view('direktur/profile');
        $this->load->view('templates/direktur/footer');
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

        $this->Model_direktur->editProfile($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>'
        );

        redirect('direktur/profile');
    }
}

/* End of file Direktur.php */
