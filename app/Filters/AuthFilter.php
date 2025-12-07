<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\MahasiswaModel;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Sudah login → lanjut
        if ($session->has('user')) {
            return;
        }

        // Auto login via remember_token
        $token = $_COOKIE['remember_token'] ?? null;

        if ($token) {
            $model = new MahasiswaModel();
            $user = $model->where('remember_token', $token)->first();

            if ($user) {
                $session->set('user', $user);
                return;
            }
        }

        // Tidak ada session + tidak ada token
        return redirect()->to('/login');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}