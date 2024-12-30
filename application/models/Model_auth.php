<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_auth extends CI_Model
{
    public function tambahData($data)
    {
        $this->db->insert('tbl_user', $data);
    }

    public function insertResetToken($userId, $token)
    {
        $data = [
            'id_user' => $userId,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('tbl_reset_password', $data);
    }

    public function getUserByEmail($email)
    {
        return $this->db->get_where('tbl_user', ['email' => $email])->row_array();
    }

    public function getUserByResetToken($token)
    {
        $this->db->select('tbl_user.id_user, tbl_user.email');
        $this->db->from('tbl_reset_password');
        $this->db->join('tbl_user', 'tbl_reset_password.id_user = tbl_user.id_user');
        $this->db->where('tbl_reset_password.token', $token);
        $this->db->where('tbl_reset_password.created_at >=', date('Y-m-d H:i:s', strtotime('-1 hour'))); // Ubah menjadi 1 jam

        return $this->db->get()->row_array();
    }

    public function updatePassword($userId, $newPassword)
    {
        $data = [
            'password' => $newPassword
        ];

        $this->db->where('id_user', $userId);
        $this->db->update('tbl_user', $data);
    }

    public function deleteResetToken($token)
    {
        $this->db->where('token', $token);
        $this->db->delete('tbl_reset_password');
    }

    public function deleteExpiredTokens()
    {
        $this->db->where('created_at <', date('Y-m-d H:i:s', strtotime('-1 hour')));
        $this->db->delete('tbl_reset_password');
    }
}

/* End of file Model_auth.php */
