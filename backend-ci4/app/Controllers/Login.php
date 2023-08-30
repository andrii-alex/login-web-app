<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function postLogin(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // $authorizationHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        // $token = trim(str_replace('Bearer', '', $authorizationHeader));

        // return $this->response->setStatusCode(401)->setJson([
        //     'token' => $token,
        //     'username'  => $username,
        //     'error'     => 'No account with this username!'
        // ]);

        $userModel = model("UserModel");

        $user = $userModel->where("username", $username)->first();

        if(is_null($user))
            return $this->response->setStatusCode(401)->setJson([
                'username'  => $username,
                'error'     => 'No account with this username!'
            ]);

        if (password_verify($password, $user->password)) {
            $token = bin2hex(random_bytes(32));

            $this->session->set('username', $username);
            $this->session->set('token', $token);

            $user->token = $token;
            $userModel->save($user);
    
            return $this->response->setStatusCode(200)->setJson([
                'username'      => $this->session->get('username'),
                'token'             => $this->session->get('token', $token)
            ]);
        } else {
            return $this->response->setStatusCode(401)->setJson([
                'error' => 'Incorrect password!',
            ]);
        }
    }  
    
}
