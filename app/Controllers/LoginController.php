<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class LoginController extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('signin');
    }

    public function loginAuth()
{
    $session = session();
    $userModel = new UserModel();
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    $data = $userModel->where('email', $email)->first();

    if ($data) {
        $pass = $data['password'];
        $authenticatePassword = password_verify($password, $pass);
        if ($authenticatePassword) {
            $ses_data = [
                'id' => $data['id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'isLoggedIn' => TRUE
            ];

            // Set the session data
            $session->set($ses_data);

            // Set flashdata for successful login message
            $session->setFlashdata('success', 'You have successfully logged in.');

            // Check if the user is an admin
            if ($this->isAdmin($email)) {
                $ses_data['isAdmin'] = TRUE;
                // Redirect admin to admin page
                return redirect()->to('/admin');
            }

            return redirect()->to('/home');
        } else {
            $session->setFlashdata('msg', 'Password is incorrect.');
            return redirect()->to('/signin');
        }
    } else {
        $session->setFlashdata('msg', 'Email does not exist.');
        return redirect()->to('/signin');
    }
}


    public function profile()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            $userModel = new UserModel();
            $userId = $session->get('id');
            $userData = $userModel->find($userId);

            // Pass user data to profile view and display it
            return view('user/profile', ['user' => $userData]);
        } else {
            return redirect()->to('/signin');
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove(['id', 'name', 'email', 'isLoggedIn', 'isAdmin']);
        return redirect()->to('/signin');
    }

    private function isAdmin($email)
    {
        // Check if the email exists in your list of admin emails
        $adminEmails = ['admin@example.com', 'admin@gmail.com']; // Add your admin emails here
        return in_array($email, $adminEmails);
    }
}