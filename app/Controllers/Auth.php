<?php namespace App\Controllers;

use App\Models\MahasiswaModel;

class Auth extends BaseController
{
    public function login()
    {
        // jika sudah login redirect
        if (session()->get('user')) {
            return redirect()->to('/dashboard');
        }

        // ambil cookie untuk remember me
        $data = [
            'cookie_nim' => isset($_COOKIE['nim']) ? $_COOKIE['nim'] : '',
            'cookie_pass'=> isset($_COOKIE['password']) ? $_COOKIE['password'] : '',
            'error' => session()->getFlashdata('error') ?? null
        ];
        echo view('layout/header');
        echo view('auth/login', $data);
        echo view('layout/footer');
    }

    public function loginProcess()
    {
        $model = new MahasiswaModel();
        $nim = $this->request->getPost('nim');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $user = $model->where(['nim' => $nim, 'password' => $password])->first();

        if ($user) {
            session()->set('user', $user);
            session()->set('role', $user['role'] ?? 'user');

            if ($remember == "on") {
                setcookie("nim", $nim, time() + (86400 * 7), "/");
                setcookie("password", $password, time() + (86400 * 7), "/");
            } else {
                setcookie("nim", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }

            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'NIM atau password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        setcookie("nim", "", time() - 3600, "/");
        setcookie("password", "", time() - 3600, "/");
        return redirect()->to('/login');
    }
}
