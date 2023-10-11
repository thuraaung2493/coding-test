<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        if (session('id')) {
            return redirect()->to('/employee');
        }

        helper('form');
        echo view('auth/login');
    }

    public function store()
    {
        if (!$this->validate('loginRules')) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        $session = session();
        $userModel = \model(UserModel::class);

        $user = $userModel->where('email', $this->request->getVar('email'))->first();

        $session->set([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
        return redirect()->to('/');
    }

    public function logout()
    {
        \session()->destroy();

        return \redirect()->to('/login');
    }
}
