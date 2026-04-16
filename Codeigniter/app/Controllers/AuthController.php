<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    // 1. Show the Login Form
    public function login()
    {
        // This is the starting point for your users
        return view('login_view');
    }

    // 2. Show the Registration Form
    public function register()
    {
        return view('register_view');
    }

    // 3. Process the Registration (bcrypt hashing)
    public function store()
    {
        $userModel = new UserModel();
        $password = $this->request->getPost('password');

        // REQUIREMENT: bcrypt hashing
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $hashedPassword, 
        ];

        $userModel->insert($data);

        return redirect()->to('/login')->with('message', 'Registration successful! Please login.');
    }

    // 4. Process the Login
    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            // REQUIREMENT: password_verify handles the bcrypt comparison
            if (password_verify($password, $user['password'])) {
                
                $session->set([
                    'username'   => $user['username'],
                    'isLoggedIn' => true
                ]);

                return redirect()->to('/tasks');
            }
        }

        return redirect()->back()->with('error', 'Invalid username or password.');
    }

    // 5. Process Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}