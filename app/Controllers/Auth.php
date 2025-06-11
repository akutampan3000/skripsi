<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return $this->redirectBasedOnRole();
        }
        return view('auth/login');
    }

    public function authenticate()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($this->request->getPost('email'));

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah');
        }

        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'is_admin' => $user['is_admin'], // Tambahkan ini
            'logged_in' => true
        ]);

        return $this->redirectBasedOnRole();
    }

    private function redirectBasedOnRole()
    {
        if (session()->get('is_admin')) {
            return redirect()->to('/admin/dashboard');
        }
        return redirect()->to('/dashboard');
    }

    public function register()
    {
        if (session()->get('logged_in')) {
            return $this->redirectBasedOnRole();
        }
        return view('auth/register');
    }

    public function processRegistration()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'is_admin' => 0 // Default non-admin
        ]);

        return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil! Silakan login');
    }

    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }
        return view('auth/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}