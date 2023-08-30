<?php

function isLoggedIn()
{
    $userModel = model('UserModel');

    $username       = $this->session->get('username');
    $token          = $this->session->get('token');

    if (empty($username) || empty($token)) {
        return false;
    }

    $user = $userModel->where('username', $username)
                      ->where('token', $token)
                      ->first();

    return ($user !== null);
}