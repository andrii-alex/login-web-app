<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function login(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = model("UserModel");

        $user = $userModel->where("username", $username)->first();

        if(is_null($user))
            return $this->response->setStatusCode(401)->setJson([
                'error' => 'No account with this username!'
            ]);

        if (password_verify($password, $user->password)) {
            $token = bin2hex(random_bytes(32));

            $session = \Config\Services::session();
            $session->set('username', $username);
            $session->set('token', $token);

            $user->token = $token;
            $userModel->save($user);
    
            return $this->response->setStatusCode(200)->setJson([
                'username' => $session->get('username'),
                'token' => $session->get('token', $token)
            ]);
        } else {
            return $this->response->setStatusCode(401)->setJson([
                'error' => 'Incorrect password!',
            ]);
        }
    }   
}
