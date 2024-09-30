<?php

namespace App\Controllers;

use App\Models\CarModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\RentingModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $userModel;
    protected $productModel;
    protected $rentModel;
    

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel(); // Initialize CarModel
        $this->rentingModel = new RentingModel(); // Initialize CarModel
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        $data['userCount'] = $this->userModel->countAll(); // Count all users
        $data['carCount'] = $this->productModel->countAll(); // Count of cars
        $data['rentCount'] = $this->rentingModel->countAll(); // Count of cars
        return view('admin/user_management', $data);
    }

    public function search()
    {
        $searchTerm = $this->request->getGet('search');
        $data['users'] = $this->userModel->like('name', $searchTerm)->findAll();
        $data['userCount'] = $this->userModel->countAll(); // Count all users
        return view('layouts/dashboard', $data);
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to(base_url('admin'))->with('message', 'User deleted successfully');
    }

    public function carinfo()
    {
        $carModel = new CarModel();
        $data['cars'] = $carModel->findAll();
        return view('admin/car_management', $data);
    }

    public function addCar() {
        helper(['form', 'url']);
        
        $imageFile = $this->request->getFile('image');

        // Validate that the uploaded file is a valid image and is in JPEG format
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            // Check if it's a JPEG
            if ($imageFile->getMimeType() !== 'image/jpeg') {
                return redirect()->back()->with('message', 'Only JPEG images are allowed.');
            }

            // Give a unique name to avoid conflicts
            $newName = $imageFile->getRandomName();
            $imageFile->move('uploads/', $newName);  // Save the image to 'uploads' folder

            // Prepare the car data including the image
            $data = [
                'Model' => $this->request->getPost('model'),
                'Year' => $this->request->getPost('year'),
                'Color' => $this->request->getPost('color'),
                'Mileage' => $this->request->getPost('mileage'),
                'Transmission' => $this->request->getPost('transmission'),
                'FuelType' => $this->request->getPost('fuel_type'),
                'Image' => $newName  // Store the image filename
            ];

            // Save to the database
            $this->carModel->insert($data);

            return redirect()->to('/admin/car_management')->with('message', 'Car added successfully');
        } else {
            return redirect()->back()->with('message', 'Error uploading image.');
        }
    }

    public function updateCar($carId)
    {
        $carModel = new CarModel();
        $car = $carModel->find($carId);

        if (!$car) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Car not found");
        }

        $carData = $this->getRequestData();
        $carModel->update($carId, $carData);

        return redirect()->to(base_url('admin/carinfo'))->with('message', 'Car updated successfully');
    }

    public function deleteCar($carId)
    {
        $carModel = new CarModel();
        $car = $carModel->find($carId);

        if (!$car) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Car not found");
        }

        $carModel->delete($carId);
        return redirect()->to(base_url('admin/carinfo'))->with('message', 'Car deleted successfully');
    }

    public function usercar()
    {
        $carModel = new CarModel();
        $cars = $carModel->findAll();
        return view('admin/car_management', ['cars' => $cars]);
    }

    private function getRequestData()
    {
        return [
            'Model' => $this->request->getPost('model'),
            'Year' => $this->request->getPost('year'),
            'Color' => $this->request->getPost('color'),
            'Mileage' => $this->request->getPost('mileage'),
            'Transmission' => $this->request->getPost('transmission'),
            'FuelType' => $this->request->getPost('fuel_type'),
        ];
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("User not found");
        }
        return view('edit_user', ['user' => $user]);
    }

    public function update($id)
    {
        $validation = $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'address' => 'required',
            'created_at' => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'created_at' => $this->request->getPost('created_at'),
            
        ]);

        return redirect()->to(base_url('admin'))->with('message', 'User updated successfully');
    }

    public function editCar($carId)
    {
        $carModel = new CarModel();
        $car = $carModel->find($carId);

        if (!$car) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Car not found");
        }

        return $this->response->setJSON($car);
    }
    public function design()
    {
        // Fetch recent users and count of users
        $data['users'] = $this->userModel->orderBy('created_at', 'DESC')->findAll(5);
        $data['userCount'] = $this->userModel->countAll(); // Count all users
        $data['carCount'] = $this->productModel->countAll(); // Count of cars
        $data['rentCount'] = $this->rentingModel->countAll(); // Count of rentals
    
        // Example data for the rental chart
        $data['chartData'] = [
            'labels' => ['October', 'November',], // Example labels
            'data' => [1,1,] // Example data values
        ];
    
        return view('layouts/dashboard', $data);
    }
    
    public function recentUsers()
    {
        // Fetch recent users and count of users
        $data['users'] = $this->userModel->orderBy('created_at', 'DESC')->findAll(5); // Get the 5 most recent users
        $data['userCount'] = $this->userModel->countAll(); // Count all users
        return view('admin/recent_users', $data); // Create a new view for recent users
    }
    
}