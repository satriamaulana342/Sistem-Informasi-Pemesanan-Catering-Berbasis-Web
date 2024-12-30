<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Login',
        ];

        $this->validasiLogin();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/auth/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth/footer');
        } else {
            $email      = $this->input->post('email');
            $password   = $this->input->post('password');

            $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

            // ijika user nya ada
            if ($user) {

                // Cek apakah akun sudah diaktifkan
                if ($user['is_active'] == 0) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akun Anda belum diaktivasi! Silakan cek email Anda untuk aktivasi.</div>');
                    redirect('login');
                }

                // cek password user
                if (password_verify($password, $user['password'])) {

                    // jika password sesuai
                    $data = [
                        'id_user'       => $user['id_user'],
                        'nama_lengkap'  => $user['nama_lengkap'],
                        'id_role'       => $user['id_role']
                    ];

                    $this->session->set_userdata($data);

                    // cek id_role
                    if ($user['id_role'] == 1) {
                        $this->session->set_flashdata(
                            'pesan',
                            '<div class="alert alert-primary alert-dismissible fade show" role="alert">Hallo, selamat datang <strong>' . $user['nama_lengkap'] . '!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );
                        redirect('admin');
                    } elseif ($user['id_role'] == 2) {
                        redirect('home');
                    } elseif ($user['id_role'] == 3) {
                        $this->session->set_flashdata(
                            'pesan',
                            '<div class="alert alert-primary alert-dismissible fade show" role="alert">Hallo, selamat datang <strong>' . $user['nama_lengkap'] . '!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );
                        redirect('direktur');
                    } elseif ($user['id_role'] == 4) {
                        redirect('perusahaan');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Maaf, password salah!</div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email belum terdaftar! Silakan registrasi.</div>');
                redirect('login');
            }
        }
    }

    public function registrasi()
    {
        date_default_timezone_set('Asia/Jakarta'); // Set timezone ke Jakarta

        $data = [
            'title' => 'Registrasi'
        ];

        $this->validasiRegistrasi();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth/header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth/footer');
        } else {
            // Generate token aktivasi
            $token = bin2hex(random_bytes(32));

            $data = [
                'nama_lengkap'  => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'email'         => htmlspecialchars($this->input->post('email', true)),
                'no_telp'       => htmlspecialchars($this->input->post('no_telp', true)),
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'id_role'       => 2,
                'is_active'     => 0,
                'date_created'  => date('Y-m-d H:i:s')
            ];

            $this->Model_auth->tambahData($data);

            // Simpan token ke tabel token
            $token_data = [
                'email' => $data['email'],
                'token' => $token,
                'date_created' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('tbl_user_token', $token_data);

            // Kirim email aktivasi
            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Registrasi berhasil! Silahkan cek email Anda untuk mengaktifkan akun.</div>');

            redirect('login');
        }
    }

    private function _sendEmail($token, $type)
    {
        $this->email->from('satriamaulana716@gmail.com', 'Barokah Amanah Catering');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Aktivasi Akun');
            $this->email->message('Selamat! Akun Anda telah berhasil dibuat di Barokah Amanah Catering.<br><br>Berikut adalah detail akun Anda:<br><br>Nama Lengkap: ' . htmlspecialchars($this->input->post('nama_lengkap', true)) . '<br>Email: ' . htmlspecialchars($this->input->post('email', true)) . '<br>Nomor Telepon: ' . htmlspecialchars($this->input->post('no_telp', true)) . '<br><br>Anda dapat menggunakan akun ini untuk melakukan pemesanan paket catering kami. Jika ada pertanyaan atau bantuan lebih lanjut, silakan hubungi kami melalui nomor telepon atau email yang tercantum di website.<br><br>Untuk mengaktifkan akun Anda, silakan klik link berikut:<br><a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktivasi Akun</a><br><br>Terima kasih telah mendaftar di Barokah Amanah Catering. Kami berharap dapat memberikan layanan terbaik untuk Anda.<br><br>Salam,<br>Tim Barokah Amanah Catering');
        }

        if (!$this->email->send()) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengirim email aktivasi.</div>');
            show_error($this->email->print_debugger());
        }
    }

    // Fungsi untuk verifikasi akun
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tbl_user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (date('Y-m-d H:i:s') - $user_token['date_created'] < (60 * 60 * 24)) { // 24 jam valid
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('tbl_user');

                    $this->db->delete('tbl_user_token', ['email' => $email]);

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Aktivasi akun berhasil! Silahkan login.</div>');
                    redirect('login');
                } else {
                    $this->db->delete('tbl_user', ['email' => $email]);
                    $this->db->delete('tbl_user_token', ['email' => $email]);

                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token sudah kadaluarsa.</div>');
                    redirect('auth/registrasi');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token tidak valid.</div>');
                redirect('auth/registrasi');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Email tidak ditemukan.</div>');
            redirect('auth/registrasi');
        }
    }


    public function lupa_password()
    {
        $data = [
            'title' => 'Lupa Password'
        ];

        $this->load->view('templates/auth/header', $data);
        $this->load->view('auth/lupa_password');
        $this->load->view('templates/auth/footer');
    }

    public function reset_password()
    {
        date_default_timezone_set('Asia/Jakarta');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $email  = $this->input->post('email');
            $user   = $this->Model_auth->getUserByEmail($email);

            if ($user) {
                $token = bin2hex(random_bytes(16));
                $this->Model_auth->insertResetToken($user['id_user'], $token);

                $reset_link = base_url('reset_password_form/' . $token);

                $this->email->from('satriamaulana716@gmail.com', 'Barokah Amanah Catering');
                $this->email->to($email);
                $this->email->subject('Reset Password');
                $this->email->message('Halo ' . $user['nama_lengkap'] . ',<br><br>Anda telah melakukan permintaan untuk mereset password akun Anda di Barokah Amanah Catering. Klik tautan berikut untuk mereset password Anda:<br><br>' . anchor($reset_link, 'Reset Password') . '<br><br>Tautan ini akan kedaluwarsa dalam waktu 1 jam. Jika Anda tidak melakukan permintaan reset password, atau telah lewat dari batas waktu yang ditentukan, abaikan email ini dan lakukan permintaan reset password baru.<br><br>Terima kasih telah menggunakan layanan kami.<br><br>Salam,<br>Tim Barokah Amanah Catering');
                $this->email->send();

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Link reset password telah dikirim ke email Anda.</div>');
                redirect('login');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email tidak ditemukan.</div>');
                redirect('lupa_password');
            }
        } else {
            redirect('lupa_password');
        }
    }

    public function reset_password_form($token)
    {
        date_default_timezone_set('Asia/Jakarta');

        $user = $this->Model_auth->getUserByResetToken($token);

        if ($user) {
            $data = [
                'title' => 'Reset Password',
                'token' => $token,
                'email' => $user['email']
            ];
            $this->load->view('templates/auth/header', $data);
            $this->load->view('auth/reset_password_form', $data);
            $this->load->view('templates/auth/footer');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Token reset password tidak valid.</div>');
            redirect('login');
        }
    }

    public function process_reset_password($token)
    {
        date_default_timezone_set('Asia/Jakarta');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $user = $this->Model_auth->getUserByResetToken($token);

            if ($user) {
                $this->Model_auth->updatePassword($user['id_user'], $password);
                $this->Model_auth->deleteResetToken($token);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password berhasil direset. Silakan login.</div>');
                redirect('login');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Token reset password tidak valid.</div>');
                redirect('login');
            }
        } else {
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('nama_lengkap');
        $this->session->unset_userdata('id_role');
        redirect('home');
    }

    // VALIDASI
    private function validasiLogin()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required'      => '%s belum diisi',
            'valid_email'   => '%s tidak valid',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
            'required'      => '%s belum diisi',
            'min_length'    => '%s minimal 6 karakter'
        ]);
    }

    private function validasiRegistrasi()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama lengkap', 'required|trim', [
            'required'      => '%s belum diisi'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]', [
            'required'      => '%s belum diisi',
            'valid_email'   => '%s tidak valid',
            'is_unique'     => '%s sudah terdaftar'
        ]);

        $this->form_validation->set_rules('no_telp', 'No handphone', 'required|trim|min_length[12]|max_length[12]|numeric|is_unique[tbl_user.no_telp]', [
            'required'      => '%s belum diisi',
            'min_length'    => '%s minimal 12 angka',
            'max_length'    => '%s maksimal 12 angka',
            'numeric'       => '%s harus berupa angka',
            'is_unique'     => '%s sudah terdaftar',
        ]);


        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
            'required'      => '%s belum diisi',
            'min_length'    => '%s minimal 6 karakter'
        ]);
    }
}

/* End of file Auth.php */
