<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Google_Client;
use Google_Service_Oauth2;
use Config\Google; 

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
{
    $request = service('request');
    $username = $request->getPost('username');
    $password = $request->getPost('password');

    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('username', $username)->first();

    if ($user && password_verify($password, $user['password'])) {
      
        session()->set([
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'mode' => $user['mode'] ?? 'light', 
                'created_at' => $user['created_at'], 
                'isLoggedIn' => true
            ]
        ]);

        return redirect()->to('/dashboard');
    } else {
        return redirect()->to('/auth/login')->with('error', 'Username atau password salah');
    }
}

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
{
    $validation = \Config\Services::validation();

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
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    ]);

    session()->setFlashdata('success', 'Registrasi berhasil! Silakan login.');

    return redirect()->to('/auth/login');
    }
    // ======================
    // GOOGLE LOGIN BAGIAN INI
    // ======================

    public function googleLogin()
{
    $config = new Google();
    $client = new Google_Client();
    $client->setClientId($config->clientID);
    $client->setClientSecret($config->clientSecret);
    $client->setRedirectUri($config->redirectUri);
    $client->addScope('email');
    $client->addScope('profile');

    $authUrl = $client->createAuthUrl();
    return redirect()->to($authUrl);
}

    public function googleCallback()
{
    $config = new Google();
    $client = new Google_Client();
    $client->setClientId($config->clientID);
    $client->setClientSecret($config->clientSecret);
    $client->setRedirectUri($config->redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

    if ($this->request->getGet('code')) {
        $token = $client->fetchAccessTokenWithAuthCode($this->request->getGet('code'));
        if (isset($token['error'])) {
            return redirect()->to('/auth/login')->with('error', 'Gagal mendapatkan token akses dari Google');
        }

        $client->setAccessToken($token);

        $oauth = new Google_Service_Oauth2($client);
        $userInfo = $oauth->userinfo->get();

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $userInfo->email)->first();

        if (!$user) {
            $userModel->save([
                'username' => $userInfo->name,
                'email' => $userInfo->email,
                'foto' => $userInfo->picture,
                'role' => 'peserta',
                'password' => password_hash(uniqid(), PASSWORD_DEFAULT) 
            ]);
            $user = $userModel->where('email', $userInfo->email)->first();
        }

        session()->set([
            'id' => $user['id'], 
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'foto' => $user['foto'], 
            'isLoggedIn' => true
        ]);

        return redirect()->to('/dashboard');
    } else {
        return redirect()->to('/auth/login')->with('error', 'Gagal login dengan Google');
    }
}

    public function logout()
{
    session()->destroy();
    return redirect()->to('/auth/login')->with('message', 'Berhasil logout');
}

}

