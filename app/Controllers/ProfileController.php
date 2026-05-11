<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    private function getUserId(): int
    {
        return (int) session()->get('user')['id'];
    }

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

        // Handle upload foto
        $fotoFile = $this->request->getFile('foto');
        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            // Validasi tipe file
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($fotoFile->getMimeType(), $allowedMimes)) {
                return $this->response->setJSON(['success' => false, 'message' => 'Format foto harus JPG, PNG, GIF, atau WEBP']);
            }

            // Validasi ukuran (max 2MB)
            if ($fotoFile->getSize() > 2 * 1024 * 1024) {
                return $this->response->setJSON(['success' => false, 'message' => 'Ukuran foto maksimal 2MB']);
            }

            $uploadPath = FCPATH . 'uploads/foto/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            // Hapus foto lama jika bukan default dan bukan URL (google foto)
            if (!empty($user['foto']) && $user['foto'] !== 'default.png' && !filter_var($user['foto'], FILTER_VALIDATE_URL)) {
                $oldFile = $uploadPath . $user['foto'];
                if (file_exists($oldFile)) {
                    @unlink($oldFile);
                }
            }

            // Generate nama unique
            $newName = 'user_' . $userId . '_' . time() . '.' . $fotoFile->getExtension();
            $fotoFile->move($uploadPath, $newName);

            $data['foto'] = $newName;
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
