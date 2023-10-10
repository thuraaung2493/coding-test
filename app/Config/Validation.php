<?php

namespace Config;

use App\Validation\CustomRules;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $registerRules = [
        'name' => [
            'rules' => 'required|alpha_numeric_punct|max_length[255]',
            'label' => 'Name',
        ],
        'email' => [
            'rules' => 'required|valid_email|max_length[255]|is_unique[users.email]',
            'label' => 'Email Address',
        ],
        'password' => [
            'rules' => 'required|min_length[8]|max_length[255]',
            'label' => 'Password',
        ],
        'cofirm_password' => [
            'rules' => 'required|matches[password]',
            'label' => 'Confirm Password',
        ],
    ];

    public $loginRules = [
        'email' => [
            'rules' => 'required|valid_email',
            'label' => 'Email Address',
        ],
        'password' => [
            'rules' => 'required|validateUser[email,password]',
            'label' => 'Password',
            'errors' => [
                'validateUser' => 'Incorrect username or password.'
            ]
        ],
    ];

    public $uploadRules = [
        'file' => [
            'rules' => 'uploaded[file]|ext_in[file,xlsx]',
            'label' => 'Uploaded File',
        ],
    ];
}
