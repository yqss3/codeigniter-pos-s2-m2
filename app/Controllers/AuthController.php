<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/tasks');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                return view('login', [
                    'validation' => $this->validator,
                ]);
            }

            $userModel = new UserModel();
            $user = $userModel
                ->where('email', $this->request->getPost('email'))
                ->first();

            if ($user && password_verify(
                $this->request->getPost('password'),
                $user['password']
            )) {
                session()->regenerate();

                session()->set([
                    'user_id' => $user['id'],
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                    'logged_in' => true,
                ]);

                return redirect()->to('/tasks')
                    ->with('success', 'Login successful!');
            }

            return view('login', [
                'error' => 'Invalid email or password.',
            ]);
        }

        return view('login');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with('success', 'You have logged out successfully.');
    }
}