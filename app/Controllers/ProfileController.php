<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    /**
     * Render profile partial view
     */
    public function index()
    {
        $userModel = new UserModel();
        $user = $userModel->find($this->getUserId());

        return view('partials/profile-content', ['user' => $user]);
    }

    /**
     * Update profile (username, email, foto)
     */
    public function update()
    {
        $userId = $this->getUserId();
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'User tidak ditemukan']);
        }

        $username = trim($this->request->getPost('username') ?? '');
        $email = trim($this->request->getPost('email') ?? '');

        // Validasi
        if (empty($username) || strlen($username) < 3) {
            return $this->response->setJSON(['success' => false, 'message' => 'Nama minimal 3 karakter']);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Email tidak valid']);
        }

        // Cek email duplikat (selain milik user sendiri)
        $existing = $userModel->where('email', $email)->where('id !=', $userId)->first();
        if ($existing) {
            return $this->response->setJSON(['success' => false, 'message' => 'Email sudah digunakan']);
        }

        $data = [
            'username' => $username,
            'email'    => $email,
        ];

        // Handle foto base64
        $fotoBase64 = $this->request->getPost('foto_base64');
        if (!empty($fotoBase64)) {
            // Validate data URI format
            if (!preg_match('/^data:image\/(jpeg|png|gif|webp);base64,/', $fotoBase64)) {
                return $this->response->setJSON(['success' => false, 'message' => 'Format foto tidak valid']);
            }

            // Check size (max ~500KB as base64)
            if (strlen($fotoBase64) > 500 * 1024) {
                return $this->response->setJSON(['success' => false, 'message' => 'Ukuran foto terlalu besar']);
            }

            $data['foto'] = $fotoBase64;
        }

        // Update database
        if ($userModel->update($userId, $data)) {
            // Update session dengan data baru
            $updatedUser = $userModel->find($userId);
            session()->set('user', [
                'id'         => (int) $updatedUser['id'],
                'username'   => $updatedUser['username'],
                'email'      => $updatedUser['email'],
                'role'       => $updatedUser['role'],
                'foto'       => $updatedUser['foto'] ?? 'default.png',
                'created_at' => $updatedUser['created_at'],
                'isLoggedIn' => true
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Profil berhasil diperbarui',
                'user'    => [
                    'username' => $updatedUser['username'],
                    'email'    => $updatedUser['email'],
                    'foto'     => $updatedUser['foto'],
                ]
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui profil']);
    }

    /**
     * Change password
     */
    public function changePassword()
    {
        $userId = $this->getUserId();
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if (empty($currentPassword) || empty($newPassword)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Password saat ini dan password baru harus diisi']);
        }

        if (strlen($newPassword) < 6) {
            return $this->response->setJSON(['success' => false, 'message' => 'Password baru minimal 6 karakter']);
        }

        if ($newPassword !== $confirmPassword) {
            return $this->response->setJSON(['success' => false, 'message' => 'Konfirmasi password tidak cocok']);
        }

        if (!password_verify($currentPassword, $user['password'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Password saat ini salah']);
        }

        $userModel->update($userId, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Password berhasil diubah']);
    }
}
