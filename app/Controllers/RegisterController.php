<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;

class RegisterController extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('signup', $data);
    }

   public function store()
{
    helper(['form']);
    $rules = [
        'name'           => 'required|min_length[2]|max_length[50]',
        'email'          => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
        'password'       => 'required|min_length[4]|max_length[50]',
        'confirmpassword' => 'matches[password]',
        'phone'          => 'required|min_length[10]|max_length[15]',
        'address'        => 'required|min_length[5]|max_length[255]',
        'termsAndPolicy' => 'required'
    ];

    if ($this->validate($rules)) {
        $userModel = new UserModel();
        $data = [
            'name'       => $this->request->getVar('name'),
            'email'      => $this->request->getVar('email'),
            'password'   => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'phone'      => $this->request->getVar('phone'),
            'address'    => $this->request->getVar('address')
        ];

        // Save user to database
        $userModel->save($data);

        // Store user information in session
        session()->set([
            'user_name'  => $this->request->getVar('name'),
            'user_phone' => $this->request->getVar('phone'),
            'is_logged_in' => true
        ]);

        // Set flash message
        session()->setFlashdata('success', "You're Registered Successfully!");

        // Show the signup page again
        return redirect()->to('/signup'); // Ensure this route matches your app's routing
    } else {
        $data['validation'] = $this->validator;
        echo view('signup', $data);
    }
}

}