<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Register extends BaseController
{
    public function index()
    {
        \helper('form');

        if (session('id')) {
            return redirect()->to('/employee');
        }

        return \view('auth/register');
    }

    public function store()
    {
        \helper('form');

        if (!$this->validate('registerRules')) {
            return redirect()->to('/register')
                ->withInput()
                ->with('validation', $this->validator);
        }

        $user = $this->validator->getValidated();
        $model = \model(UserModel::class);

        $model->save([
            'name'     => $user['name'],
            'email'    => $user['email'],
            'password' => password_hash($user['password'], PASSWORD_DEFAULT)
        ]);

        session()->setFlashdata('success', 'Successful Registration');

        return redirect()->to('/login');
    }
}
