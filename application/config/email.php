<?php
defined('BASEPATH') or exit('Tidak ada akses skrip langsung yang diizinkan');

$config = array(
    'protocol'      => 'smtp', // 'mail', 'sendmail', atau 'smtp'
    'smtp_host'     => 'smtp.gmail.com', // Atur server SMTP yang akan digunakan
    'smtp_user'     => 'satriamaulana716@gmail.com', // Nama pengguna SMTP
    'smtp_pass'     => 'tlgz tyam lptz mbcz', // Kata sandi SMTP
    'smtp_port'     => 587, // Nomor port SMTP
    'smtp_crypto'   => 'tls', // Enkripsi SMTP, 'tls' atau 'ssl'
    'mailtype'      => 'html', // 'text' atau 'html'
    'charset'       => 'utf-8',
    'newline'       => "\r\n",
    'crlf'          => "\r\n",
    'validation'    => true // Apakah alamat email harus divalidasi atau tidak
);
