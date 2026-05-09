<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->has('user') && session()->get('user')['isLoggedIn'] ?? false) {
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
        
        // Single query with index-friendly lookup
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
        // Jika sudah login, redirect ke dashboard
        if (session()->has('user') && session()->get('user')['isLoggedIn'] ?? false) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    public function processRegister()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $model = new \App\Models\UserModel();
        
        $model->save([
            'username' => $this->request->getPost('name'), 
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'peserta',
        ]);

        return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Google OAuth - Redirect to Google
     * Optimized: minimal client setup, no unnecessary scopes
     */
    public function googleLogin()
    {
        $config = new \Config\Google();
        
        $client = new \Google_Client();
        $client->setClientId($config->clientID);
        $client->setClientSecret($config->clientSecret);
        $client->setRedirectUri($config->redirectUri);
        $client->setScopes(['email', 'profile']);
        
        // Performance optimizations
        $client->setAccessType('online'); // Tidak perlu refresh token
        $client->setApprovalPrompt('auto'); // Skip consent jika sudah pernah approve
        $client->setIncludeGrantedScopes(false);
        
        // Set HTTP client timeout
        $httpClient = new \GuzzleHttp\Client([
            'timeout' => 10,
            'connect_timeout' => 5,
            'verify' => false, // Skip SSL verify untuk speed di serverless
        ]);
        $client->setHttpClient($httpClient);

        return redirect()->to($client->createAuthUrl());
    }

    /**
     * Google OAuth Callback
     * Optimized: timeout settings, minimal API calls
     */
    public function googleCallback()
    {
        $code = $this->request->getGet('code');
        
        if (!$code) {
            return redirect()->to('/auth/login')->with('error', 'Gagal login dengan Google');
        }

        try {
            $config = new \Config\Google();
            
            $client = new \Google_Client();
            $client->setClientId($config->clientID);
            $client->setClientSecret($config->clientSecret);
            $client->setRedirectUri($config->redirectUri);
            
            // Set HTTP timeout untuk mencegah hanging
            $httpClient = new \GuzzleHttp\Client([
                'timeout' => 10,
                'connect_timeout' => 5,
                'verify' => false,
            ]);
            $client->setHttpClient($httpClient);

            // Exchange code for token
            $token = $client->fetchAccessTokenWithAuthCode($code);
            
            if (isset($token['error'])) {
                return redirect()->to('/auth/login')->with('error', 'Token Google tidak valid. Silakan coba lagi.');
            }

            $client->setAccessToken($token);

            // Get user info
            $oauth = new \Google_Service_Oauth2($client);
            $userInfo = $oauth->userinfo->get();

            // Find or create user
            $userModel = new \App\Models\UserModel();
            $user = $userModel->where('email', $userInfo->email)->first();

            if (!$user) {
                $userModel->save([
                    'username' => $userInfo->name,
                    'email' => $userInfo->email,
                    'foto' => $userInfo->picture ?? 'default.png',
                    'role' => 'peserta',
                    'password' => password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT)
                ]);
                $user = $userModel->where('email', $userInfo->email)->first();
            } else {
                // Update foto jika berubah
                if (!empty($userInfo->picture) && $user['foto'] !== $userInfo->picture) {
                    $userModel->update($user['id'], ['foto' => $userInfo->picture]);
                    $user['foto'] = $userInfo->picture;
                }
            }

            $this->setUserSession($user);
            return redirect()->to('/dashboard');

        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return redirect()->to('/auth/login')->with('error', 'Koneksi ke Google timeout. Silakan coba lagi.');
        } catch (\Exception $e) {
            log_message('error', 'Google OAuth Error: ' . $e->getMessage());
            return redirect()->to('/auth/login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('message', 'Berhasil logout');
    }

    /**
     * Helper: Set user session data
     */
    private function setUserSession(array $user): void
    {
        session()->set([
            'user' => [
                'id' => (int) $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'foto' => $user['foto'] ?? 'default.png',
                'created_at' => $user['created_at'],
                'isLoggedIn' => true
            ]
        ]);
    }
}
