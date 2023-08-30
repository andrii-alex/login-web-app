<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!isLoggedIn()) {
            return redirect()->to(''); // Redirect to login page or return unauthorized response
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}

function isLoggedIn()
{
    $session = \Config\Services::session();
    $userModel = new \App\Models\UserModel();

    $username       = $session->get('username');
    $token          = $session->get('token');

    if (empty($username) || empty($token)) {
        return false;
    }

    $user = $userModel->where('username', $username)
                      ->where('token', $token)
                      ->first();

    return ($user !== null);
}
