<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek apakah user sudah login (dengan safe null check)
        $user = $session->get('user');
        $isLoggedIn = is_array($user) && !empty($user['isLoggedIn']) && !empty($user['id']);

        if (!$isLoggedIn) {
            // Jika request AJAX, return JSON 401
            if ($request->isAJAX()) {
                return service('response')
                    ->setStatusCode(401)
                    ->setJSON([
                        'error' => 'Unauthorized',
                        'message' => 'Session telah berakhir. Silakan login ulang.',
                        'redirect' => '/auth/login'
                    ]);
            }

            // Redirect ke halaman login
            return redirect()->to('/auth/login')->with('error', 'Sesi telah berakhir. Silakan login ulang.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No-op
    }
}

