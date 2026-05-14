<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if (session()->has('user') && (session()->get('user')['isLoggedIn'] ?? false)) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function processLogin()
    {
        $loginId = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($loginId) || empty($password)) {
            return redirect()->to('/auth/login')->with('error', 'Username dan password harus diisi');
        }

        $userModel = new \App\Models\UserModel();
        
        $user = $userModel->groupStart()
                          ->where('username', $loginId)
                          ->orWhere('email', $loginId)
                          ->groupEnd()
                          ->first();

        if ($user && password_verify($password, $user['password'])) {
            $this->setUserSession($user);
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/auth/login')->with('error', 'Username/Email atau password salah');
    }

    public function register()
    {
        if (session()->has('user') && (session()->get('user')['isLoggedIn'] ?? false)) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    public function processRegister()
    {
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'errors' => [
                    'required'   => 'Nama lengkap harus diisi.',
                    'min_length' => 'Nama minimal 3 karakter.',
                    'max_length' => 'Nama maksimal 50 karakter.',
                    'is_unique'  => 'Username sudah terdaftar.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique'   => 'Email sudah terdaftar.',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Password harus diisi.',
                    'min_length' => 'Password minimal 6 karakter.',
                ]
            ],
            'password_confirm' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak cocok.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = implode(' ', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('error', $errors);
        }

        $db = \Config\Database::connect();
        $db->table('users')->insert([
            'username' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'peserta',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/auth/login')->with('message', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Google OAuth - Redirect to Google (LIGHTWEIGHT - no library needed)
     * Menggunakan direct URL construction, bukan Google_Client library
     */
    public function googleLogin()
    {
        $config = new \Config\Google();

        $state = bin2hex(random_bytes(16));
        session()->set('oauth_state', $state);

        $params = [
            'client_id'     => $config->clientID,
            'redirect_uri'  => $config->redirectUri,
            'response_type' => 'code',
            'scope'         => 'email profile',
            'access_type'   => 'online',
            'prompt'        => 'select_account',
            'state'         => $state,
        ];

        $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);

        return redirect()->to($authUrl);
    }

    /**
     * Google OAuth Callback (LIGHTWEIGHT - using cURL instead of Google_Client)
     * Menghindari load library google/apiclient yang 30MB+
     */
    public function googleCallback()
    {
        $code = $this->request->getGet('code');
        $state = $this->request->getGet('state');

        if (!$code) {
            return redirect()->to('/auth/login')->with('error', 'Gagal login dengan Google');
        }

        // Validate OAuth state parameter
        $savedState = session()->get('oauth_state');
        session()->remove('oauth_state');
        if (!$state || !$savedState || !hash_equals($savedState, $state)) {
            return redirect()->to('/auth/login')->with('error', 'Sesi OAuth tidak valid. Silakan coba lagi.');
        }

        $config = new \Config\Google();

        // Step 1: Exchange code for access token via cURL
        $tokenData = $this->googleExchangeCode($code, $config);
        
        if (!$tokenData || isset($tokenData['error'])) {
            $errorMsg = $tokenData['error_description'] ?? 'Gagal mendapatkan token dari Google';
            return redirect()->to('/auth/login')->with('error', $errorMsg);
        }

        $accessToken = $tokenData['access_token'] ?? null;
        if (!$accessToken) {
            return redirect()->to('/auth/login')->with('error', 'Token tidak valid');
        }

        // Step 2: Get user info via cURL
        $userInfo = $this->googleGetUserInfo($accessToken);
        
        if (!$userInfo || !isset($userInfo['email'])) {
            return redirect()->to('/auth/login')->with('error', 'Gagal mendapatkan info akun Google');
        }

        // Step 3: Find or create user
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $userInfo['email'])->first();

        if (!$user) {
            // Handle username collision
            $baseUsername = $userInfo['name'] ?? $userInfo['email'];
            $uniqueUsername = $baseUsername;
            $counter = 1;
            while ($userModel->where('username', $uniqueUsername)->first()) {
                $uniqueUsername = $baseUsername . $counter;
                $counter++;
            }

            // Change from model save to direct db builder
            $db = \Config\Database::connect();
            $db->table('users')->insert([
                'username' => $uniqueUsername,
                'email'    => $userInfo['email'],
                'foto'     => $userInfo['picture'] ?? 'default.png',
                'role'     => 'peserta',
                'password' => password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $user = $userModel->where('email', $userInfo['email'])->first();
        } else {
            // Update foto jika berubah
            if (!empty($userInfo['picture']) && ($user['foto'] ?? '') !== $userInfo['picture']) {
                $userModel->update($user['id'], ['foto' => $userInfo['picture']]);
                $user['foto'] = $userInfo['picture'];
            }
        }

        $this->setUserSession($user);
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('message', 'Berhasil logout');
    }

    // ========================================
    // PRIVATE HELPERS
    // ========================================

    /**
     * Exchange authorization code for access token (pure cURL, no library)
     */
    private function googleExchangeCode(string $code, $config): ?array
    {
        $postFields = [
            'code'          => $code,
            'client_id'     => $config->clientID,
            'client_secret' => $config->clientSecret,
            'redirect_uri'  => $config->redirectUri,
            'grant_type'    => 'authorization_code',
        ];

        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($postFields),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error || $httpCode !== 200) {
            log_message('error', "Google token exchange failed: HTTP $httpCode, Error: $error");
            return null;
        }

        return json_decode($response, true);
    }

    /**
     * Get Google user info from access token (pure cURL, no library)
     */
    private function googleGetUserInfo(string $accessToken): ?array
    {
        $ch = curl_init('https://www.googleapis.com/oauth2/v2/userinfo');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ["Authorization: Bearer $accessToken"],
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error || $httpCode !== 200) {
            log_message('error', "Google userinfo failed: HTTP $httpCode, Error: $error");
            return null;
        }

        return json_decode($response, true);
    }

    /**
     * Set user session data
     */
    private function setUserSession(array $user): void
    {
        session()->regenerate(true);
        session()->set([
            'user' => [
                'id'         => (int) $user['id'],
                'username'   => $user['username'],
                'email'      => $user['email'],
                'role'       => $user['role'],
                'foto'       => $user['foto'] ?? 'default.png',
                'created_at' => $user['created_at'],
                'isLoggedIn' => true
            ]
        ]);
    }
}
