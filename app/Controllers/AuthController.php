<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CIAuth;
use App\Libraries\Hash;
use App\Models\User;

class AuthController extends BaseController
{
    protected $helpers = ['url','form'];

    public function login()
    {
        $data = [
            'pageTitle'=>'Login',
            'validation'=>null
        ];
        return view('backend/pages/auth/login', $data);
    }
    public function loginHandler(){
        $fieldType = filter_var($this->request->getVar('login_id'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldType == 'email'){
            $isValid = $this->validate([
                'login_id'=>[
                'rules' => 'required|valid_email|is_not_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please, check the email field. It does not appear to be valid.',
                    'is_not_unique' => 'Email does not exist in your system.'
                ]

                ],
                'password'=>[
                    'rules'=>'required|min_length[5]|max_length[45]',
                    'errors'=>[
                        'required'=>'Password is required',
                        'min_length'=>'Password must have atleast 5 characters in length.',
                        'max_length'=>'Password must not have characters more than 45 in length.'

                    ]
                ]
            ]);
        }else{
            $isValid = $this->validate([
                'login_id'=>[
                'rules' => 'required|is_not_unique[users.username]',
                'errors' => [
                    'required' => 'Username is required',
                    'is_not_unique' => 'Username does not exist in your system.'
                ]

                ],
                'password'=>[
                    'rules'=>'required|min_length[5]|max_length[45]',
                    'errors'=>[
                        'required'=>'Password is required',
                        'min_length'=>'Password must have atleast 5 characters in length.',
                        'max_length'=>'Password must not have characters more than 45 in length.'

                    ]
                ]
            ]);
        }
             
    }
}

        
            

   

