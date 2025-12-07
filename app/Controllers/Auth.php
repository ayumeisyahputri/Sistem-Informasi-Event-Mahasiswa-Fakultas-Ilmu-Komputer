<?php namespace App\Controllers;

use App\Models\MahasiswaModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, langsung ke dashboard
        if (session()->get('user')) {
            return redirect()->to('/dashboard');
        }

        // Ambil cookie remember_token
        $model = new MahasiswaModel();
        $rememberToken = $_COOKIE['remember_token'] ?? null;

        if ($rememberToken) {
            $user = $model->where('remember_token', $rememberToken)->first();
            if ($user) {
                session()->set('user', $user);
                session()->set('role', $user['role'] ?? 'user');
                return redirect()->to('/dashboard');
            }
        }

        // Kirim error dan kirim cookie nim & pass kalau mau autofill (ambil dari ayumei)
        $data = [
            'cookie_nim'  => $_COOKIE['nim'] ?? '',
            'cookie_pass' => $_COOKIE['password'] ?? '',
            'error'       => session()->getFlashdata('error') ?? null
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

        $user = $model->where([
            'nim' => $nim,
            'password' => $password
        ])->first();

        if ($user) {

            // Set session user
            session()->set('user', $user);
            session()->set('role', $user['role'] ?? 'user');

            // Remember me versi secure (pakai token database)
            if (!empty($remember)) {
                $token = bin2hex(random_bytes(16));
                setcookie("remember_token", $token, time() + (86400 * 7), "/", "", false, true);

                $model->update($user['id'], [
                    'remember_token' => $token
                ]);
            } else {
                setcookie("remember_token", "", time() - 3600, "/");
            }

            // Autofill cookie nim & password (ambil dari ayumei)
            if ($remember == "on") {
                setcookie("nim", $nim, time() + (86400 * 7), "/");
                setcookie("password", $password, time() + (86400 * 7), "/");
            } else {
                setcookie("nim", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'NIM atau password salah.');
    }

    public function logout()
    {
        session()->destroy();

        // Bersihkan cookie
        setcookie("nim", "", time() - 3600, "/");
        setcookie("password", "", time() - 3600, "/");
        setcookie("remember_token", "", time() - 3600, "/");

        return redirect()->to('/login');
    }
}